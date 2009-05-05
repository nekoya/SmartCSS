<?php
/**
 *
 */
class YYNode_Expr extends YYNode {
    /**
     *
     */
    public function publish() {
        $output = $this->value;
        if ($this->hasNext()) {
            $output .= $this->next->publish();
        }
        return $output;
    }
}
