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
        $buffer = $c->getTargetFile($this->fileName);
        if ($buffer === false ) $c->failedReadFile();
        $this->content = $this->parseSCSS($buffer);
        $this->publish();
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
