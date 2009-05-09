<?php
/**
 *
 */
class SCSS_YYNode_Empty extends SCSS_YYNode {
    public function publish() {
        $output = '';
        if ($this->hasNext()) {
            $output .= $this->next->publish();
        }
        return $output;
    }
}
