<?php
/**
 *
 */
class SCSS_YYNode_Charset extends SCSS_YYNode {
    /**
     *
     */
    public function __construct($encoding) {
        $encoding = preg_replace('/^(\'|")(.*)(\'|")$/', "$2", $encoding);
        $this->value = $encoding;
        mb_internal_encoding($encoding);
    }

    /**
     *
     */
    public function publish() {
        $output = '@charset "' . $this->value . '";' . PHP_EOL;
        if ($this->hasNext()) {
            $output .= $this->next->publish();
        }
        return $output;
    }
}
