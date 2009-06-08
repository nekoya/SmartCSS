%{
// 足し算しかできない計算機
//
// 使い方の例
// php hoge.php 1 + 2 + 3 
%}
%token NUMBER
%token '+'
%%
stmt: expr { var_dump($$); };

expr: expr '+' NUMBER { $$ = $1 + $3; } | NUMBER { $$ = $1; };
%%
class Lexer {
    function yylex(&$yylval) {
        $yylval = array_shift($_SERVER['argv']);
        if ($yylval == '+')
            return ord('+');
        else if ($yylval === NULL)
            return 0;
        else
            return YYParser::NUMBER;
    }
}

array_shift($_SERVER['argv']);

$l = new Lexer();
$p = new YYParser();
$p->yyparse($l);
