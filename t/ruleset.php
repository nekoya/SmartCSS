<?php
require 'utils.php';
$t->comment( 'prepare parser instance' );
$t->ok( $parser = SCSS_Parser::getInstance(), 'get parser instance' );
$t->isa_ok( $parser, SCSS_Parser, 'parser instance isa SCSS_Parser' );

$t->comment( 'simple ruleset' );
$t->ok( $sel  = $parser->genSelector('div'), 'generate selector node' );
$t->ok( $decl = $parser->genDeclaration('margin:0'), 'generate declaration node' );
$t->ok( $rule = $parser->genRuleset($sel, $decl), 'generate ruleset node' );
$t->ok( $rule->hasChildren() === true, 'ruleset has children(selector and declaration)' );
$t->is( $rule->publish(), "div { margin:0; }\n", 'publish' );

$t->comment( 'selectors and declarations' );
$t->ok( $sel1 = $parser->genSelector('div#header'), 'div#header selector' );
$t->ok( $sel2 = $parser->genSelector('div.section'), 'div.section selector' );
$t->ok( $dec1 = $parser->genDeclaration('margin:0'), 'generate declaration node' );
$t->ok( $dec2 = $parser->genDeclaration('padding:10px'), 'generate declaration node' );
$t->is( $parser->catNode($sel1, $sel2), $sel1, 'cat selectors' );
$t->is( $parser->catNode($dec1, $dec2), $dec1, 'cat declarations' );
$t->ok( $rule = $parser->genRuleset($sel1, $dec1), 'generate ruleset node' );
$t->is( $rule->publish(), "div#header, div.section { margin:0; padding:10px; }\n", 'publish' );

$t->comment( 'recursive rulesets' );
$t->ok( $parentSel  = $parser->genSelector('div'), 'generate parent selector node' );
$t->ok( $childSel   = $parser->genSelector('p'), 'generate child selector node' );
$t->ok( $childDecl  = $parser->genDeclaration('line-height:1.5'), 'generate declaration node for child selector' );
$t->ok( $childRule  = $parser->genRuleset($childSel, $childDecl), 'generate child ruleset node' );
$t->ok( $parentRule = $parser->genRuleset($parentSel, $childRule), 'generate parent ruleset node' );
$t->is( $parentRule->publish(), "div p { line-height:1.5; }\n", 'publish' );
