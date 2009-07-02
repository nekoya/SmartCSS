<?php
/**
 *
 */
class SCSS_Lexer {
    protected $regexs;
    protected $commands;
    protected $state;
    public $lineNum = 1;
    public $debug;
    public $lexbuf;

    /**
     *
     */
    public function __construct() {
        $this->defineRegexs();
        $this->state = 'ruleset';
    }

    /**
     *
     */
    public function setBuffer($buffer) {
        $this->lexbuf = $buffer;
    }

    /**
     *
     */
    public function prependBuffer($buffer) {
        $this->lexbuf = $buffer . $this->lexbuf;
    }

    /**
     *
     */
    public function appendBuffer($buffer) {
        $this->lexbuf = $this->lexbuf . $buffer;
    }

    /**
     *
     */
    public function bufferHead() {
        return mb_substr($this->lexbuf, 0, 30) . '...';
    }

    /**
     *
     */
    public function yylex(&$yylval) {
        $lval = $this->analyze($yylval);
        $const = "SCSS_Parser::$lval";
        return (defined($const)) ? constant($const) : $lval;
    }

    /**
     *
     */
    public function analyze(&$yylval) {
        while ($this->lexbuf) {
            //$this->debug("buffer: " . mb_substr($this->lexbuf, 0, 30) . "...");

            switch ($this->state) {
            case 'ruleset':
                $regexs  = $this->regexs;
                $options = 'i';
                break;

            case 'command':
                $regexs  = $this->commands;
                $options = '';
                break;

            default:
                throw new Exception('Invalid state');
                break;
            }

            $comment = $this->isComment($this->lexbuf);
            if ($comment !== false) {
                $this->debug("SKIP COMMENT:[" . mb_substr($comment, 0, 8) . "...]" . mb_strlen($comment) . " characters.");
                $this->lexbuf = mb_substr($this->lexbuf, mb_strlen($comment));

                $count = preg_match_all('(\r\n|\r|\n)', $comment, $lineBreaks);
                $this->debug("$count line breaks exists inner comment.");
                $this->lineNum += $count;
                continue;
            }

            foreach ($regexs as $token => $regex) {
                $regex = '/^(' . $regex . ')/' . $options;
                if (preg_match($regex, $this->lexbuf, $matches)) {
                    if ($this->debug) {
                        var_dump($matches);
                    }
                    $yylval = (string)$matches[1];
                    $this->lexbuf = mb_substr($this->lexbuf, mb_strlen($yylval));

                    switch ($token) {
                    case 'NL':
                        $this->lineNum++;
                        $this->debug("analyze new line:" . $this->lineNum);
                        break;

                    case 'SELECTOR':
                        $count = preg_match_all('(\r\n|\r|\n)', $yylval, $lineBreaks);
                        $this->debug("$count line breaks exists inner selector.");
                        $this->lineNum += $count;
                        break;

                    case 'cLDELIM':
                        $this->state = 'command';
                        break;

                    case 'cRDELIM':
                        $this->state = 'ruleset';
                        break;
                    }

                    $this->debug($token . ' ' . $yylval);
                    return $token;
                }
            }
            // unmatched regexs
            $yylval = ord($this->lexbuf);
            $this->lexbuf = mb_substr($this->lexbuf, 1);
            $this->debug('token unmatched ' . chr($yylval));
            return $yylval;
        }
        return 0;
    }

    /**
     *
     */
    protected function defineRegexs() {
        $regexs = array(
            'NL'            => '[ \t\f]*(?:\r\n|\r|\n)',
            'cLDELIM'       => '\s*\[%',
            'LBRACE'        => '\s*{',

            'SELECTOR'      => '{{selector}}(\s*,\s*{{selector}})*(?=\s*{)',

            'STRING'        => '{{string}}',
            'URI'           => 'url\(\s*{{string}}\s*\)',
            'IMPORTANT_SYM' => '!important\s*',
            'CHARSET'       => '@charset {{string}};',
            'IMPORT'        => '@import\s*(?:{{string}}|{{URI}})\s*{{media_types}};',

            'EMS'           => '{{num}}em',
            'EXS'           => '{{num}}ex',
            'LENGTH'        => '{{num}}(?:px|cm|mm|in|pt|pc)',
            'ANGLE'         => '{{num}}(?:deg|rad|grad)',
            'TIME'          => '{{num}}(?:ms|s)',
            'FREQ'          => '{{num}}(?:hz|khz)',

            'HEXCOLOR'      => '#(?:{{h}}{6}|{{h}}{3})',
            'HASH'          => '#{{name}}+',
            'IDENT'         => '{{ident}}',
            'PERCENTAGE'    => '{{num}}+%',
            'NUMBER'        => '{{num}}',
            'PLUS'          => '\s*\+',
            'GREATER'       => '\s*>',
            'COMMA'         => '\s*,',
            'SPACE'         => '\s+',
        );
        $rules = array(
            'h'               => '[0-9a-f]',
            'ident'           => '-?{{nmstart}}{{nmchar}}*',
            'nmstart'         => '[_a-z]',
            'nmchar'          => '[_a-z0-9-]',
            'name'            => '{{nmchar}}+',
            'num'             => '\d*\.{0,1}\d+',
            'string'          => '(?:".*?"|' . "'.*?')",
            'unary_operator'  => '(?:\+|\-)?',

            'media_types'     => '(?:{{ident}}\s*(?:,\s*{{ident}}\s*)*){0,1}',

            'simple_selector' => '(?:(?:{{ident}}|\*){{selector_suffix}}*|{{selector_suffix}}+)',
            'selector'        => '{{simple_selector}}((\s*\+\s*|\s*>\s*|\s+){{simple_selector}})*',
            'hash'            => '#{{name}}',
            'pseudo'          => ':{{ident}}',
            'class'           => '\.{{ident}}',
            'selector_suffix' => '(?:{{hash}}|{{class}}|{{pseudo}})'
        );
        foreach ($rules as $token => &$regex) {
            while (preg_match('/({{(.+?)}})/', $regex, $matches)) {
                $regex = preg_replace("/$matches[1]/", $rules[$matches[2]], $regex);
            }
        }
        foreach ($regexs as $token => &$regex) {
            while (preg_match('/({{(.+?)}})/', $regex, $matches)) {
                $key = $matches[2];
                if (array_key_exists($key, $rules)) {
                    $replace = $rules;
                } else if (array_key_exists($key, $regexs)) {
                    $replace = $regexs;
                } else {
                    throw new Exception("$key is not defined in lexer.");
                }
                $regex = preg_replace("/$matches[1]/", $replace[$key], $regex);
            }
        }
        $this->regexs = $regexs;

        $this->commands = array(
            'cRDELIM'  => '%\]',
            'cCOMMAND' => '[A-Z\-_]+',
            'cIDENT'   => '[a-z\-_]+',
            'cEQUAL'   => '\s*=',
            'cVALUE'   => '(?:".*?"|' . "'.*?')",
            'SPACE'    => '\s+',
        );
    }

    /**
     *
     */
    public function isComment($buffer) {
        if (preg_match('|^\s*/\*.*?\*/\s*|s', $buffer, $matches)) {
            return $matches[0];
        }
        return false;
    }

    /**
     *
     */
    protected function debug($msg) {
        if ($this->debug) {
            echo $msg . "\n";
        }
    }
}
