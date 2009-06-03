<?php
/**
 *
 */
class SCSS_YYNode_Ruleset extends SCSS_YYNode {
    /**
     *
     */
    public function publish($prefixes = null) {
        $isChild = true;
        if (is_null($prefixes)) {
            $prefixes = array('');
            $isChild = false;
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
        // child rulesets published by parent node
        if (!$isChild && $this->hasNext()) {
            $output .= $this->next->publish();
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
