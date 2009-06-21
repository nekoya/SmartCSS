<?php
class SCSS_Controller_Web extends SCSS_Controller {
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
        if (empty($filename)) return false;

        $filename = str_replace("\0", '', $filename);
        if (!preg_match('/\.css$/', $filename)) return false;
        $filename = preg_replace('/\.css$/', '.scss', $filename);

        $realpath = realpath($filename);
        if ($realpath === false) return false;
        if (!file_exists($realpath)) return false;

        $basedir = realpath(dirname(__FILE__) . '/../../..');
        $dirname = substr($realpath, 0, strlen($basedir));
        if ($dirname !== $basedir) return false;

        return $realpath;
    }

    /**
     *
     */
    protected function failedReadFile(Exception $e) {
        $this->notFoundError();
    }

    /**
     *
     */
    protected function parseError(Exception $e) {
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
        header('HTTP/1.0 404 Not Found');
        header('Content-type: text/plain');
        die('File not found.');
    }
}
