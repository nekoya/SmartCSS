<?php
require 'utils.php';
$t->comment( 'test parser instance' );
$t->ok( $parser = SCSS_Parser::getInstance(), 'get parser instance' );
$t->isa_ok( $parser, 'SCSS_Parser', 'parser instance isa SCSS_Parser' );

$t->comment( 'generate charset node' );
$charset = $parser->genCharset("@charset 'utf-8';");
$t->ok( $charset->id === 0, 'id of first node is 0' );

$t->comment( 'generate import node' );
$import = $parser->genImport('@import "base.css";');
$t->is( $import->id, 1, 'id incremented' );
$t->is( $parser->catNode($charset, $import), $charset, 'cat node $import to $charset' );
$t->ok( $charset->hasNext() === true, 'charset has next node' );
$t->is( $charset->next, $import, 'next of charset is import node' );

$t->comment( 'generate ruleset nodes' );
$sel1  = $parser->genSelector('body');
$dec1  = $parser->genDeclaration('height:100%');
$rule1 = $parser->genRuleset($sel1, $dec1);
$sel2  = $parser->genSelector('div');
$dec2  = $parser->genDeclaration('margin:0');
$rule2 = $parser->genRuleset($sel2, $dec2);
$t->is( $parser->catNode($import, array($rule1, $rule2)), $import, 'cat nodes by array' );
$t->ok( $import->hasNext() === true, 'import has next node' );
$t->ok( $rule1->hasNext()  === true, 'rule1 has next node' );
$t->is( $import->next, $rule1, 'next of import is rule1 node' );
$t->is( $rule1->next,  $rule2, 'next of rule1 is rule2 node' );

$t->comment( 'publish all nodes' );
$t->is( $parser->setTopNode($charset), $charset, 'charset set as top node' );
$content =
    "@charset 'utf-8';\n" .
    "@import \"base.css\";\n".
    "body { height:100%; }\n".
    "div { margin:0; }\n";
$t->is( $parser->run(), $content, 'publish all nodes' );
