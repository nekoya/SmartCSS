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
    public function setProperty($property) {
        $this->property = trim($property);
    }

    /**
     *
     */
    public function setExpression($expr, $prio) {
        $expr = trim($expr);
        $expr = preg_replace('/\s+/', ' ', $expr);
        $prio = trim($prio);
        if (!empty($prio)) {
            $expr .= ' ' . $prio;
        }
        $this->expr = $expr;
    }
}
