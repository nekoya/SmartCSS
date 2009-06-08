<?php
/**
 *
 */
class SCSS_Command_Import extends SCSS_Command {
    /**
     *
     */
    public function __construct($filename) {
        if ( empty($filename) ) {
            throw new Exception('Need target filename');
        }
    }
}
