<?php
require 'lime/pluggable.php';
require dirname(__FILE__) . '/../libs/SCSS/AutoLoader.class.php';
$t = new lime_test_pluggable();
$t->output = new lime_output_color();
$t->loadPlugins(array('exception', 'strict'));
