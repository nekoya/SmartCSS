<?php
class SCSS_Controller_Web extends SCSS_Controller {
    protected $code;

    /**
     *
     */
    protected function getParams() {
        if (!isset($_GET['file'])) $this->notFoundError();
        $filename = $_GET['file'];
        if (empty($filename)) $this->notFoundError();
        return $filename;
    }

    /**
     *
     */
    protected function getRealPath($filename) {
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

        $basedir = realpath(dirname(__FILE__) . '/../../..');
        $dirname = substr($realpath, 0, strlen($basedir));
        if ($dirname !== $basedir) {
            $this->code = 403;
            throw new Exception('invalid target path.');
        }

        return $realpath;
    }

    /**
     *
     */
    protected function failedReadFile(Exception $e) {
        $this->header($this->code);
        die('[ERROR]' . $e->getMessage() . PHP_EOL);
    }

    /**
     *
     */
    protected function parseError(Exception $e) {
        $this->header(500);
        die('[ERROR]' . $e->getMessage() . PHP_EOL);
    }

    /**
     *
     */
    protected function publish($content) {
        header('Content-type: text/css');
        echo $content;
    }

    /**
     *
     */
    protected function notFoundError() {
        $this->header(404);
        header('Content-type: text/plain');
        die('File not found.');
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
