<?php
require 'utils.php';
$t->ok( Parser::getInstance()->addExpr('10px') );
$t->ok( $parser = Parser::getInstance() );
$node = $parser->nodes[0];
$t->isa_ok( $node, 'YYNode_Expr' );
$t->is( $node->publish(), '10px' );
