<?php
require 'utils.php';

$t->comment( 'prepare parser instance' );
$t->ok( $parser = SCSS_Parser::getInstance(), 'get parser instance' );
$t->isa_ok( $parser, 'SCSS_Parser', 'parser instance isa SCSS_Parser' );

$t->comment( 'ident' );
$t->ok( $sel = $parser->genSelector('div'), 'generate node' );
$t->is( $sel->getType(), 'selector', 'get node type' );
$t->ok( $sel->hasChildren() === false, 'has not child nodes' );
$t->ok( $sel->hasNext() === false, 'has not next node' );
$t->is( $sel->publish(), 'div', 'publish' );

$t->comment( 'ident hash' );
$t->ok( $sel = $parser->genSelector('div#header'), 'generate node' );
$t->is( $sel->publish(), 'div#header', 'publish' );

$t->comment( 'ident class' );
$t->ok( $sel = $parser->genSelector('div.section'), 'generate node' );
$t->is( $sel->publish(), 'div.section', 'publish' );

$t->comment( 'ident hash and class' );
$t->ok( $sel = $parser->genSelector('div#container.col-ms'), 'generate node' );
$t->is( $sel->publish(), 'div#container.col-ms', 'publish' );

$t->comment( 'ident pseudo' );
$t->ok( $sel = $parser->genSelector('a:hover'), 'generate node' );
$t->is( $sel->publish(), 'a:hover', 'publish' );

$t->comment( 'plus combinator' );
$t->ok( $sel = $parser->genSelector('h1 + p'), 'generate node' );
$t->is( $sel->publish(), 'h1+p', 'publish' );

$t->comment( 'greater combinator' );
$t->ok( $sel = $parser->genSelector('h2  >  p'), 'generate node' );
$t->is( $sel->publish(), 'h2>p', 'publish' );

$t->comment( 'combinators (no space)' );
$t->ok( $sel = $parser->genSelector('h1+h2>p'), 'generate node' );
$t->is( $sel->publish(), 'h1+h2>p', 'publish' );
