<?php
/**
 *
 */
abstract class SCSS_Controller {
    protected $lexer;
    protected $parser;
    protected $debug;

    /**
     *
     */
    public function __construct() {
        $this->lexer  = new SCSS_Lexer();
        $this->parser = new SCSS_Parser();
    }

    /**
     *
     */
    public function run() {
        $filename = $this->getParams();
        try {
            $realpath = $this->getRealPath($filename);
        } catch (Exception $e) {
            $this->failedReadFile($e);
        }
        chdir(dirname($realpath));
        $buffer = file_get_contents($realpath);
        $content = $this->parseSCSS($buffer);
        $this->publish($content);
    }

    /**
     *
     */
    protected function parseSCSS($buffer) {
        $this->lexer->setBuffer($buffer);
        if ($this->debug) {
            $this->parser->debug = true;
        }
        try {
            $this->parser->yyparse($this->lexer);
            return $this->parser->run();
        } catch ( Exception $e ) {
            $this->parseError($e);
        }
    }

    abstract public function getParams();
    abstract public function getRealPath($filename);
    abstract public function failedReadFile(Exception $e);
    abstract public function parseError(Exception $e);
    abstract public function publish($content);
}
