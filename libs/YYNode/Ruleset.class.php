<?php
/**
 *
 */
class YYNode_Ruleset extends YYNode {
    /**
     *
     */
    public function publish() {
        list($selector, $declarations) = $this->items;
        $output  = $selector->publish() . " {";
        $output .= $declarations->publish();
        $output .= "}\n";
        if ($this->hasNext()) {
            $output .= $this->next->publish();
        }
        return $output;
    }

    /**
     *
     */
    public function dump($indent) {
        $output = str_repeat(' ', $indent*2) . 'ruleset:' . $this->id . "\n";
        foreach ($this->items as $node) {
            $output .= $node->dump($indent + 1);
        }
        if ($this->hasNext()) {
            $output .= $this->next->dump($indent);
        }
        return $output;
    }
}
