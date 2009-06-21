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
    public function __construct($args) {
        if (!is_array($args) || count($args) !== 3) {
            throw new Exception('Invalid arguments for declaration');
        }
        $this->setProperty($args[0]);
        $this->setExpression($args[1], $args[2]);
    }

    /**
     *
     */
    public function publish() {
        return $this->property . ':' . $this->expr . ';';
    }

    /**
     *
     */
    protected function setProperty($property) {
        $this->property = trim($property);
    }

    /**
     *
     */
    protected function setExpression($expr, $prio) {
        $expr = trim($expr);
        $expr = preg_replace('/\s+/', ' ', $expr);
        $prio = trim($prio);
        if (!empty($prio)) {
            $expr .= ' ' . $prio;
        }
        $this->expr = $expr;
    }
}
