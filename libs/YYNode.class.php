<?php
/**
 *
 */
abstract class YYnode {
    public $id;
    public $value;
    public $items;
    public $next;

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
    abstract function publish();

    /**
     *
     */
    public function dump() {
        $className = get_class($this);
        $name = strtolower(preg_replace('/^YYNode_/', '', $className));
        echo $name . ':' . $this->id . "\n";
    }
}
