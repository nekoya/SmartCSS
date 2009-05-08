<?php
/**
 *
 */
class SCSS_YYNode_Ruleset extends SCSS_YYNode {
    /**
     *
     */
    public function publish($prefixes = array('')) {
        if (!is_array($prefixes)) {
            throw new Exception('Prefixes allowed only array.');
        }
        $output = '';
        if ($this->hasChildren()) {
            $selectors    = $this->findSelectors();
            $declarations = $this->findDeclarations();
            $rulesets     = $this->findRulesets();
            $myPrefixes   = $this->parsePrefixes($prefixes, $selectors);
            if ($declarations) {
                $output .= join(', ', $myPrefixes);
                $output .= " { ";
                foreach ($declarations as $declaration) {
                    $output .= $declaration->publish() . ' ';
                }
                $output .= "}\n";
            }
            if ($rulesets) {
                foreach ($rulesets as $ruleset) {
                    $output .= $ruleset->publish($myPrefixes);
                }
            }
        }
        if ($this->hasNext()) {
            $output .= $this->next->publish();
        }
        return $output;
    }

    /**
     *
     */
    public function dump($indent) {
        $output = "----\n";
        $output .= str_repeat(' ', $indent*2) . 'ruleset:' . $this->id . "\n";
        if ($this->hasChildren()) {
            $selectors    = $this->findSelectors();
            $declarations = $this->findDeclarations();
            $rulesets     = $this->findRulesets();
            if ($declarations) {
                foreach ($selectors as $selector) {
                    $output .= $selector->dump($indent + 1);
                }
                foreach ($declarations as $declaration) {
                    $output .= $declaration->dump($indent + 1);
                }
            }
            if ($rulesets) {
                foreach ($selectors as $selector) {
                    $output .= $selector->dump($indent + 1);
                }
                foreach ($rulesets as $ruleset) {
                    $output .= $ruleset->dump($indent + 1);
                }
            }
        }
        if ($this->hasNext()) {
            $output .= $this->next->dump($indent);
        }
        return $output;
    }

    /**
     *
     */
    protected function parsePrefixes($prefixes, $selectors) {
        $values = array();
        foreach ($prefixes as $prefix) {
            if ($prefix !== '') {
                $prefix .= ' ';
            }
            foreach ($selectors as $selector) {
                array_push($values, $prefix . $selector->value);
            }
        }
        return $values;
    }

    /**
     *
     */
    protected function findSelectors() {
        if (!$this->hasChildren()) {
            throw new Exception('Ruleset has not child.');
        }
        $nodes = array();
        $node = $this->children[0];
        do {
            if (!$node instanceof SCSS_YYNode_Selector) {
                throw new Exception('Invalid selector node.');
            }
            array_push($nodes, $node);
        } while ($node = $node->next);
        return $nodes;
    }

    /**
     *
     */
    protected function findDeclarations() {
        if (!$this->hasChildren()) {
            throw new Exception('Ruleset has not child.');
        }
        $nodes = array();
        $node = $this->children[1];
        do {
            if ($node instanceof SCSS_YYNode_Declaration) {
                array_push($nodes, $node);
            } else if (!$node instanceof SCSS_YYNode_Ruleset) {
                throw new Exception('Found invalid node in ruleset.');
            }
        } while ($node = $node->next);
        return $nodes;
    }

    /**
     *
     */
    protected function findRulesets() {
        if (!$this->hasChildren()) {
            throw new Exception('Ruleset has not child.');
        }
        $nodes = array();
        $node = $this->children[1];
        do {
            if ($node instanceof SCSS_YYNode_Ruleset) {
                array_push($nodes, $node);
            } else if (!$node instanceof SCSS_YYNode_Declaration) {
                throw new Exception('Found invalid node in ruleset.');
            }
        } while ($node = $node->next);
        return $nodes;
    }
}
