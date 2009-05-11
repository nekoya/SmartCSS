<?php
require '../libs/SmartCSS.php';
require 'lime.php';
$t = new lime_test();
$t->output = new lime_output_color();

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
        }
    }
}
__CSS__;

$lexer = SCSS_Lexer::getInstance();
$lexer->setBuffer($content);
yyparse();
$parser = SCSS_Parser::getInstance();
echo $parser->run();
$parser->reset();
