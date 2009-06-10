<?php
chdir(dirname(__FILE__));
require 'lime.php';
require '../libs/SCSS/AutoLoader.class.php';
$t = new lime_test();
$t->output = new lime_output_color();

$t->ok( $c = new SCSS_Getopt_Web(), 'create SCSS_Getopt_Web instance' );
$t->isa_ok( $c, 'SCSS_Getopt_Web', 'instance isa SCSS_Getopt_Web' );

$t->comment( 'getTargetFile' );
$t->ok( $c->getTargetFile('../sample/hoge.css'), 'get scss, parameter extension is .css' );

$t->comment( 'fail getTargetFile' );
$t->is( $c->getTargetFile(''), false, 'empty args' );
$t->is( $c->getTargetFile('../sample/none.css'), false, 'css file not found' );
$t->is( $c->getTargetFile('../sample/hoge.scss'), false, 'target file extension must be .css' );
$t->is( $c->getTargetFile('../../../../../../etc/passwd'), false, 'cannot get upper basedir (acutually extension error)' );
