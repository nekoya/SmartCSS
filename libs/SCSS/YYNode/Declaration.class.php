<?php
/**
 *
 */
class SCSS_YYNode_Declaration extends SCSS_YYNode {
    public $property;
    public $expr;

    /**
     *
     */
    public function publish() {
        return $this->property . ':' . $this->expr . ';';
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
