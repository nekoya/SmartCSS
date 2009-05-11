<?php
require 'libs/SmartCSS.php';
try {
    $lexer = SCSS_Lexer::getInstance();
    $lexer->setBuffer(file_get_contents('test.css'));
    yyparse();
    $parser = SCSS_Parser::getInstance();
    echo $parser->run();
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}
