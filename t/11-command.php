<?php
chdir(dirname(__FILE__));
require 'utils.php';

$t->comment( 'not implemented command' );
try {
    $parser->genCommand('NONE');
} catch (Exception $e) {
    $t->is( $e->getMessage(), 'Command not found: NONE', 'Command not found: NONE' );
}
