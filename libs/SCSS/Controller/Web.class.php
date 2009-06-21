<?php
class SCSS_Controller_Web extends SCSS_Controller {
    protected $code;

    /**
     *
     */
    public function getParams() {
        if (!isset($_GET['file'])) $this->notFoundError();
        $filename = $_GET['file'];
        if (empty($filename)) $this->notFoundError();
        return $filename;
    }

    /**
     *
     */
    public function getRealPath($filename) {
        $filename = str_replace("\0", '', $filename);
        if (!preg_match('/\.css$/', $filename)) {
            $this->code = 403;
            throw new Exception('target extension must be .css');
        }

        $filename = preg_replace('/\.css$/', '.scss', $filename);
        $realpath = realpath($filename);
        if ($realpath === false || !file_exists($realpath)) {
            $this->code = 404;
            throw new Exception('file not found.');
        }

        $this->isValidPath($realpath);

        return $realpath;
    }

    /**
     *
     */
    public function isValidPath($path) {
        $basedir = realpath(dirname(__FILE__) . '/../../..');
        $dirname = substr($path, 0, strlen($basedir));
        if ($dirname !== $basedir) {
            $this->code = 403;
            throw new Exception('invalid target path.');
        }
    }

    /**
     *
     */
    public function failedReadFile(Exception $e) {
        $this->header($this->code);
        trigger_error('[ERROR]' . $e->getMessage(), E_USER_ERROR);
    }

    /**
     *
     */
    public function parseError(Exception $e) {
        $this->header(500);
        trigger_error('[ERROR]' . $e->getMessage(), E_USER_ERROR);
    }

    /**
     *
     */
    public function publish($content) {
        header('Content-type: text/css');
        echo $content;
    }

    /**
     *
     */
    public function notFoundError() {
        $this->header(404);
        header('Content-type: text/plain');
        trigger_error('File not found.', E_USER_ERROR);
    }

    /**
     *
     */
    protected function header($code) {
        $messages = array(
            403 => 'HTTP/1.x 403 Forbidden',
            404 => 'HTTP/1.x 404 Not Found',
            500 => 'HTTP/1.x 500 Internal Server Error'
        );
        if (array_key_exists($code, $messages)) {
            header($messages[$code]);
        }
    }
}
