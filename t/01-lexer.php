<?php
require 'initialize.php';

$t->comment( 'test lexer instance' );
$t->ok( $lexer = new SCSS_Lexer(), 'get lexer instance' );
$t->isa_ok( $lexer, 'SCSS_Lexer', 'parser instance isa SCSS_Lexer' );

/*
 * lexical analyze
 */
function isToken($buffer, $tokenstr, $diag = null) {
    global $t;
    $lexer = new SCSS_Lexer();
    $lexer->setBuffer($buffer);
    $results = array();
    $tokens = array();
    foreach (explode(' ', $tokenstr) as $token) {
        $tokens[] = $token;
    }
    while ($result = $lexer->analyze($yylval)) {
        $results[] = is_numeric($result) ? chr($result) : $result;
    }
    if (is_null($diag)) {
        $diag = "token: $tokenstr";
    }
    $t->is( $results, $tokens, $diag );
}

$t->comment( 'skip comments' );
$lexer->setBuffer('/* comment */');
$t->is( $lexer->analyze($yylval), null, 'skip comment' );
$lexer->setBuffer('/*** comment ***/');
$t->is( $lexer->analyze($yylval), null, 'skip comment end of **/' );
$lexer->setBuffer("/**\n * comment\n **/\n");
$t->is( $lexer->analyze($yylval), null, 'skip multi lines comment' );

$t->comment( 'charset' );
isToken('@charset "utf-8";', 'CHARSET', 'CHARSET (lower case)');
isToken('@CHARSET "UTF-8";', 'CHARSET', 'CHARSET (upper case)');

$t->comment( 'import' );
$lexbuf = <<<__CSS__
/* import */
@import "base.css";
@import url('http://www.example.com/print.css') print;
@IMPORT URL("http://www.example.com/print.css") PRINT;
__CSS__;
isToken($lexbuf, 'IMPORT NL IMPORT NL IMPORT', 'IMPORT');

$t->comment( 'rulesets' );
isToken( '* { margin:0; }',
    'SELECTOR LBRACE SPACE IDENT : NUMBER ; SPACE }',
    'star selector'
);

isToken( '* { _margin:0; }',
    'SELECTOR LBRACE SPACE IDENT : NUMBER ; SPACE }',
    'under score hack'
);

isToken( 'div{margin:5px 10px}',
    'SELECTOR LBRACE IDENT : LENGTH SPACE LENGTH }',
    'basically ruleset'
);

isToken ("div { margin:10px\nauto\n15px; }",
    'SELECTOR LBRACE SPACE IDENT : LENGTH NL IDENT NL LENGTH ; SPACE }',
    'expressions splited by NL'
);

isToken( "p\n\n{\r\nmargin:\r\n\r\n0;}",
    'SELECTOR NL NL LBRACE NL IDENT : NL NL NUMBER ; }',
    'continuum NL'
);

isToken( "a:hover\n{\n line-height:1.5;\n }\n",
    'SELECTOR NL LBRACE NL SPACE IDENT : NUMBER ; NL SPACE } NL',
    'pseudo'
);

isToken( 'ul,ol { margin:0; padding:0; }',
    'SELECTOR LBRACE SPACE '.
    'IDENT : NUMBER ; SPACE '.
    'IDENT : NUMBER ; SPACE '.
    '}',
    'multi parent'
);

isToken( 'h2+p  ,  div > span { margin: 0; padding : 0 ; }',
    'SELECTOR LBRACE SPACE '.
    'IDENT : SPACE NUMBER ; SPACE '.
    'IDENT SPACE : SPACE NUMBER SPACE ; SPACE '.
    '}',
    'selectors with plus and greater operator'
);

$t->comment( 'recursive rulesets' );
isToken( 'div { width:100%; p { color:#3399ff; } }',
    'SELECTOR LBRACE SPACE IDENT : PERCENTAGE ; SPACE '.
    'SELECTOR LBRACE SPACE IDENT : HEXCOLOR ; SPACE } SPACE '.
    '}'
);

isToken( 'a:hover { color:#ccc; span:hover { text-decoration:underline; } }',
    'SELECTOR LBRACE SPACE IDENT : HEXCOLOR ; SPACE '.
    'SELECTOR LBRACE SPACE IDENT : IDENT ; SPACE } SPACE }',
    'resursive selector with pseudo'
);

isToken( 'div{a:hover{background:url("http://example.com/bg.png") no-repeat;}}',
    'SELECTOR LBRACE SELECTOR LBRACE '.
    'IDENT : URI SPACE IDENT ; } }',
    'no space, hexcolor, only child'
);

isToken( 'div { ul { list-style:none } margin:0 }',
    'SELECTOR LBRACE SPACE '.
    'SELECTOR LBRACE SPACE IDENT : IDENT SPACE } '.
    'SPACE IDENT : NUMBER SPACE }',
    'with spaces, parent rule after childs one'
);

isToken( 'DIV { UL { LIST-STYLE:NONE } BACKGROUND:URL("HTTP://EXAMPLE.COM/BG.PNG") NO-REPEAT }',
    'SELECTOR LBRACE SPACE '.
    'SELECTOR LBRACE SPACE IDENT : IDENT SPACE } '.
    'SPACE IDENT : URI SPACE IDENT SPACE }',
    'upper case'
);

$t->comment( 'variables' );
isToken( '[% HOGE %]', 'cLDELIM SPACE cCOMMAND SPACE cRDELIM', 'simple command' );

isToken( 'div { margin:0 }[% HOGE %]p{padding:0}',
    'SELECTOR LBRACE SPACE IDENT : NUMBER SPACE } '.
    'cLDELIM SPACE cCOMMAND SPACE cRDELIM '.
    'SELECTOR LBRACE IDENT : NUMBER }',
    'ruleset - command - ruleset'
);

isToken( 'h2 { border:1px solid [%sky%]; }',
    'SELECTOR LBRACE SPACE IDENT : LENGTH SPACE IDENT cLDELIM cIDENT cRDELIM ; SPACE }',
    'variable as a value'
);

isToken( "[% SEL %]\n{\n[% PROP %]\n:\n[% EXPR term %]\n}",
    'cLDELIM SPACE cCOMMAND SPACE cRDELIM NL LBRACE NL '.
    'cLDELIM SPACE cCOMMAND SPACE cRDELIM NL : NL '.
    'cLDELIM SPACE cCOMMAND SPACE cIDENT SPACE cRDELIM NL }',
    'command as selector, property, expr'
);

isToken( '[% fuga = "hogege" %][%uge=\'UGE\'%]',
    'cLDELIM SPACE cIDENT cEQUAL SPACE cVALUE SPACE cRDELIM '.
    'cLDELIM cIDENT cEQUAL cVALUE cRDELIM',
    'define variable'
);

$t->comment( 'commands' );
isToken( '[% IMPORT "hoge.scss" %][% IMPORT \'fuga.scss\' %]',
    'cLDELIM SPACE cCOMMAND SPACE cVALUE SPACE cRDELIM '.
    'cLDELIM SPACE cCOMMAND SPACE cVALUE SPACE cRDELIM',
    'IMPORT command'
);

$t->comment( 'loose property' );
isToken( 'body { *font-size:small }',
    'SELECTOR LBRACE SPACE LOOSE_PROP : IDENT SPACE }',
    'Loose property'
);
SmartCSS::$strict = true;
isToken( 'body { *font-size:small }',
    'SELECTOR LBRACE SPACE * IDENT : IDENT SPACE }',
    'Loose property had not parsed in strict mode'
);
