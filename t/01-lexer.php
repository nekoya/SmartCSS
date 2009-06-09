<?php
chdir(dirname(__FILE__));
require 'lime.php';
require '../libs/SCSS/Lexer.class.php';
$t = new lime_test();
$t->output = new lime_output_color();

$t->comment( 'test lexer instance' );
$t->ok( $lexer = new SCSS_Lexer(), 'get lexer instance' );
$t->isa_ok( $lexer, 'SCSS_Lexer', 'parser instance isa SCSS_Lexer' );

/*
 * lexical analyze
 */
function isToken($buffer, $tokenstr, $diag = null) {
    global $t, $lexer;
    $lexer->setBuffer($buffer);
    $results = array();
    $tokens = array();
    foreach (explode(' ', $tokenstr) as $token) {
        array_push($tokens, $token);
    }
    while ($result = $lexer->analyze($yylval)) {
        array_push( $results,
            is_numeric($result) ? chr($result) : $result
        );
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
@IMPORT URL('http://www.example.com/print.css') PRINT;
__CSS__;
isToken($lexbuf, 'IMPORT IMPORT IMPORT', 'IMPORT');

$t->comment( 'rulesets' );
isToken( '* { margin:0; }',
    'SELECTOR LBRACE SPACE IDENT : NUMBER ; SPACE }'
);

isToken( 'div{margin:5px 10px}',
    'SELECTOR LBRACE IDENT : LENGTH SPACE LENGTH }'
);

isToken( "a:hover {\nline-height:1.5;\n}\n",
    'SELECTOR LBRACE IDENT : NUMBER ; }'
);

isToken( 'ul,ol { margin:0; padding:0; }',
    'SELECTOR COMMA SELECTOR '.
    'LBRACE SPACE '.
    'IDENT : NUMBER ; SPACE '.
    'IDENT : NUMBER ; SPACE '.
    '}'
);

isToken( 'h2+p  ,  div > span { margin: 0; padding : 0 ; }',
    'SELECTOR COMMA SPACE SELECTOR '.
    'LBRACE SPACE '.
    'IDENT : SPACE NUMBER ; SPACE '.
    'IDENT SPACE : SPACE NUMBER SPACE ; SPACE '.
    '}'
);

$t->comment( 'recursive rulesets' );
isToken( 'div { width:100%; p { color:#3399ff; } }',
    'SELECTOR LBRACE SPACE IDENT : PERCENTAGE ; SPACE '.
    'SELECTOR LBRACE SPACE IDENT : HEXCOLOR ; SPACE } SPACE '.
    '}'
);

isToken( 'div{a:hover{color:#3399ff}}',
    'SELECTOR LBRACE '.
    'SELECTOR LBRACE IDENT : HEXCOLOR } '.
    '}',
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

$t->comment( 'commands' );
isToken( '[% HOGE %]', 'cLDELIM SPACE cCOMMAND SPACE cRDELIM', 'simple command' );

isToken( 'div { margin:0 }[% HOGE %]p{padding:0}',
    'SELECTOR LBRACE SPACE IDENT : NUMBER SPACE } '.
    'cLDELIM SPACE cCOMMAND SPACE cRDELIM '.
    'SELECTOR LBRACE IDENT : NUMBER }',
    'ruleset - command - ruleset'
);

isToken( '[% SEL %] { [% PROP %]:[% EXPR term %] }',
    'cLDELIM SPACE cCOMMAND SPACE cRDELIM LBRACE '.
    'cLDELIM SPACE cCOMMAND SPACE cRDELIM : '.
    'cLDELIM SPACE cCOMMAND SPACE cIDENT SPACE cRDELIM SPACE }',
    'command as selector, property, expr'
);

isToken( '[% fuga = "hogege" %][%uge=\'UGE\'%]',
    'cLDELIM SPACE cIDENT cEQUAL SPACE cVALUE SPACE cRDELIM '.
    'cLDELIM cIDENT cEQUAL cVALUE cRDELIM',
    'define variable'
);
