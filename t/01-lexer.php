<?php
require 'utils.php';
$t->comment( 'test lexer instance' );
$t->ok( $lexer = SCSS_Lexer::getInstance(), 'get lexer instance' );
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
    while ($result = $lexer->yylex()) {
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
$t->is( $lexer->yylex(), null, 'skip comment' );
$lexer->setBuffer('/*** comment ***/');
$t->is( $lexer->yylex(), null, 'skip comment end of **/' );
$lexer->setBuffer("/**\n * comment\n **/\n");
$t->is( $lexer->yylex(), null, 'skip multi lines comment' );

$t->comment( 'charset' );
isToken('@charset "utf-8";', 'CHARSET');

$t->comment( 'import' );
$lexbuf = <<<__CSS__
/* import */
@import "base.css";
@import url('http://www.example.com/print.css') print;
__CSS__;
isToken($lexbuf, 'IMPORT IMPORT');

$t->comment( 'rulesets' );
isToken( '* { margin:0; }',
    'SELECTOR LBRACE SPACE IDENT : NUMBER ; SPACE RBRACE'
);

isToken( 'div{margin:5px 10px}',
    'SELECTOR LBRACE IDENT : LENGTH SPACE LENGTH RBRACE'
);

isToken( "a:hover {\nline-height:1.5;\n}\n",
    'SELECTOR LBRACE IDENT : NUMBER ; RBRACE'
);

isToken( 'ul,ol { margin:0; padding:0; }',
    'SELECTOR COMMA SELECTOR '.
    'LBRACE SPACE '.
    'IDENT : NUMBER ; SPACE '.
    'IDENT : NUMBER ; SPACE '.
    'RBRACE'
);

isToken( 'h2+p  ,  div > span { margin: 0; padding : 0 ; }',
    'SELECTOR COMMA SPACE SELECTOR '.
    'LBRACE SPACE '.
    'IDENT : SPACE NUMBER ; SPACE '.
    'IDENT SPACE : SPACE NUMBER SPACE ; SPACE '.
    'RBRACE'
);

$t->comment( 'recursive rulesets' );
isToken( 'div { width:100%; p { color:#3399ff; } }',
    'SELECTOR LBRACE SPACE IDENT : PERCENTAGE ; SPACE '.
    'SELECTOR LBRACE SPACE IDENT : HEXCOLOR ; SPACE RBRACE SPACE '.
    'RBRACE'
);

isToken( 'div{a:hover{color:#3399ff}}',
    'SELECTOR LBRACE '.
    'SELECTOR LBRACE IDENT : HEXCOLOR RBRACE '.
    'RBRACE'
);

isToken( 'div { ul { list-style:none } margin:0 }',
    'SELECTOR LBRACE SPACE '.
    'SELECTOR LBRACE SPACE IDENT : IDENT SPACE RBRACE '.
    'SPACE IDENT : NUMBER SPACE RBRACE'
);

