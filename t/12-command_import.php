<?php
chdir(dirname(__FILE__));
require 'utils.php';

$t->comment( 'import command' );
try {
    $parser->genCommand('IMPORT');
} catch (Exception $e) {
    $t->is( $e->getMessage(), 'Need target filename' );
}
