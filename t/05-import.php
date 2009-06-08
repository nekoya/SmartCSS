<?php
chdir(dirname(__FILE__));
require 'utils.php';

$t->comment( 'test import node' );
$t->ok( $base = $parser->genImport('@import "base.css";'), 'generate import node' );
$t->isa_ok( $base, 'SCSS_YYNode_Import', 'node isa SCSS_YYNode_Import' );
$t->is( $base->getType(), 'import', 'get node type' );
$t->is( $base->publish(), '@import "base.css";' . "\n", 'publish node' );

$t->comment( 'import with media type' );
$t->ok( $print = $parser->genImport('@import    "print.css"    print  ;'), 'generate import node' );
$t->isa_ok( $print, 'SCSS_YYNode_Import', 'node isa SCSS_YYNode_Import' );
$t->is( $print->publish(), '@import    "print.css"    print  ;'."\n", 'publish node' );

$t->comment( 'import with multi media types' );
$t->ok( $multi = $parser->genImport('@import "multi.css" print,tv;'), 'generate import node' );
$t->isa_ok( $multi, 'SCSS_YYNode_Import', 'node isa SCSS_YYNode_Import' );
$t->is( $multi->publish(), '@import "multi.css" print,tv;'."\n", 'publish node' );
