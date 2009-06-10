<?php
class SCSS_AutoLoader {
    public static function autoload($class) {
        if (substr($class, 0, 5) !== 'SCSS_') {
            // load only SCSS:: namespace
            return false;
        }

        $basedir = dirname(__FILE__);
        $classfile = preg_replace('/_/', DIRECTORY_SEPARATOR, substr($class, 5));
        $filename = $basedir . DIRECTORY_SEPARATOR . $classfile . '.class.php';
        if (file_exists($filename)) {
            require $filename;
        }
        if (!class_exists($class, false)) {
            throw new Exception("Could not load class: $class");
        }
        return true;
    }
}
spl_autoload_register( array( 'SCSS_AutoLoader', 'autoload' ) );
