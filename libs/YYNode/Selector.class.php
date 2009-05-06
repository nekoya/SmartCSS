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
            $output .= ',' . $this->next->value;
        }
        $output .= ' { ';
        if ($this->hasChildren()) {
            $output .= $this->children->publish();
        }
        $output .= " }\n";
        return $output;
    }

    /**
     *
     */
    public function dump($indent) {
        return str_repeat(' ', $indent * 2) . 'selector:' . $this->id . ':' . $this->value . "\n";
    }
}
