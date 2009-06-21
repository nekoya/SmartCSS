<?php
class SCSS_Controller_CLI extends SCSS_Controller {
    /**
     *
     */
    public function getParams() {
        $short_opts = 'hd';
        $long_opts  = array('help');

        $console = new Console_Getopt;
        $args = $console->readPHPArgv();
        $opts = $console->getopt($args, $short_opts, $long_opts);
        if (PEAR::isError($opts)) {
            echo $opts->getMessage() . PHP_EOL;
            $this->usage(1);
        }

        foreach ($opts[0] as $opt) {
            if ($opt[0] === '--help' || $opt[0] === 'h') {
                $this->usage();
            }
            if ($opt[0] === 'd') {
                $this->debug = true;
            }
        }

        if (empty($opts[1])) $this->usage();
        $filename = $opts[1][0];
        if (empty($filename)) $this->usage();
        return $filename;
    }

    /**
     *
     */
    public function getRealPath($filename) {
        $filename = str_replace("\0", '', $filename);
        if (!preg_match('/\.scss$/', $filename)) {
            throw new Exception('target extension must be .scss');
        }

        $realpath = realpath($filename);
        if ($realpath === false || !file_exists($filename)) {
            throw new Exception('file not found.');
        }

        return $realpath;
    }

    /**
     *
     */
    public function failedReadFile(Exception $e) {
        die('[ERROR] ' . $e->getMessage() . PHP_EOL);
    }

    /**
     *
     */
    public function parseError(Exception $e) {
        die('[ERROR]' . $e->getMessage() . PHP_EOL);
    }

    /**
     *
     */
    public function publish($content) {
        echo $content;
    }

    /**
     *
     */
    protected function usage($code = 0) {
        echo 'smart_css.php [-d] filename' . PHP_EOL;
        echo '  -d  show debug log (level:1-2)' . PHP_EOL;
        exit($code);
    }
}
