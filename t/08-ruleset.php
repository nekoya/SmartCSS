<?php
require 'utils.php';
$t->comment( 'prepare parser instance' );
$t->ok( $parser = SCSS_Parser::getInstance(), 'get parser instance' );
$t->isa_ok( $parser, 'SCSS_Parser', 'parser instance isa SCSS_Parser' );

$t->comment( 'simple ruleset' );
$t->ok( $sel  = $parser->genSelector('div'), 'generate selector node' );
$t->ok( $decl = $parser->genDeclaration('margin', '0'), 'generate declaration node' );
$t->ok( $rule = $parser->genRuleset($sel, $decl), 'generate ruleset node' );
$t->ok( $rule->hasChildren() === true, 'ruleset has children(selector and declaration)' );
$t->is( $rule->publish(), "div { margin:0; }\n", 'publish' );

$sel1 = $parser->genSelector('div#header');
$sel2 = $parser->genSelector('div.section');
$dec1 = $parser->genDeclaration('margin', '0');
$dec2 = $parser->genDeclaration('padding', '10px');
$parser->catNode($sel1, $sel2);
$parser->catNode($dec1, $dec2);
$rule = $parser->genRuleset($sel1, $dec1);
$t->is( $rule->publish(), "div#header, div.section { margin:0; padding:10px; }\n", 'selectors and declarations' );

$t->comment( 'recursive rulesets' );
$childSel   = $parser->genSelector('p');
$childDecl  = $parser->genDeclaration('line-height', '1.5');
$childRule  = $parser->genRuleset($childSel, $childDecl);

$parentSel  = $parser->genSelector('div');
$parentRule = $parser->genRuleset($parentSel, $childRule);
$t->is( $parentRule->publish(), "div p { line-height:1.5; }\n", 'publish parent has no declaration, child has one declaration' );

$parentDecl = $parser->genDeclaration('margin', '0');
$parser->catNode($parentDecl, $childRule);
$parentRule = $parser->genRuleset($parentSel, $parentDecl);
$t->is( $parentRule->publish(), "div { margin:0; }\ndiv p { line-height:1.5; }\n", 'publish parent:1 , child:1' );

$parentDecl2 = $parser->genDeclaration('padding', '0');
$t->ok( $parser->catNode($parentDecl, $parentDecl2), 'Added parent decl node after child rule node' );
$t->is( $parentRule->publish(), "div { margin:0; padding:0; }\ndiv p { line-height:1.5; }\n", 'publish parent:2 , child:1' );

$childDecl2 = $parser->genDeclaration('font-weight', 'bold');
$t->ok( $parser->catNode($childDecl, $childDecl2), 'Added declaration to child ruleset' );
$t->is( $parentRule->publish(), "div { margin:0; padding:0; }\ndiv p { line-height:1.5; font-weight:bold; }\n", 'publish parent:2 , child:2' );

$sel1  = $parser->genSelector('#nav');
$sel2  = $parser->genSelector('ul');
$sel3  = $parser->genSelector('li');
$dec1  = $parser->genDeclaration('margin', '0');
$dec2  = $parser->genDeclaration('width', '100%');
$dec3  = $parser->genDeclaration('display', 'inline');
$rule1 = $parser->genRuleset($sel1, $dec1);
$rule2 = $parser->genRuleset($sel2, $dec2);
$rule3 = $parser->genRuleset($sel3, $dec3);
$parser->catNode($dec1, $rule2);
$parser->catNode($dec2, $rule3);
$t->is( $rule1->publish(), "#nav { margin:0; }\n#nav ul { width:100%; }\n#nav ul li { display:inline; }\n", 'publish depth 3' );
