<?php
require 'utils.php';

$t->comment( 'prepare parser instance' );
$t->ok( $parser = SCSS_Parser::getInstance(), 'get parser instance' );
$t->isa_ok( $parser, SCSS_Parser, 'parser instance isa SCSS_Parser' );

$t->comment( 'create selector node' );
$t->ok( $node = $parser->genSelector('div#header'), 'generate node' );
$t->is( $decl->getType(), 'selector', 'get node type' );
$t->ok( $decl->hasChildren() === false, 'has not child nodes' );
$t->ok( $decl->hasNext() === false, 'has not next node' );
$t->is( $decl->publish(), 'div#header', 'publish' );
