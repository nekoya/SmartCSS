<?php
require 'initialize.php';
$parser = new SCSS_Parser();

$t->comment( 'not implemented command' );
$t->throws_ok( $parser, '$p->genCommand("NONE");', 'Command not found: NONE' );
