<?php
/**
 *
 */
class SCSS_YYNode_Selector extends SCSS_YYNode {
    public $parent;
    public $selectors = array();

    /**
     *
     */
    public function __construct($value) {
        $value = preg_replace('/\s+/', ' ', $value);
        $value = preg_replace('/\s*,\s*/', ',', $value);
        $this->selectors = explode(',', $value);
    }

    /**
     *
     */
    public function publish() {
        return join(', ', $this->getSelectors());
    }

    /**
     *
     */
    public function getSelectors() {
        if (is_null($this->parent)) {
            return $this->selectors;
        }

        $parents = $this->parent->getSelectors();
        foreach ($parents as $parent) {
            foreach ($this->selectors as $selector) {
                $selectors[] = "$parent $selector";
            }
        }
        return $selectors;
    }
}
