<?php
/**
 *
 */
class YYNode_TopNode extends YYNode {
    /**
     *
     */
    public function dump() {
        echo 'topnode:' . $this->id . "\n";
        $node = $this;
        while ($node = $node->next) {
            $node->dump(1);
        }
    }
}
