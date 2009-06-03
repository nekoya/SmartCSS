<?php
/**
 *
 */
class SCSS_YYNode_Declaration extends SCSS_YYNode {
    public $property;
    public $expr;

    /**
     *
     */
    public function publish() {
        return $this->property . ':' . $this->expr . ';';
    }
}
