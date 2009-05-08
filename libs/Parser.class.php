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
    public function setTopNode($node) {
        $this->topNode = $node;
        return $node;
    }

    /**
     *
     */
    public function genImport($target, $media) {
        $value = $target . ($media ? " $media" : '') . ';';
        return $this->createNode('import', $value);
    }

    /**
     *
     */
    public function genRuleset($selector, $declarations) {
        $node = $this->createNode('ruleset');
        $node->children = array($selector, $declarations);
        $this->debug($selector->value);
        return $node;
    }

    /**
     *
     */
    public function genDeclaration($property, $expr, $prio = null) {
        $node = $this->createNode('declaration');
        $node->children = array($property, $expr);
        if ($prio instanceof YYNode) {
            $this->catNode($expr, $prio);
        }
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
    public function catNode($base, $newone) {
        if (is_array($newone)) {
            foreach ($newone as $node) {
                $this->catNode($base, $node);
            }
        }

        if (!$newone instanceof YYNode) {
            // skip $newone (ex: catNode(decl, ';'))
            return $base;
        }
        $node = $base;
        if (!is_object($node) || !$node instanceof YYNode) {
            var_dump($base, $node);
            throw new Exception('Node is not YYNode object');
        }
        while ($node->hasNext()) {
            $node = $node->next;
        }
        $node->next = $newone;
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
