<?php
/**
 *
 */

class Generator {
    /**
     *
     */
    public function __call($method, $args) {
        $parser = Parser::getInstance();
        $parsrt->method($args);
    }
}
