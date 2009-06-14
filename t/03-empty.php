<?php
require 'initialize.php';
$parser = new SCSS_Parser();

$t->comment( 'test empty node' );
$t->ok( $empty = $parser->genEmpty(''), 'generate empty node' );
$t->isa_ok( $empty, 'SCSS_YYNode_Empty', 'empty node isa SCSS_YYNode_Empty' );
$t->is( $empty->getType(), 'empty', 'get node type' );
$t->iss( $empty->value, '', 'node value is empty' );
$t->iss( $empty->publish(), '', 'publish empty node' );
$empty->appendValue('append');
$t->is( $empty->value, 'append', 'node value is appended' );
$t->iss( $empty->publish(), '', 'publish empty regardless of node value' );
