<?php
/**
 *
 */
class YYNode_TopNode extends YYNode {
    /**
     *
     */
    public function dump() {
        $output = 'topnode:' . $this->id . "\n";
        $node = $this;
        while ($node = $node->next) {
            $output .= $node->dump(1);
        }
        return $output;
    }
}
