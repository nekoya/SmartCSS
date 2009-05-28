<?php
require 'utils.php';

$t->comment( 'prepare parser instance' );
$t->ok( $parser = SCSS_Parser::getInstance(), 'get parser instance' );
$t->isa_ok( $parser, 'SCSS_Parser', 'parser instance isa SCSS_Parser' );

$t->comment( 'create declaration node' );
$t->ok( $decl = $parser->genDeclaration('margin', '0'), 'generate node' );
$t->isa_ok( $decl, 'SCSS_YYNode_Declaration', 'node isa SCSS_YYNode_Declaration' );
$t->ok( $decl->id === 0, 'id of first node is 0' );
$t->is( $decl->getType(), 'declaration', 'get node type' );
$t->ok( $decl->hasChildren() === false, 'has not child nodes' );
$t->ok( $decl->hasNext() === false, 'has not next node' );
$t->is( $decl->publish(), 'margin:0;', 'publish, not line breaking' );

$t->comment( 'next node operation' );
$t->ok( $next = $parser->genDeclaration('padding', '10px'), 'generate node' );
$t->is( $parser->catNode($decl, $next), $decl, 'cat next node' );
$t->ok( $decl->hasNext() === true, 'base declaration node has next one' );
$t->is( $decl->publish(), 'margin:0;', 'not publish next node' );

$t->comment( 'without semicolon' );
$t->ok( $noSemi = $parser->genDeclaration('margin', '0'), 'generate node' );
$t->is( $noSemi->publish(), 'margin:0;', 'publish with semicolon' );

$t->comment( 'blank spaces' );
$t->ok( $blank = $parser->genDeclaration('margin', '0'), 'generate node' );
$t->is( $blank->publish(), 'margin:0;', 'publish trimed' );
$t->ok( $blank = $parser->genDeclaration('margin', '5px     10px  0  '), 'generate node' );
$t->is( $blank->publish(), 'margin:5px 10px 0;', 'no operation for inner space' );

/*
 * Expression formats.
 */

function through($property, $expr) {
    global $t, $parser;
    $t->ok( $decl = $parser->genDeclaration($property, $expr), 'generate node' );
    $t->is( $decl->publish(), "$property:$expr;", 'publish' );
}

$t->comment( 'with import' );
through( 'margin', '0 !important' );

$t->comment( 'percentage' );
through( 'font-size', '120%' );
through( 'width', '50.5%' );
through( 'line-height', '.5%' );

$t->comment( 'length' );
through( 'margin', '10px 1cm 2mm 0.5in' );
through( 'margin', '-10.2px -0.1cm -2mm -0.5in' );
through( 'padding', '10.2pt 1pc -20pt -2pc' );

$t->comment( 'ems, exs' );
through( 'margin', '1em 1ex' );

$t->comment( 'hexcolor, url' );
through( 'color', '#ff9900' );
through( 'background-image', "('http://example.com/bg_img.jpg')" );
through( 'background', '#fff url("/images/bg.png") no-repeat left 50%' );

$t->comment( 'string' );
through( 'font-family', '"Helvetica, sans-serif"' );
through( 'font-family', "'Frutiger, sans-serif'" );
