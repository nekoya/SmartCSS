<?php
require 'initialize.php';
$parser = new SCSS_Parser();

$t->ok( $c = new SCSS_Controller_Web(), 'create SCSS_Controller_Web instance' );
$t->isa_ok( $c, 'SCSS_Controller_Web', 'instance isa SCSS_Controller_Web' );

$t->comment( 'getRealPath' );
$t->ok( $c->getRealPath('../sample/sample.css'), 'get scss, parameter extension is .css' );

$t->comment( 'fail getRealPath' );
$t->throws_ok( $c, '$p->getRealPath("");', 'target extension must be .css' );
$t->throws_ok( $c, '$p->getRealPath("../sample/none.css");', 'file not found.' );
$t->throws_ok( $c, '$p->getRealPath("../sample/sample.scss");', 'target extension must be .css' );

$t->comment( 'isValidPath: prevent directory traversal' );
$t->throws_ok( $c, '$p->isValidPath("../../../../../../etc/passwd");', 'invalid target path.' );
