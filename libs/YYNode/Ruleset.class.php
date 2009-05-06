<?php
/**
 *
 */
class YYNode_Ruleset extends YYNode {
    /**
     *
     */
    public function publish() {
        $output = '';
        if ($this->hasItem()) {
            $output .= $this->items->publish();
        }
        if ($this->hasNext()) {
            $output .= $this->next->publish();
        }
        return $output;
    }

    /**
     *
     */
    public function dump($indent) {
        $output = "----\n";
        $output .= str_repeat(' ', $indent*2) . 'ruleset:' . $this->id . "\n";
        if ($this->hasItem()) {
            $output .= $this->items->dump($indent + 1);
        }
        if ($this->hasNext()) {
            $output .= $this->next->dump($indent);
        }
        return $output;
    }
}
