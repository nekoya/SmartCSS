<?php
class SCSS_Getopt_CLI {
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

    protected function usage($code = 0) {
        echo 'smart_css.php [-d] filename' . PHP_EOL;
        echo '  -d  show debug log (level:1-2)' . PHP_EOL;
        exit($code);
    }

    public function getRealPath($filename) {
        if (empty($filename)) return false;

        $filename = str_replace("\0", '', $filename);
        if (!preg_match('/\.scss$/', $filename)) return false;

        $realpath = realpath($filename);
        if ($realpath === false) return false;
        if (!file_exists($filename)) return false;

        return $realpath;
    }

    public function failedReadFile() {
        die('Failed read scss file.');
    }

    public function publish($content) {
        echo $content;
    }
}
