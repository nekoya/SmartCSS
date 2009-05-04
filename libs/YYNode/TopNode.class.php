<?php
/**
 *
 */
class YYNode_TopNode extends YYNode {
    /**
     *
     */
    public function publish() {
        $output = '';
        $node = $this;
        while ($node = $node->next) {
            $output .= $node->publish();
        }
        return $output;
    }

    /**
     *
     */
    public function dump() {
        echo 'topnode:' . $this->id . "\n";
        $node = $this;
        while ($node = $node->next) {
            $node->dump(Parser::indent);
        }
    }
}
