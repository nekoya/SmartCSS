<?php
require 'initialize.php';
$parser = new SCSS_Parser();

$t->comment( 'test charset node' );
$t->ok( $charset = $parser->genCharset("@charset 'utf-8';"), 'generate charset node' );
$t->isa_ok( $charset, 'SCSS_YYNode_Charset', 'charset node isa SCSS_YYNode_Charset' );
$t->is( $charset->getType(), 'charset', 'get node type' );
$t->false( $charset->hasChildren(), 'has not child nodes' );
$t->false( $charset->hasNext(), 'has not next node' );
$t->is( $charset->publish(), "@charset 'utf-8';\n", 'publish charset' );
