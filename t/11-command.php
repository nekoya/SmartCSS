<?php
chdir(dirname(__FILE__));
require 'utils.php';
$t->comment( 'test parser instance' );
$t->ok( $parser = SCSS_Parser::getInstance(), 'get parser instance' );
$t->isa_ok( $parser, 'SCSS_Parser', 'parser instance isa SCSS_Parser' );

$t->comment( 'not implemented command' );
try {
    $parser->genCommand('NONE');
} catch (Exception $e) {
    $t->is( $e->getMessage(), 'Command not found: NONE', 'Command not found: NONE' );
}
