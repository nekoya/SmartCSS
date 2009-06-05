<?php
chdir(dirname(__FILE__));
require 'utils.php';
$t->comment( 'test parser instance' );
$t->ok( $parser = SCSS_Parser::getInstance(), 'get parser instance' );
$t->isa_ok( $parser, 'SCSS_Parser', 'parser instance isa SCSS_Parser' );

$t->comment( 'test empty node' );
$t->ok( $empty = $parser->genEmpty(''), 'generate empty node' );
$t->isa_ok( $empty, 'SCSS_YYNode_Empty', 'empty node isa SCSS_YYNode_Empty' );
$t->is( $empty->getType(), 'empty', 'get node type' );
$t->ok( $empty->value === '', 'node value is empty' );
$t->ok( $empty->publish() === '', 'publish empty node' );
$empty->appendValue('append');
$t->is( $empty->value, 'append', 'node value is appended' );
$t->ok( $empty->publish() === '', 'publish empty regardless of node value' );
