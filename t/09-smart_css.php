<?php
require '../libs/SmartCSS.php';
require 'lime.php';
$t = new lime_test();
$t->output = new lime_output_color();

function test($content, $expected, $note = '') {
    global $t;
    $lexer  = SCSS_Lexer::getInstance();
    $parser = SCSS_Parser::getInstance();
    $lexer->setBuffer($content);
    yyparse();
    // add PHP_EOL for heredocument
    $t->is( $parser->run(), $expected . PHP_EOL, $note );
    $parser->reset();
}

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
test($content, $expected, 'single parent, multi child');

// ============================================================
$content = <<<__CSS__
ul,ol{li{border:1px solid red}}
__CSS__;
// ------------------------------------------------------------
$expected = <<<__CSS__
ul li, ol li { border:1px solid red; }
__CSS__;
test($content, $expected, 'multi parent, single child');

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
            li{display:inline-block}
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

test($content, $expected, 'complex');
