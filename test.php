<?php
require 'scss.php';
try {
    $lexbuf = file_get_contents('test.css');
    $lexbuf = preg_replace('/^\s*(.*?)\s*$/m', '$1', $lexbuf);
    $lexbuf = preg_replace('/[\r\n]/', '', $lexbuf);
    yyparse();
    $parser = SCSS_Parser::getInstance();
    echo $parser->run();
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}
