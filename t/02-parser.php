<?php
require 'initialize.php';

$t->comment( 'create parser instance' );
$t->ok( $parser = new SCSS_Parser(), 'create parser instance' );
$t->isa_ok( $parser, 'SCSS_Parser', 'parser instance isa SCSS_Parser' );

$t->comment( 'generate charset node' );
$charset = $parser->genCharset("@charset 'utf-8';");
$t->iss( $charset->id, 0, 'id of first node is 0' );

$t->comment( 'generate import node' );
$import = $parser->genImport('@import "base.css";');
$t->is( $import->id, 1, 'id incremented' );
$t->is( $parser->catNode($charset, $import), $charset, 'cat node $import to $charset' );
$t->true( $charset->hasNext(), 'charset has next node' );
$t->is( $charset->next, $import, 'next of charset is import node' );

$t->comment( 'generate ruleset nodes' );
$sel1  = $parser->genSelector('body');
$dec1  = $parser->genDeclaration('height', '100%');
$rule1 = $parser->genRuleset($sel1, $dec1);
$sel2  = $parser->genSelector('div');
$dec2  = $parser->genDeclaration('margin', '0');
$rule2 = $parser->genRuleset($sel2, $dec2);
$t->is( $parser->catNode($import, array($rule1, $rule2)), $import, 'cat nodes by array' );
$t->true( $import->hasNext(), 'import has next node' );
$t->true( $rule1->hasNext(), 'rule1 has next node' );
$t->is( $import->next, $rule1, 'next of import is rule1 node' );
$t->is( $rule1->next,  $rule2, 'next of rule1 is rule2 node' );

$t->comment( 'publish all nodes' );
$t->is( $parser->setTopNode($charset), $charset, 'charset set as top node' );
$content = <<<__CSS__
@charset 'utf-8';
@import "base.css";
body {
    height:100%;
}

div {
    margin:0;
}
__CSS__;
$t->is( $parser->run(), $content, 'publish all nodes' );

$t->comment( 'pushd and popd' );
$t->throws_ok(array($parser), '$p[0]->popd();', 'no directory in stack');
$dir1 = dirname(__FILE__);
$dir2 = dirname($dir1);
chdir($dir2);
$t->isnt( $dir1, $dir2, '$dir1 is not $dir2' );
$t->is( getcwd(), $dir2, "current working directory: $dir2" );
$t->ok( $parser->pushd($dir1), 'pushd' );
$t->is( getcwd(), $dir1, "current working directory: $dir1" );
$t->ok( $parser->popd(), 'popd' );
$t->is( getcwd(), $dir2, "current working directory: $dir2" );
