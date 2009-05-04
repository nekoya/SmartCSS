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
        $output  = $selector->publish() . " {\n";
        $output .= $declarations->publish();
        $output .= "}\n";
        return $output;
    }

    /**
     *
     */
    public function dump($indent) {
        echo str_repeat(' ', $indent) . 'ruleset:' . $this->id . "\n";
        foreach ($this->items as $node) {
            $node->dump($indent + Parser::indent);
        }
    }
}
