<?php
require 'lime.php';
require '../libs/SCSS/AutoLoader.class.php';
$t = new lime_test();
$t->output = new lime_output_color();
$t->ok( $parser = new SCSS_Parser(), 'create parser instance' );
