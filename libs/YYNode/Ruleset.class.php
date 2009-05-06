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
        if ($this->hasChild()) {
            $output .= $this->child->publish();
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
        if ($this->hasChild()) {
            $output .= $this->child->dump($indent + 1);
        }
        if ($this->hasNext()) {
            $output .= $this->next->dump($indent);
        }
        return $output;
    }
}
