<?php
/**
 *
 */
class SCSS_Lexer {
    static private $instance;
    protected $regexs;
    protected $commands;
    protected $state;
    public $debug;
    public $lexbuf;

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
        $this->state = 'ruleset';
    }

    /**
     *
     */
    public function setBuffer($lexbuf) {
        $lexbuf = preg_replace('/^\s*(.*?)\s*$/m', '$1', $lexbuf);
        $lexbuf = preg_replace('/[\r\n]/', '', $lexbuf);
        $this->lexbuf = $lexbuf;
    }

    /**
     *
     */
    public function yylex() {
        global $yylval;
        $parser = SCSS_Parser::getInstance();

        while ($this->lexbuf) {
            if ($this->debug) {
                //var_dump($this->lexbuf);
            }

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

            foreach ($regexs as $token => $regex) {
                $regex = '/^(' . $regex . ')/' . $options;
                if (preg_match($regex, $this->lexbuf, $matches)) {
                    if ($this->debug) {
                        //var_dump($matches);
                    }
                    $yylval = (string)$matches[1];
                    $this->lexbuf = substr($this->lexbuf, strlen($yylval));

                    switch ($token) {
                    case 'COMMENT':
                        if ($this->debug) {
                            echo "SKIP COMMENT\n";
                        }
                        continue 3;
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
            $this->lexbuf = substr($this->lexbuf, 1);
            $this->debug('token unmatched ' . chr($yylval));
            return $yylval;
        }
    }

    /**
     *
     */
    protected function defineRegexs() {
        $regexs = array(
            'cLDELIM'        => '\[%',

            'LBRACE'        => '\s*{',
            'RBRACE'        => '}',

            'SELECTOR'      => '{{simple_selector}}((\s*\+\s*|\s*>\s*|\s+){{simple_selector}})*(?=\s*[,{])',

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
            'SPACE'    => '\s+',
        );
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
