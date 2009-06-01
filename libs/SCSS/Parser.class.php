<?php
/**
 *
 */

class SCSS_Parser {
    static private $instance;
    protected $lastInsertId = 0;
    protected $topNode;
    protected $nodes = array();
    public $vars = array();
    public $debug;

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
    protected function __construct() {
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
    public function genRuleset($selector, $declarations) {
        $node = $this->createNode('ruleset');
        $node->children = array($selector, $declarations);
        return $node;
    }

    /**
     *
     */
    public function genDeclaration($property, $expr) {
        $node = $this->createNode('declaration');
        $this->debug(" - $property:$expr");
        $node->property = trim($property);
        $node->expr = trim($expr);
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
        throw new Exception("Method $method not found.");
    }

    /**
     *
     */
    protected function createNode($type, $value = null) {
        //echo "[[$type]]\n";
        $className = 'SCSS_YYNode_' . ucfirst($type);
        $node = new $className;
        $node->id = $this->lastInsertId++;
        //echo "----\n";
        //var_dump($node, $value);
        if (!is_null($value)) {
            $node->value = (string)$value;
        }
        array_push($this->nodes, $node);
        $this->debug($node->id. ": create $type:" . $node->value);
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

        if (!$newone instanceof SCSS_YYNode) {
            // skip $newone (ex: catNode(decl, ';'))
            return $base;
        }
        $node = $base;
        if (!is_object($node) || !$node instanceof SCSS_YYNode) {
            var_dump($base, $node);
            throw new Exception('Is not node object');
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
        return $this->topNode->publish();
    }

    /**
     *
     */
    public function debug($msg) {
        if ($this->debug) {
            echo $msg . "\n";
        }
    }

    /**
     *
     */
    public function reset() {
        $this->lastInsertId = 0;
        $this->topNode = null;
        $this->nodes = array();
    }

    /**
     *
     */
    public function setVar($var, $value) {
        $this->vars[$var] = $value;
        return $value;
    }

    /**
     *
     */
    public function getVar($var) {
        return isset($this->vars[$var]) ? $this->vars[$var] : '';
    }

}
