<?php
/**
 *
 */
abstract class SCSS_Command {
    protected $parser;

    /**
     *
     */
    public function __construct($parser, $params) {
        $this->parser = $parser;
    }

    /**
     *
     */
    public function execute() {
    }
}
