<?php
class AutoLoader {
    public static function autoload($class) {
        $basedir = dirname(__FILE__);
        $classfile = preg_replace('/_/', DIRECTORY_SEPARATOR, $class);
        $filename = $basedir . DIRECTORY_SEPARATOR . $classfile . '.class.php';
        if (file_exists($filename)) {
            require $filename;
        }
        if (!class_exists($class, false)) {
            throw new Exception("Could not load class: $class");
        }
    }
}
spl_autoload_register( array( 'AutoLoader', 'autoload' ) );
