<?php
/**
 *
 */
class SCSS_YYNode_Selector extends SCSS_YYNode {
    /**
     *
     */
    public function publish() {
        return preg_replace('/\s+/', '', $this->value);
    }
}
