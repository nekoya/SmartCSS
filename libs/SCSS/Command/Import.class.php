<?php
/**
 *
 */
class SCSS_Command_Import extends SCSS_Command {
    protected $filename;

    /**
     *
     */
    public function __construct($parser, $params) {
        parent::__construct($parser, $params);
        $this->filename = isset($params[0]) ? $this->trimValue($params[0]) : '';
        if (empty($this->filename)) {
            throw new Exception('Need target filename');
        }
    }

    /**
     *
     */
    public function execute() {
        $content = $this->getTargetFile($this->filename);
        $lexer = $this->parser->lex;
        if (!empty($lexer)) {
            $lexer->prependBuffer($content);
        }
        return $content;
    }

    /**
     *
     */
    protected function getTargetFile($filename) {
        $filename = str_replace("\0", '', $filename);
        if (!preg_match('/\.scss$/', $filename)) {
            throw new Exception('IMPORT filename must be .scss');
        }

        $realpath = realpath($filename);
        if ($realpath === false || !file_exists($realpath)) {
            throw new Exception('IMPORT file not found');
        }

        $basedir = realpath(dirname(__FILE__) . '/../../..');
        $dirname = substr($realpath, 0, strlen($basedir));
        if ($dirname !== $basedir) {
            throw new Exception('IMPORT invalid basedir');
        }

        return file_get_contents($realpath);
    }
}
