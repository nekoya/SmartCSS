<?php
require 'SCSS/AutoLoader.class.php';

class SmartCSS {
    protected $debug = false;
    protected $content;

    public function run() {
        if ($this->callAsCLI()) {
            $c = new SCSS_Getopt_CLI();
        } else {
            $c = new SCSS_Getopt_Web();
        }
        $this->fileName = $c->getParams();
        $realpath = $c->getRealPath($this->fileName);
        if ($realpath === false ) $c->failedReadFile();
        chdir(dirname($realpath));
        $buffer = file_get_contents($realpath);
        $this->content = $this->parseSCSS($buffer);
        $c->publish($this->content);
    }

    public function callAsCLI() {
        $console = new Console_Getopt;
        $args = $console->readPHPArgv();
        return PEAR::isError($args) ? 0 : 1;
    }

    public function publish() {
        echo $this->content;
    }

    public function parseSCSS($buffer) {
        $parser = new SCSS_Parser();
        $lexer  = new SCSS_Lexer();
        $lexer->setBuffer($buffer);
        if ($this->debug) {
            //$lexer->debug = true;
            $parser->debug = true;
        }
        try {
            $parser->yyparse($lexer);
            return $parser->run();
        } catch ( Exception $e ) {
            die('[ERROR]' . $e->getMessage() . PHP_EOL);
        }
    }
}
