<?php
chdir(dirname(__FILE__));
require 'utils.php';
$t->comment( 'test parser instance' );
$t->ok( $parser = SCSS_Parser::getInstance(), 'get parser instance' );
$t->isa_ok( $parser, 'SCSS_Parser', 'parser instance isa SCSS_Parser' );

$t->comment( 'test charset node' );
$t->ok( $charset = $parser->genCharset("@charset 'utf-8';"), 'generate charset node' );
$t->isa_ok( $charset, 'SCSS_YYNode_Charset', 'charset node isa SCSS_YYNode_Charset' );
$t->is( $charset->getType(), 'charset', 'get node type' );
$t->ok( $charset->hasChildren() === false, 'has not child nodes' );
$t->ok( $charset->hasNext() === false, 'has not next node' );
$t->is( $charset->publish(), "@charset 'utf-8';\n", 'publish charset' );
