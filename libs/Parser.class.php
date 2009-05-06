<?php
/**
 *
 */

class Parser {
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
    public function genRuleset($selector, $declarations) {
        $node = $this->createNode('ruleset');
        $node->items = $selector;
        $selector->items = $declarations;
        $this->debug($selector->value);
        return $node;
    }

    /**
     *
     */
    public function genDeclaration($property, $expr) {
        $node = $this->createNode('declaration');
        $node->items = array($property, $expr);
        $this->debug($property->value);
        return $node;
    }

    /**
     *
     */
    public function __call($method, $args) {
        if (preg_match('/^gen([A-Z][a-z]*)$/', $method, $matches)) {
            $type = strtolower($matches[1]);
            return $this->createNode($type, $args[0]);
        }
        throw new Exception('Method not found.');
    }

    /**
     *
     */
    private function createNode($type, $value = null) {
        //echo "[[$type]]\n";
        $className = 'YYNode_' . ucfirst($type);
        $node = new $className;
        $node->id = $this->lastInsertId++;
        //echo "----\n";
        //var_dump($node, $value);
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
    public function catNode($base, $newone, $combinator = null) {
        if (!$newone instanceof YYNode) {
            return $base;
        }

        $node = $base;
        while ($node->hasNext()) {
            $node = $node->next;
        }
        $node->next = $newone;
        $node->combinator = $combinator;
        $this->debug($node->id . '<-' . $newone->id);
        return $base;
    }

    /**
     *
     */
    public function run() {
        echo $this->topNode->publish();
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
