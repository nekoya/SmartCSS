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
        list($property, $expr) = $this->items;
        echo str_repeat(' ', $indent) . 'declaration:' . $this->id . "\n";
        echo str_repeat(' ', $indent + Parser::indent) . 'property:' . $property->id . ':' . $property->value . "\n";
        echo str_repeat(' ', $indent + Parser::indent) . 'expr:' . $expr->id . ':' . $expr->value . "\n";
        if ($this->hasNext()) {
            $this->next->dump($indent);
        }
    }
}
