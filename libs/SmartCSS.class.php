<?php
require 'SCSS/AutoLoader.class.php';

class SmartCSS {
    protected $debug = false;
    protected $content;

    public function run() {
        $this->parser = new SCSS_Parser();
        $this->lexer  = new SCSS_Lexer();

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
        $this->lexer->setBuffer($buffer);
        if ($this->debug) {
            $this->lexer->debug = true;
            $this->parser->debug = true;
        }
        try {
            $this->parser->yyparse($this->lexer);
            return $this->parser->run();
        } catch ( Exception $e ) {
            die('[ERROR]' . $e->getMessage() . PHP_EOL);
        }
    }
}
