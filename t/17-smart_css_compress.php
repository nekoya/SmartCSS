<?php
require 'initialize.php';
SmartCSS::$compress = true;

function parse($content, $expected, $note = '', $debug = false) {
    global $t;
    $parser = new SCSS_Parser();
    $lexer  = new SCSS_Lexer();
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
    $t->is( $parser->run(), $expected . PHP_EOL, $note );
    $parser->reset();
}

function throws_ok($content, $message = '') {
    global $t;
    $parser = new SCSS_Parser();
    $lexer  = new SCSS_Lexer();
    $lexer->setBuffer($content);
    $t->throws_ok(array($lexer, $parser), '$p[1]->yyparse($p[0]);', $message);
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
parse(
    $content,
    '*{font-size:100%}div{margin:0}p{padding:10px}a{color:#fff}',
    'simple rulesets'
);

// ============================================================
$content = <<<__CSS__
ul,li { list-style:none; }
span , a:hover { background:#efefef; }
__CSS__;
// ------------------------------------------------------------
parse(
    $content,
    'ul,li{list-style:none}span,a:hover{background:#efefef}',
    'multi selector'
);

// ============================================================
$content = <<<__CSS__
div { p { margin:0; } }
__CSS__;
// ------------------------------------------------------------
parse(
    $content,
    'div p{margin:0}',
    'simple recurisive ruleset'
);

// ============================================================
$content = <<<__CSS__
form {
    input,select { width:300px; }
}
__CSS__;
// ------------------------------------------------------------
parse(
    $content,
    'form input,form select{width:300px}',
    'single parent, multi child'
);

// ============================================================
$content = <<<__CSS__
FORM { INPUT,SELECT { WIDTH:300PX; } }
P { COLOR:#ABCDEF; BACKGROUND:URL('/IMAGES/BG.PNG') NO-REPEAT; }
__CSS__;
// ------------------------------------------------------------
parse(
    $content,
    "FORM INPUT,FORM SELECT{WIDTH:300PX}P{COLOR:#ABCDEF;BACKGROUND:URL('/IMAGES/BG.PNG') NO-REPEAT}",
    'upper case'
);

// ============================================================
$content = <<<__CSS__
ul,ol{li{border:1px solid red;}}
__CSS__;
// ------------------------------------------------------------
parse(
    $content,
    'ul li,ol li{border:1px solid red}',
    'multi parent, single child'
);

// ============================================================
$content = <<<__CSS__
dt,dd { sup,sub { font-color:red; } }
__CSS__;
// ------------------------------------------------------------
parse(
    $content,
    'dt sup,dt sub,dd sup,dd sub{font-color:red}',
    'multi parent, multi child'
);

// ============================================================
$content = <<<__CSS__
p
    {
        margin:
0
auto
10px
        ;
        padding:0;
    }
__CSS__;
// ------------------------------------------------------------
parse(
    $content,
    'p{margin:0 auto 10px;padding:0}',
    'NL separated expr'
);

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
parse(
    $content,
    '#content{height:100%}#content div{margin:0;padding:0}#content div p{margin:10px;line-height:1.5}#content div ul,#content div ol{margin:0}#content div ul li,#content div ol li{display:inline-block}',
    'complex'
);

$t->comment('variables');
// ============================================================
$content = <<<__CSS__
[% margin = '10px' %]
div { margin:[% margin %]; }
__CSS__;
// ------------------------------------------------------------
parse(
    $content,
    'div{margin:10px}',
    'variable as expr'
);

// ============================================================
$content = <<<__CSS__
[% margin = '10px' %]
div { margin:20px [% margin %] 5px [% margin %]; }
__CSS__;
// ------------------------------------------------------------
parse(
    $content,
    'div{margin:20px 10px 5px 10px}',
    'variable as term'
);

// ============================================================
$content = <<<__CSS__
[% anchor = "a { text-decoration:none; } a:hover { text-decoration:underline; }" %]
[%anchor%]
#header { [% anchor %] }
#footer { [% anchor %] }
__CSS__;
// ------------------------------------------------------------
parse(
    $content,
    'a{text-decoration:none}a:hover{text-decoration:underline}#header a{text-decoration:none}#header a:hover{text-decoration:underline}#footer a{text-decoration:none}#footer a:hover{text-decoration:underline}',
    'variable as ruleset'
);

$t->comment('etc');
// ============================================================
$content = <<<__CSS__
* { margin:0; }
[% IMPORT '../sample/width.scss' %]
#content { margin:0; }
__CSS__;
// ------------------------------------------------------------
parse(
    $content,
    '*{margin:0}#content{width:960px;margin:0 auto}#content{margin:0}',
    'IMPORT command'
);

// ============================================================
$content = <<<__CSS__
div { margin:0 }
p { margin:0; padding:0 }
a { color:red !important }
a:hover { color:#f30 }
__CSS__;
// ------------------------------------------------------------
parse(
    $content,
    'div{margin:0}p{margin:0;padding:0}a{color:red !important}a:hover{color:#f30}',
    'omited semicolon'
);

parse("", '', 'empty scss' );
parse("\n", '', 'empty scss' );
