<?php
/**
 *
 */
class YYNode_Ruleset extends YYNode {
    /**
     *
     */
    public function publish() {
        $selector    = $this->items;
        $declaration = $selector->items;
        $output  = $selector->publish() . " {";
        $output .= $declaration->publish();
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
        $selector    = $this->items;
        $declaration = $selector->items;
        $output  = str_repeat(' ', $indent*2) . 'ruleset:' . $this->id . "\n";
        $output .= $selector->dump($indent + 1);
        $output .= $declaration->dump($indent + 1);
        if ($this->hasNext()) {
            $output .= $this->next->dump($indent);
        }
        return $output;
    }
}
