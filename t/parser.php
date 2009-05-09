<?php
require 'utils.php';
$t->comment( 'test parser instance' );
$t->ok( $parser = SCSS_Parser::getInstance(), 'get parser instance' );
$t->isa_ok( $parser, SCSS_Parser, 'parser instance isa SCSS_Parser' );

$t->comment( 'test charset node' );
$t->ok( $charset = $parser->genCharset("@charset 'utf-8';"), 'generate charset node' );
$t->isa_ok( $charset, SCSS_YYNode_Charset, 'charset node isa SCSS_YYNode_Charset' );
$t->ok( $charset->id === 0, 'id of first node is 0' );
$t->is( $charset->getType(), 'charset', 'get node type' );
$t->ok( $charset->hasChildren() === false, 'has not child nodes' );
$t->ok( $charset->hasNext() === false, 'has not next node' );
$t->is( $charset->publish(), "@charset 'utf-8';\n", 'publish charset' );

$t->comment( 'test empty node' );
$t->ok( $empty = $parser->genEmpty(''), 'generate empty node' );
$t->isa_ok( $empty, SCSS_YYNode_Empty, 'empty node isa SCSS_YYNode_Empty' );
$t->is( $empty->id, 1, 'id incremented' );
$t->is( $empty->getType(), 'empty', 'get node type' );
$t->ok( $empty->value === '', 'node value is empty' );
$t->is( $empty->getType(), 'empty', 'get node type' );
$t->ok( $empty->publish() === '', 'publish empty node' );
$empty->appendValue('append');
$t->is( $empty->value, 'append', 'node value is appended' );
$t->ok( $empty->publish() === '', 'publish empty regardless of node value' );

$t->is( $parser->catNode($empty, $charset), $empty, 'cat node' );
$t->ok( $empty->hasNext() === true, 'empty has next node' );
$t->is( $empty->publish(), "@charset 'utf-8';\n", 'publish contains next node value' );

$t->comment( 'test import node' );
$t->ok( $import = $parser->genImport('@import "base.css";'), 'generate import node' );
$t->isa_ok( $import, SCSS_YYNode_Import, 'import node isa SCSS_YYNode_Import' );
$t->is( $import->id, 2, 'id incremented' );
$t->is( $import->getType(), 'import', 'get node type' );
$t->is( $import->publish(), '@import "base.css";' . "\n", 'publish import' );
$t->ok( $import_print = $parser->genImport('@import    "print.css"    print  ;'), 'generate import node' );
$t->isa_ok( $import_print, SCSS_YYNode_Import, 'import node isa SCSS_YYNode_Import' );
$t->is( $import_print->publish(), '@import    "print.css"    print  ;'."\n", 'generate import node' );

$t->is( $parser->catNode($charset, array($import, $import_print)), $charset, 'cat node $import and $import_print to $charset' );
$t->ok( $charset->hasNext() === true, 'charset has next node' );
$t->ok( $import->hasNext() === true, 'import has next node' );
$t->is( $charset->next, $import, 'next of charset is import' );
$t->is( $import->next, $import_print, 'next of import is import_print' );

$t->is( $parser->setTopNode($empty), $empty, 'empty set as top node' );
$content =
    "@charset 'utf-8';\n" .
    "@import \"base.css\";\n".
    "@import    \"print.css\"    print  ;\n";
$t->is( $parser->run(), $content, 'publish all nodes' );
