<?php
chdir(dirname(__FILE__));
require 'lime.php';
require '../libs/SCSS/AutoLoader.class.php';
$t = new lime_test();
$t->output = new lime_output_color();

$t->ok( $c = new SCSS_Getopt_CLI(), 'create SCSS_Getopt_CLI instance' );
$t->isa_ok( $c, 'SCSS_Getopt_CLI', 'instance isa SCSS_Getopt_CLI' );

$t->comment( 'getRealPath' );
$t->ok( $c->getRealPath('../sample/sample.scss'), 'get scss' );

$t->comment( 'fail getRealPath' );
$t->is( $c->getRealPath(''), false, 'empty args' );
$t->is( $c->getRealPath('../sample/none.scss'), false, 'scss file not found' );
$t->is( $c->getRealPath('../sample/sample.css'), false, 'target file extension must be .scss' );
$t->is( $c->getRealPath('../../../../../../etc/passwd'), false, 'cannot get upper basedir (acutually extension error)' );
