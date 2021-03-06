<?php
class SCSS_Controller_CLI extends SCSS_Controller {
    /**
     *
     */
    public function getParams() {
        $short_opts = 'hdcsl';
        $long_opts  = array('help', 'debug', 'compress', 'strict', 'lexdebug');

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
            if ($opt[0] === '--debug' || $opt[0] === 'd') {
                SmartCSS::$debug = true;
            }
            if ($opt[0] === '--compress' || $opt[0] === 'c') {
                SmartCSS::$compress = true;
            }
            if ($opt[0] === '--strict' || $opt[0] === 's') {
                SmartCSS::$strict = true;
            }
            if ($opt[0] === '--lexdebug' || $opt[0] === 'l') {
                SmartCSS::$lexdebug = true;
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
        if (!preg_match('/\.(css|scss)$/', $filename)) {
            throw new Exception('target extension must be .css or .scss');
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
        echo 'smart_css.php [-c|--compress][-s|strict][-d|--debug][-l|--lexdebug][-h|--help] filename' . PHP_EOL;
        echo '  -c|--compress  output compressed css.' . PHP_EOL;
        echo '  -s|--strict    analyze properties as strict.' . PHP_EOL;
        echo '  -d|--debug     show parser debug messages.' . PHP_EOL;
        echo '  -l|--lexdebug  show lexer debug messages.' . PHP_EOL;
        echo '  -h|--help      show this usage.' . PHP_EOL;
        exit($code);
    }
}
