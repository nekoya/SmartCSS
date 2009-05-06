<?php
/**
 *
 */
class YYNode_Declaration extends YYNode {
    /**
     *
     */
    public function publish() {
        if ($this->hasChildren()) {
            list($property, $expr) = $this->children;
            $output = $property->publish() . ':' . $expr->publish() . ";";
        }
        return $output;
    }

    /**
     *
     */
    public function dump($indent) {
        list($property, $expr) = $this->children;
        $output = str_repeat(' ', $indent*2) . 'declaration:' . $this->id . "\n";
        //echo str_repeat(' ', $indent + Parser::indent) . 'property:' . $property->id . ':' . $property->value . "\n";
        //echo str_repeat(' ', $indent + Parser::indent) . 'expr:' . $expr->id . ':' . $expr->value . "\n";
        return $output;
    }
}
