<?php
/**
 *
 */
class SCSS_YYNode_Selector extends SCSS_YYNode {
    /**
     *
     */
    public function dump($indent) {
        return str_repeat(' ', $indent * 2) . 'selector:' . $this->id . ':' . $this->value . "\n";
    }
}