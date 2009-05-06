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
        $output = str_repeat(' ', $indent * 2) . 'selector:' . $this->id . ':' . $this->value . "\n";
        if ($this->hasChildren()) {
            $output .= $this->children->dump($indent + 1);
        }
        if ($this->hasNext()) {
            $output .= $this->next->dump($indent);
        }
        return $output;
    }
}
