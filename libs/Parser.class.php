<?php
/**
 *
 */

class Parser {
    const indent = 2;
    static private $instance;
    public $lastInsertId = 0;
    public $topNode;
    public $nodes = array();
    public $debug;

    /**
     *
     */
    protected function __construct() {
    }

    /**
     *
     */
    static public function getInstance() {
        if (self::$instance === null) {
            $className = __CLASS__;
            self::$instance = new $className();
        }
        return self::$instance;
    }

    /**
     *
     */
    public function setTopNode() {
        $node = $this->createNode('topnode');
        $this->topNode = $node;
        return $node;
    }

    /**
     *
     */
    public function addRuleset($selector, $declarations) {
        $node = $this->createNode('ruleset');
        $node->items = array($selector, $declarations);
        $this->debug($selector->value);
        return $node;
    }

    /**
     *
     */
    public function addSelector($name) {
        return $this->createNode('selector', $name);
    }

    /**
     *
     */
    public function addDeclaration($property, $expr) {
        $node = $this->createNode('declaration');
        $node->items = array($property, $expr);
        $this->debug($property->value);
        return $node;
    }

    /**
     *
     */
    public function addProperty($name) {
        return $this->createNode('property', $name);
    }

    /**
     *
     */
    public function addExpr($name) {
        return $this->createNode('expr', $name);
    }

    /**
     *
     */
    private function createNode($type, $value = null) {
        $className = 'YYNode_' . ucfirst($type);
        $node = new $className;
        $node->id = $this->lastInsertId++;
        if (!is_null($value)) {
            $node->value = (string)$value;
        }
        array_push($this->nodes, $node);
        $this->debug("create $type:" . $node->id);
        return $node;
    }

    /**
     *
     */
    public function catNode($base, $newone) {
        $node = $base;
        while ($node->hasNext()) {
            $node = $node->next;
        }
        $node->next = $newone;
        $this->debug($base->id . '<-' . $newone->id);
        return $base;
    }

    /**
     *
     */
    public function run() {
        echo $this->topNode->dump();
    }

    /**
     *
     */
    public function debug($msg) {
        if ($this->debug) {
            echo $msg . "\n";
        }
    }

}
