<?php
require 'initialize.php';
$parser = new SCSS_Parser();
//$parser->debug = true;

$t->comment( 'invalid nodes' );
$t->throws_ok( $parser, '$p->genRuleset("", "");', 'Invalid selector node for ruleset' );
$sel  = $parser->genSelector('div');
$t->throws_ok( array($parser, $sel), '$p[0]->genRuleset($p[1], "");', 'Invalid ruleset/declaration node for ruleset' );

$t->comment( 'simple ruleset' );
$sel  = $parser->genSelector('div');
$decl = $parser->genDeclaration('margin', '0');
$t->ok( $rule = $parser->genRuleset($sel, $decl), 'generate ruleset node' );
$t->is( $rule->publish(), "div {\n    margin:0;\n}\n\n", 'publish' );

//
$sel  = $parser->genSelector('div#header, div.section');
$dec1 = $parser->genDeclaration('margin', '0');
$dec2 = $parser->genDeclaration('padding', '10px');
$parser->catNode($dec1, $dec2);
$rule = $parser->genRuleset($sel, $dec1);
$content = <<<__CSS__
div#header, div.section {
    margin:0;
    padding:10px;
}
__CSS__;
$t->is( $rule->publish(), "$content\n\n", 'selectors and declarations' );

//
$sel1  = $parser->genSelector('div');
$dec1  = $parser->genDeclaration('margin', '0');
$rule1 = $parser->genRuleset($sel1, $dec1);
$sel2  = $parser->genSelector('p');
$dec2  = $parser->genDeclaration('padding', '0');
$rule2 = $parser->genRuleset($sel2, $dec2);
$parser->catNode($rule1, $rule2);
$content = <<<__CSS__
div {
    margin:0;
}

p {
    padding:0;
}
__CSS__;
$t->is( $rule1->publish(), "$content\n\n", 'publish rulesets' );


$t->comment( 'recursive rulesets' );
$cSel  = $parser->genSelector('p');
$cDec  = $parser->genDeclaration('line-height', '1.5');
$cRule = $parser->genRuleset($cSel, $cDec);
$pSel  = $parser->genSelector('div');
$pRule = $parser->genRuleset($pSel, $cRule);
$t->is( $pRule->publish(), "div p {\n    line-height:1.5;\n}\n\n", 'publish parent has no declaration, child has one declaration' );

//
$cSel  = $parser->genSelector('p');
$cDec  = $parser->genDeclaration('line-height', '1.5');
$cRule = $parser->genRuleset($cSel, $cDec);
$pSel  = $parser->genSelector('div');
$pDec  = $parser->genDeclaration('margin', '0');
$parser->catNode($pDec, $cRule);
$pRule = $parser->genRuleset($pSel, $pDec);
$content = <<<__CSS__
div {
    margin:0;
}

div p {
    line-height:1.5;
}
__CSS__;
$t->is( $pRule->publish(), "$content\n\n", 'publish parent:1 , child:1' );

//
$cSel  = $parser->genSelector('p');
$cDec  = $parser->genDeclaration('line-height', '1.5');
$cRule = $parser->genRuleset($cSel, $cDec);
$pSel  = $parser->genSelector('div');
$pDec  = $parser->genDeclaration('margin', '0');
$pDec2 = $parser->genDeclaration('padding', '0');
$parser->catNode($cRule, $pDec);
$parser->catNode($cRule, $pDec2);
$pRule = $parser->genRuleset($pSel, $cRule);
$content = <<<__CSS__
div {
    margin:0;
    padding:0;
}

div p {
    line-height:1.5;
}
__CSS__;
$t->is( $pRule->publish(), "$content\n\n", 'publish parent:2 , child:1' );

//
$cSel  = $parser->genSelector('p');
$cDec  = $parser->genDeclaration('line-height', '1.5');
$cDec2 = $parser->genDeclaration('font-weight', 'bold');
$cRule = $parser->catNode($cDec, $cDec2);
$cRule = $parser->genRuleset($cSel, $cDec);
$pSel  = $parser->genSelector('div');
$pDec  = $parser->genDeclaration('margin', '0');
$pDec2 = $parser->genDeclaration('padding', '0');
$parser->catNode($cRule, $pDec);
$parser->catNode($cRule, $pDec2);
$pRule = $parser->genRuleset($pSel, $cRule);
$content = <<<__CSS__
div {
    margin:0;
    padding:0;
}

div p {
    line-height:1.5;
    font-weight:bold;
}
__CSS__;
$t->is( $pRule->publish(), "$content\n\n", 'publish parent:2 , child:2' );

//
$gSel  = $parser->genSelector('li');
$gDec  = $parser->genDeclaration('display', 'inline');
$gRule = $parser->genRuleset($gSel, $gDec);

$cSel  = $parser->genSelector('ul');
$cDec  = $parser->genDeclaration('width', '100%');
$parser->catNode($cDec, $gRule);
$cRule = $parser->genRuleset($cSel, $cDec);

$pSel  = $parser->genSelector('#nav');
$pDec  = $parser->genDeclaration('margin', '0');
$parser->catNode($pDec, $cRule);
$pRule = $parser->genRuleset($pSel, $pDec);

$content = <<<__CSS__
#nav {
    margin:0;
}

#nav ul {
    width:100%;
}

#nav ul li {
    display:inline;
}
__CSS__;
$t->is( $pRule->publish(), "$content\n\n", 'publish depth 3' );


$t->comment( 'empty ruleset' );
$cSel  = $parser->genSelector('p');
$cRule = $parser->genRuleset($cSel, null);
$t->is( $cRule->publish(), "", 'no output for empty ruleset' );

$pSel  = $parser->genSelector('div');
$pRule = $parser->genRuleset($pSel, $cRule);
$t->is( $pRule->publish(), "", 'no output for recursive empty rulesets' );
