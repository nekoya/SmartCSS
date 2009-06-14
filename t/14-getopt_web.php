<?php
require 'initialize.php';
$parser = new SCSS_Parser();

$t->ok( $c = new SCSS_Getopt_Web(), 'create SCSS_Getopt_Web instance' );
$t->isa_ok( $c, 'SCSS_Getopt_Web', 'instance isa SCSS_Getopt_Web' );

$t->comment( 'getRealPath' );
$t->ok( $c->getRealPath('../sample/sample.css'), 'get scss, parameter extension is .css' );

$t->comment( 'fail getRealPath' );
$t->is( $c->getRealPath(''), false, 'empty args' );
$t->is( $c->getRealPath('../sample/none.css'), false, 'css file not found' );
$t->is( $c->getRealPath('../sample/sample.scss'), false, 'target file extension must be .css' );
$t->is( $c->getRealPath('../../../../../../etc/passwd'), false, 'cannot get upper basedir (acutually extension error)' );
