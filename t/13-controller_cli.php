<?php
require 'initialize.php';
$parser = new SCSS_Parser();

$t->ok( $c = new SCSS_Controller_CLI(), 'create SCSS_Controller_CLI instance' );
$t->isa_ok( $c, 'SCSS_Controller_CLI', 'instance isa SCSS_Controller_CLI' );

$t->comment( 'getContent' );
$t->ok( $c->getRealPath('../sample/sample.scss'), 'get scss' );
$t->ok( $c->getRealPath('../sample/yui/base-min.css'), 'get css' );

$t->comment( 'fail getRealPath' );
$t->throws_ok( $c, '$p->getRealPath("");', 'target extension must be .css or .scss' );
$t->throws_ok( $c, '$p->getRealPath("../sample/none.scss");', 'file not found.' );
