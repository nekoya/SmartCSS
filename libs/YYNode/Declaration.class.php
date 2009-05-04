<?php
/**
 *
 */
class YYNode_Declaration extends YYNode {
    /**
     *
     */
    public function publish() {
        list($property, $expr) = $this->items;
        $output = $property->publish() . ':' . $expr->publish() . ";\n";
        if ($this->hasNext()) {
            $output .= $this->next->publish();
        }
        return $output;
    }

    /**
     *
     */
    public function dump($indent) {
        $property = $this->items[0]->value;
        echo str_repeat(' ', $indent) . 'declaration:' . $this->id . ':' . $property . "\n";
        if ($this->hasNext()) {
            $this->next->dump($indent);
        }
    }
}
