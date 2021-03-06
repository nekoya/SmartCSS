<?php
require 'initialize.php';
$parser = new SCSS_Parser();

$t->comment( 'ident' );
$t->ok( $sel = $parser->genSelector('div'), 'generate node' );
$t->is( $sel->getType(), 'selector', 'get node type' );
$t->false( $sel->hasChildren(), 'has not child nodes' );
$t->false( $sel->hasNext(), 'has not next node' );
$t->is( $sel->getSelectors(), array('div'), 'get selectors (no parent)' );
$t->is( $sel->publish(), 'div', 'publish' );

$t->comment( 'space selector' );
$t->ok( $sel = $parser->genSelector('div p'), 'generate node' );
$t->is( $sel->publish(), 'div p', 'publish' );

$t->comment( 'comma separated multi selector' );
$t->ok( $sel = $parser->genSelector('#content div , p'), 'generate node' );
$t->is( $sel->publish(), '#content div, p', 'publish' );

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
$t->is( $sel->publish(), 'h1 + p', 'publish' );

$t->comment( 'greater combinator' );
$t->ok( $sel = $parser->genSelector('h2  >  p'), 'generate node' );
$t->is( $sel->publish(), 'h2 > p', 'publish, space compressed' );

$t->comment( 'combinators (no space)' );
$t->ok( $sel = $parser->genSelector('h1+h2>p'), 'generate node' );
$t->is( $sel->publish(), 'h1+h2>p', 'publish' );

$t->comment( 'attributes' );
$t->ok( $sel = $parser->genSelector('h1[foo="bar"]'), 'generate node' );
$t->is( $sel->publish(), 'h1[foo="bar"]', 'publish (remove spaces)' );
$t->ok( $sel = $parser->genSelector('h1[foo=bar]'), 'generate node' );
$t->is( $sel->publish(), 'h1[foo=bar]', 'publish' );
$t->ok( $sel = $parser->genSelector('h2[foo~="bar"]'), 'generate node, includes' );
$t->is( $sel->publish(), 'h2[foo~="bar"]', 'publish' );
$t->ok( $sel = $parser->genSelector('h2[foo~=bar]'), 'generate node, includes' );
$t->is( $sel->publish(), 'h2[foo~=bar]', 'publish' );
$t->ok( $sel = $parser->genSelector('h3[foo|="bar"]'), 'generate node, includes' );
$t->is( $sel->publish(), 'h3[foo|="bar"]', 'publish' );
$t->ok( $sel = $parser->genSelector('h3[foo|=bar]'), 'generate node, includes' );
$t->is( $sel->publish(), 'h3[foo|=bar]', 'publish' );

$t->comment( 'recursive' );
$pSel = $parser->genSelector('div');
$cSel = $parser->genSelector('a');
$cSel->parent = $pSel;
$t->is( $cSel->getSelectors(), array('div a'), 'get selectors' );
$t->is( $cSel->publish(), 'div a', 'div a' );

$pSel = $parser->genSelector('div,p');
$cSel = $parser->genSelector('a,span');
$cSel->parent = $pSel;
$t->is( $cSel->getSelectors(), array('div a', 'div span', 'p a', 'p span'), 'get selectors' );
$t->is( $cSel->publish(), 'div a, div span, p a, p span', 'div a,div span,p a,p span' );

$pSel = $parser->genSelector('#header, #content');
$cSel = $parser->genSelector('div,p');
$gSel = $parser->genSelector('a,span');
$cSel->parent = $pSel;
$gSel->parent = $cSel;
$t->is(
    $gSel->getSelectors(),
    array(
        '#header div a', '#header div span', '#header p a', '#header p span',
        '#content div a','#content div span','#content p a','#content p span'
    ),
    'get selectors'
);
$t->is(
    $gSel->publish(),
    '#header div a, #header div span, #header p a, #header p span, '.
    '#content div a, #content div span, #content p a, #content p span',
    'publish 3 level recursive selector'
);
