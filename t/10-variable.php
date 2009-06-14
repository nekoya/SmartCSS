<?php
require 'initialize.php';
$parser = new SCSS_Parser();

$t->comment( 'test variables' );
$t->is( $parser->getVar('hoge'), '', 'get undefined variable is ""' );
$t->is( $parser->setVar('hoge', '"fuga"'), 'fuga', 'set variable, return value' );
$t->is( $parser->getVar('hoge'), 'fuga', 'get variable' );
