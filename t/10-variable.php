<?php
require 'utils.php';
$t->comment( 'test parser instance' );
$t->ok( $parser = SCSS_Parser::getInstance(), 'get parser instance' );
$t->isa_ok( $parser, 'SCSS_Parser', 'parser instance isa SCSS_Parser' );

$t->comment( 'test variables' );
$t->is( $parser->getVar('hoge'), '', 'get undefined variable is ""' );
$t->is( $parser->setVar('hoge', '"fuga"'), 'fuga', 'set variable, return value' );
$t->is( $parser->getVar('hoge'), 'fuga', 'get variable' );
