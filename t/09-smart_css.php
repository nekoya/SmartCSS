<?php
chdir(dirname(__FILE__));
require '../libs/SmartCSS.php';
require 'lime.php';
$t = new lime_test();
$t->output = new lime_output_color();

function parse($content, $expected, $note = '') {
    global $t;
    $lexer  = SCSS_Lexer::getInstance();
    $parser = SCSS_Parser::getInstance();
    $lexer->setBuffer($content);
    //$lexer->debug = true;
    //$parser->debug = true;
    try {
        yyparse();
    } catch ( Exception $e ) {
        echo '[ERROR]' . $e->getMessage() . PHP_EOL;
        var_dump($lexer->lexbuf);
        var_dump($e->getTraceAsString());
        $t->fail('Caught unexpected Exception');
        exit(1);
    }
    // add PHP_EOL for heredocument
    $t->is( $parser->run(), $expected . PHP_EOL, $note );
    $parser->reset();
}

function throws_ok($content, $message = '', $note = '') {
    global $t;
    $lexer  = SCSS_Lexer::getInstance();
    $parser = SCSS_Parser::getInstance();
    $lexer->setBuffer($content);
    try {
        yyparse();
    } catch ( Exception $e ) {
        $t->isa_ok( $e, 'Exception', 'caught exception: ' . $note );
        $t->is( $e->getMessage(), $message, $message );
    }
    $parser->reset();
}

$t->comment('rulesets');
// ============================================================
$content = <<<__CSS__
*{font-size:100%;}
div { margin : 0; }
p{padding:10px;}
a { color:#fff; }
__CSS__;
// ------------------------------------------------------------
$expected = <<<__CSS__
* { font-size:100%; }
div { margin:0; }
p { padding:10px; }
a { color:#fff; }
__CSS__;
parse($content, $expected, 'simple rulesets');

// ============================================================
$content = <<<__CSS__
ul,li { list-style:none; }
span , a:hover { background:#efefef; }
__CSS__;
// ------------------------------------------------------------
$expected = <<<__CSS__
ul, li { list-style:none; }
span, a:hover { background:#efefef; }
__CSS__;
parse($content, $expected, 'multi selector');

// ============================================================
$content = <<<__CSS__
div { p { margin:0; } }
__CSS__;
// ------------------------------------------------------------
$expected = <<<__CSS__
div p { margin:0; }
__CSS__;
parse($content, $expected, 'simple recurisive ruleset');

// ============================================================
$content = <<<__CSS__
form {
    input,select { width:300px; }
}
__CSS__;
// ------------------------------------------------------------
$expected = <<<__CSS__
form input, form select { width:300px; }
__CSS__;
parse($content, $expected, 'single parent, multi child');

// ============================================================
$content = <<<__CSS__
FORM { INPUT,SELECT { WIDTH:300PX; } }
P { COLOR:#ABCDEF; BACKGROUND:URL('/IMAGES/BG.PNG') NO-REPEAT; }
__CSS__;
// ------------------------------------------------------------
$expected = <<<__CSS__
FORM INPUT, FORM SELECT { WIDTH:300PX; }
P { COLOR:#ABCDEF; BACKGROUND:URL('/IMAGES/BG.PNG') NO-REPEAT; }
__CSS__;
parse($content, $expected, 'upper case');

// ============================================================
$content = <<<__CSS__
ul,ol{li{border:1px solid red;}}
__CSS__;
// ------------------------------------------------------------
$expected = <<<__CSS__
ul li, ol li { border:1px solid red; }
__CSS__;
parse($content, $expected, 'multi parent, single child');

// ============================================================
$content = <<<__CSS__
dt,dd { sup,sub { font-color:red; } }
__CSS__;
// ------------------------------------------------------------
$expected = <<<__CSS__
dt sup, dt sub, dd sup, dd sub { font-color:red; }
__CSS__;
parse($content, $expected, 'multi parent, multi child');

// ============================================================
$content = <<<__CSS__
#content {
    height:100%;
    div {
        margin:0;
        padding:0;
        p {
            margin:10px;
            line-height:1.5;
        }
        ul, ol {
            margin:0;
            li{display:inline-block;}
        }
    }
}
__CSS__;
// ------------------------------------------------------------
$expected = <<<__CSS__
#content { height:100%; }
#content div { margin:0; padding:0; }
#content div p { margin:10px; line-height:1.5; }
#content div ul, #content div ol { margin:0; }
#content div ul li, #content div ol li { display:inline-block; }
__CSS__;
parse($content, $expected, 'complex');

$t->comment('exceptions');
// ============================================================
throws_ok( 'div { margin:0', 'syntax error', 'unclosed ruleset (no RBRACE)');
throws_ok( 'div { p { margin:0 }', 'syntax error', 'unclosed ruleset (less RBRACE)');

$t->comment('variables');
// ============================================================
$content = <<<__CSS__
[% margin = '10px' %]
div { margin:[% margin %]; }
__CSS__;
// ------------------------------------------------------------
$expected = <<<__CSS__
div { margin:10px; }
__CSS__;
parse($content, $expected, 'variable as expr');

// ============================================================
$content = <<<__CSS__
[% margin = '10px' %]
div { margin:20px [% margin %] 5px [% margin %]; }
__CSS__;
// ------------------------------------------------------------
$expected = <<<__CSS__
div { margin:20px 10px 5px 10px; }
__CSS__;
parse($content, $expected, 'variable inner expr');

// ============================================================
$content = <<<__CSS__
[% rule = 'p { margin:0; }' %]
[% rule %]
div { [% rule %] }
__CSS__;
// ------------------------------------------------------------
$expected = <<<__CSS__
p { margin:0; }
div p { margin:0; }
__CSS__;
parse($content, $expected, 'variable as ruleset');
