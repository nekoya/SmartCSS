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

    /**
     *
     */
    protected function trimValue($value) {
        if (preg_match('/^(".*?"|\'.*?\')$/', $value)) {
            $value = substr($value, 1);
            $value = substr($value, 0, strlen($value)-1);
        }
        return $value;
    }
}
