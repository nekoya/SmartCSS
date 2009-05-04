<?php
function __autoload($class) {
    $class = preg_replace('/_/', DIRECTORY_SEPARATOR, $class);
    require "../libs/$class.class.php";
}
require 'lime.php';
$t = new lime_test();
$t->output = new lime_output_color();
