<?php
require 'utils.php';

$t->comment( 'prepare parser instance' );
$t->ok( $parser = SCSS_Parser::getInstance(), 'get parser instance' );
$t->isa_ok( $parser, SCSS_Parser, 'parser instance isa SCSS_Parser' );

$t->comment( 'create selector node' );
$t->ok( $sel = $parser->genSelector('div#header'), 'generate node' );
$t->is( $sel->getType(), 'selector', 'get node type' );
$t->ok( $sel->hasChildren() === false, 'has not child nodes' );
$t->ok( $sel->hasNext() === false, 'has not next node' );
$t->is( $sel->publish(), 'div#header', 'publish' );
