<?php
/**
 *
 */
class YYNode_Selector extends YYNode {
    /**
     *
     */
    public function publish() {
        $output = $this->value;
        if ($this->hasNext()) {
            $output .= ',' . $this->next->publish();
        }
        return $output;
    }
    /**
     *
     */
    public function dump($indent) {
        echo str_repeat(' ', $indent) . 'selector:' . $this->id . ':' . $this->value . "\n";
        if ($this->hasNext()) {
            $this->next->dump($indent);
        }
    }
}
