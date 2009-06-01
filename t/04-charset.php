<?php
require 'utils.php';
$t->comment( 'test parser instance' );
$t->ok( $parser = SCSS_Parser::getInstance(), 'get parser instance' );
$t->isa_ok( $parser, 'SCSS_Parser', 'parser instance isa SCSS_Parser' );

$t->comment( 'test command node' );
$t->ok( $charset = $parser->genCommand("HOGE"), 'generate command node' );
$t->isa_ok( $charset, 'SCSS_YYNode_Command', 'charset node isa SCSS_YYNode_Command' );
$t->is( $charset->publish(), "HOGE", 'publish command' );
