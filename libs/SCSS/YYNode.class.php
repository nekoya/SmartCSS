<?php
/**
 *
 */
abstract class SCSS_YYnode {
    public $id;
    public $value;
    public $children;
    public $next;
    protected $prefixValue;
    protected $suffixValue;

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
        $type = preg_replace('/^SCSS_YYNode_/', '', $className);
        return strtolower($type);
    }

    /**
     *
     */
    public function hasChildren() {
        return (empty($this->children)) ? false : true;
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
        $output = $this->prefixValue . $this->value . $this->suffixValue;
        if ($this->hasNext()) {
            $output .= $this->next->publish();
        }
        return $output;
    }
}
