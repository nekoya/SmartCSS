<?php
require 'initialize.php';

function parse($content, $expected, $note = '', $debug = false) {
    global $t;
    $parser = new SCSS_Parser();
    $lexer  = new SCSS_Lexer($parser);
    $lexer->setBuffer($content);
    if ($debug) {
        $lexer->debug = true;
        $parser->debug = true;
    }
    try {
        $parser->yyparse($lexer);
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

function throws_ok($content, $message = '', $debug = false) {
    global $t;
    $parser = new SCSS_Parser();
    $lexer  = new SCSS_Lexer($parser);
    $lexer->setBuffer($content);
    if ($debug) {
        $lexer->debug = true;
        $parser->debug = true;
    }
    $t->throws_ok(array($lexer, $parser), '$p[1]->yyparse($p[0]);', $message);
}

$t->comment('basically syntax error');
// ============================================================
$t->comment('throw Exception: unclosed ruleset (no RBRACE)');
throws_ok( 'div { margin:0', 'syntax error at line 1, near by "0"');

$t->comment('throw Exception: unclosed ruleset (less RBRACE)');
throws_ok( "div {\r\np {\nmargin:0\n}", 'syntax error at line 4, near by ""' );

$t->comment('line number with IMPORT command');
$content = <<<__CSS__
* { margin:0 }
[% IMPORT '../sample/width.scss' %]
body {
    filter:expression(document.execCommand("BackgroundImageCache", false, true));
}
__CSS__;
throws_ok( $content, 'syntax error at line 4, near by "document.execCommand("Backgrou..."' );

$t->comment('error occuered at imported file (line number based on base scss file), error place output single line');
$content = <<<__CSS__
* { margin:0 }
* div { margin:0; }
[% IMPORT '../sample/error.scss' %]
__CSS__;
throws_ok( $content, "syntax error at line 3, near by \"margin:0;...\"" );
