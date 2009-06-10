<?php
chdir(dirname(__FILE__));
require 'lime.php';
require '../libs/SCSS/AutoLoader.class.php';
$t = new lime_test();
$t->output = new lime_output_color();

$t->comment('autoload SCSS_Parser');
$t->ok( !class_exists('SCSS_Parser', false), 'SCSS_Parser is not loaded' );
$t->ok( SCSS_AutoLoader::autoload('SCSS_Parser'), 'loading SCSS_Parser' );
$t->ok( class_exists('SCSS_Parser', false), 'SCSS_Parser exists' );

$t->comment('autoload SCSS_None');
$t->ok( !class_exists('SCSS_None', false), 'SCSS_None is not loaded' );
try {
    $caught = false;
    SCSS_AutoLoader::autoload('SCSS_None');
} catch (Exception $e) {
    $caught = true;
    $t->ok( $e->getMessage(), 'Could not load class: SCSS_None' );
}
$t->ok( $caught === true, 'caught exception' );
$t->ok( !class_exists('SCSS_None', false), 'SCSS_None does not loaded yet' );

$t->comment('autoload Hoge (not SCSS::* namespace)');
$t->ok( !class_exists('Hoge', false), 'Hoge is not loaded' );
$t->ok( SCSS_AutoLoader::autoload('Hoge') === false, 'does not loading Hoge' );
$t->ok( !class_exists('Hoge', false), 'Hoge does not loaded yet' );
