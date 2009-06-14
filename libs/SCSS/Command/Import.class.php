<?php
/**
 *
 */
class SCSS_Command_Import extends SCSS_Command {
    protected $filename;

    /**
     *
     */
    protected function initialize($params) {
        $this->filename = isset($params[0]) ? $this->trimValue($params[0]) : '';
        if (empty($this->filename)) {
            throw new Exception('Need target filename');
        }
    }

    /**
     *
     */
    public function execute() {
        $realpath = $this->getRealPath($this->filename);
        $content = file_get_contents($realpath);
        $this->parser->pushd(dirname($realpath));
        $lexer = $this->parser->lex;
        if (!empty($lexer)) {
            $lexer->prependBuffer($content . '[% POPD %]');
        }
        return $content;
    }

    /**
     *
     */
    protected function getRealPath($filename) {
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

        return $realpath;
    }
}
