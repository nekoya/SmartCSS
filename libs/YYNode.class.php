<?php
/**
 *
 */
abstract class YYnode {
    public $id;
    public $value;
    public $items;
    public $next;
    public $combinator;

    /**
     *
     */
    public function __construct() {
    }

    /**
     *
     */
    public function getType() {
        $className = get_class($this);
        $type = preg_replace('/^YYNode_/', '', $className);
        return strtolower($type);
    }

    /**
     *
     */
    public function hasNext() {
        return (empty($this->next)) ? false : true;
    }

    /**
     *
     */
    public function appendValue() {
        $args = func_get_args();
        foreach ($args as $arg) {
            $this->value .= (is_object($arg)) ? $arg->value : $arg;
        }
    }

    /**
     *
     */
    public function publish() {
        return $this->value;
    }

    /**
     *
     */
    public function dump() {
        $className = get_class($this);
        $name = strtolower(preg_replace('/^YYNode_/', '', $className));
        echo $name . ':' . $this->id . "\n";
    }
}
