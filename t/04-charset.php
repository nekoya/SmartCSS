<?php
require 'initialize.php';
$parser = new SCSS_Parser();

$t->comment( 'test charset node' );
$t->ok( $charset = $parser->genCharset("'utf-8'"), 'generate charset node of "utf-8"' );
$t->is( mb_internal_encoding(), 'UTF-8', 'mb_internal_encoding returns "UTF-8"' );
$t->isa_ok( $charset, 'SCSS_YYNode_Charset', 'charset node isa SCSS_YYNode_Charset' );
$t->is( $charset->getType(), 'charset', 'get node type' );
$t->false( $charset->hasChildren(), 'has not child nodes' );
$t->false( $charset->hasNext(), 'has not next node' );
$t->is( $charset->publish(), '@charset "utf-8";' . PHP_EOL, 'publish charset' );

$t->ok( $charset = $parser->genCharset('"shift-jis"'), 'generate charset node of "shift-jis"' );
$t->is( mb_internal_encoding(), 'SJIS', 'mb_internal_encoding returns "SJIS"' );
$t->is( $charset->publish(), '@charset "shift-jis";' . PHP_EOL, 'publish charset' );
