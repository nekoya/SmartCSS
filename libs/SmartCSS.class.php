<?php
require 'SCSS/AutoLoader.class.php';

class SmartCSS {
    static public $debug;
    static public $compress;
    static public $strict;

    public function run() {
        $c = $this->getController();
        $c->run();
    }

    public function getController() {
        if ($this->callAsCLI()) {
            return new SCSS_Controller_CLI();
        } else {
            return new SCSS_Controller_Web();
        }
    }

    public function callAsCLI() {
        $console = new Console_Getopt;
        $args = $console->readPHPArgv();
        return PEAR::isError($args) ? false : true;
    }
}
