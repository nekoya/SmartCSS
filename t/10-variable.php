<?php
chdir(dirname(__FILE__));
require 'utils.php';

$t->comment( 'test variables' );
$t->is( $parser->getVar('hoge'), '', 'get undefined variable is ""' );
$t->is( $parser->setVar('hoge', '"fuga"'), 'fuga', 'set variable, return value' );
$t->is( $parser->getVar('hoge'), 'fuga', 'get variable' );
