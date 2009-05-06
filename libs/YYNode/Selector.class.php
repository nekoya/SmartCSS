<?php
/**
 *
 */
class YYNode_Selector extends YYNode {
    /**
     *
     */
    public function dump($indent) {
        return str_repeat(' ', $indent * 2) . 'selector:' . $this->id . ':' . $this->value . "\n";
    }
}
