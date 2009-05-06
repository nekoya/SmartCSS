<?php
/**
 *
 */
abstract class YYnode {
    public $id;
    public $value;
    public $child;
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
    public function hasChild() {
        return (empty($this->child)) ? false : true;
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
        $output = $this->value;
        if ($this->hasNext()) {
            $output .= $this->next->publish();
        }
        return $output;
    }

    /**
     *
     */
    public function dump($indent = 0) {
        $className = get_class($this);
        $name = strtolower(preg_replace('/^YYNode_/', '', $className));
        $output  = str_repeat(' ', $indent);
        $output .= $name . ':' . $this->id . "\n";
        if ($this->hasNext()) {
            $output .= $this->next->dump($indent + 1);
        }
        return $output;
    }
}
