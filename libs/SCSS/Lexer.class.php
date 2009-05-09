<?php
/**
 *
 */
class SCSS_Lexer {
    static private $instance;
    protected $regexs;
    protected $states;
    protected $debug;

    /**
     *
     */
    static public function getInstance() {
        if (self::$instance === null) {
            $className = __CLASS__;
            self::$instance = new $className();
        }
        return self::$instance;
    }

    /**
     *
     */
    public function __construct() {
        $this->initalize();
    }

    /**
     *
     */
    protected function initalize() {
        $this->defineRegexs();
        $this->states = array(
            'ruleset' => 0,
        );
    }

    /**
     *
     */
    public function yylex() {
        global $lexbuf, $yylval;
        $parser = SCSS_Parser::getInstance();

        while ($lexbuf) {
            if ($this->debug) {
                //var_dump($lexbuf);
            }

            foreach ($this->regexs as $token => $regex) {
                $regex = '/^('.$regex.')/i';
                if (preg_match($regex, $lexbuf, $matches)) {
                    if ($this->debug) {
                        var_dump($matches);
                    }
                    $yylval = (string)$matches[1];
                    $lexbuf = substr($lexbuf, strlen($yylval));
                    switch ($token) {
                    case 'COMMENT':
                        continue 3;

                    case 'LBRACE':
                        $this->states['ruleset']++;
                        break;

                    case 'RBRACE':
                        $this->states['ruleset']--;
                        break;

                    case 'EXPRESSION':
                        if (!$this->states['ruleset']) {
                            $lexbuf = $yylval . $lexbuf;
                            continue 2;
                        }
                        break;
                    }
                    $this->debug($token . ' ' . $yylval);
                    return $token;
                }
            }
            // unmatched regexs
            $this->debug('token unmatched');
            $yylval = ord($lexbuf);
            $lexbuf = substr($lexbuf, 1);
            return $yylval;
        }
    }

    /**
     *
     */
    protected function defineRegexs() {
        $regexs = array(
            'LBRACE'        => '\s*{\s*',
            'RBRACE'        => '\s*}\s*',

            // only enable between LBRACE and RBRACE
            'EXPRESSION'    =>
            '(?:'.
            '(?:'.
            '{{unary_operator}}{{PERCENTAGE}}|'.
            '{{unary_operator}}{{LENGTH}}|'.
            '{{unary_operator}}{{EMS}}|'.
            '{{unary_operator}}{{EXS}}|'.
            '{{unary_operator}}{{ANGLE}}|'.
            '{{unary_operator}}{{TIME}}|'.
            '{{unary_operator}}{{FREQ}}|'.
            '{{unary_operator}}{{NUMBER}}|'.
            '{{URI}}|'.
            '{{HEXCOLOR}}|'.
            '{{IDENT}}|'.
            '{{STRING}}'.
            ')'.
            '\s*)+'.
            '({{IMPORTANT_SYM}})?'.
            '(?:;\s*|(?=}))',

            'DECLARATION'   => '{{ident}}\s*:\s*{{EXPRESSION}}',

            'SELECTOR'      => '(?:(?:{{ident}}|\*){{selector_suffix}}*|{{selector_suffix}}+)',

            'COMMENT'       => '\s*\/\*.*?\*\/\s*',
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
            'GREATER'       => '\s*\>',
            'ASTERISK'      => '\*',
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
