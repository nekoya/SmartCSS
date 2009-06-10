<?php
class SCSS_Getopt_Web {
    public function getParams() {
        if (!isset($_GET['file'])) $this->notFoundError();
        $filename = $_GET['file'];
        if (empty($filename)) $this->notFoundError();
        return $filename;
    }

    protected function notFoundError() {
        header('HTTP/1.0 404 Not Found');
        header('Content-type: text/plain');
        die('File not found.');
    }

    public function getTargetFile($filename) {
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

        return file_get_contents($realpath);
        $this->notFoundError();
    }

    public function failedReadFile() {
        $this->notFoundError();
    }
}
