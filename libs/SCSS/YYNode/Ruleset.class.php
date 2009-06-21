<?php
/**
 *
 */
class SCSS_YYNode_Ruleset extends SCSS_YYNode {
    /**
     * parent ruleset
     */
    public $parent;

    /**
     * selector
     */
    public $selector;

    /**
     * all declarations
     */
    public $declarations = array();

    /**
     * first child ruleset
     *
     * publishing second or more rulesets by first child.
     */
    public $firstChild;

    /**
     *
     */
    public function __construct($args) {
        if (!is_array($args) || count($args) !== 2) {
            throw new Exception('Invalid arguments for ruleset');
        }
        $this->setSelector($args[0]);
        $this->setDeclarations($args[1]);
    }

    /**
     *
     */
    protected function setSelector($selector) {
        if (!$selector instanceof SCSS_YYNode_Selector) {
            throw new Exception('Invalid selector node for ruleset');
        }
        $this->selector = $selector;
    }

    /**
     *
     */
    protected function setDeclarations($node) {
        do {
            if ($node instanceof SCSS_YYNode_Ruleset) {
                $node->selector->parent = $this->selector;
                if (!$this->firstChild) {
                    $this->firstChild = $node;
                }
            } else if ($node instanceof SCSS_YYNode_Declaration) {
                $this->declarations[] = $node;
            } else {
                throw new Exception('Invalid ruleset/declaration node for ruleset');
            }
        } while ($node = $node->next);
    }

    /**
     *
     */
    public function publish() {
        $output = '';
        if ($this->declarations) {
            $output .= $this->selector->publish() . ' {';
            foreach ($this->declarations as $declaration) {
                $output .= ' ' . $declaration->publish();
            }
            $output .= ' }' . PHP_EOL;
        }
        if ($this->firstChild) {
            $output .= $this->firstChild->publish();
        }
        $output .= $this->publishNextRuleset();
        return $output;
    }

    /**
     *
     */
    public function publishNextRuleset() {
        $node = $this;
        while ($node = $node->next) {
            if ($node instanceof SCSS_YYNode_Ruleset) {
                return $node->publish();
            }
        }
    }
}
