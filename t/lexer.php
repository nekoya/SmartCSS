<?php
require 'utils.php';
$t->comment( 'test lexer instance' );
$t->ok( $lexer = SCSS_Lexer::getInstance(), 'get lexer instance' );
$t->isa_ok( $lexer, 'SCSS_Lexer', 'parser instance isa SCSS_Lexer' );

/*
 * lexical analyze
 */
function isToken($buffer, $token, $diag = null) {
    global $t, $lexer;
    $lexer->setBuffer($buffer);
    $results = array();
    while ($result = $lexer->yylex()) {
        array_push( $results,
            is_numeric($result) ? chr($result) : $result
        );
    }
    if (is_null($diag)) {
        $diag = 'token(s): ' . join(' ', $token);
    }
    if (count($results) < 2) {
        $t->is( $results[0], $token, $diag );
    } else {
        $t->is( $results, $token, $diag );
    }
}

$t->comment( 'test lexical analyze' );
$lexer->setBuffer('/* comment */');
$t->is( $lexer->yylex(), null, 'skip comment' );
$lexer->setBuffer('/*** comment ***/');
$t->is( $lexer->yylex(), null, 'skip comment end of **/' );
$lexer->setBuffer("/**\n * comment\n **/\n");
$t->is( $lexer->yylex(), null, 'skip multi lines comment' );

isToken('@charset "utf-8";', 'CHARSET');

$lexbuf = <<<__CSS__
/* import */
@import "base.css";
@import 'print.css' print;
__CSS__;
isToken($lexbuf, array('IMPORT', 'IMPORT'));

$ruleset = array('SELECTOR', 'LBRACE', 'DECLARATION', 'RBRACE');
isToken( '* { margin:0; }', $ruleset );
isToken( 'div{margin:5px 10px}', $ruleset );
isToken( "p {\nline-height:1.5;\n}\n", $ruleset );

isToken(
    'ul,ol { margin:0; padding:0; }',
    array('SELECTOR', 'COMMA', 'SELECTOR', 'LBRACE', 'DECLARATION', 'DECLARATION', 'RBRACE')
);

isToken(
    'h2+p, div > span { margin: 0; padding : 0; }',
    array(
        'SELECTOR', 'PLUS', 'SELECTOR', 'COMMA', 'SELECTOR', 'GREATER', 'SELECTOR',
        'LBRACE', 'DECLARATION', 'DECLARATION', 'RBRACE',
    )
);

isToken(
    'div { margin:0; p { font-size:120%; } }',
    array(
        'SELECTOR', 'LBRACE', 'DECLARATION',
        'SELECTOR', 'LBRACE', 'DECLARATION', 'RBRACE',
        'RBRACE',
    )
);
