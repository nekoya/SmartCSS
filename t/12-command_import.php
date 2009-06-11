<?php
chdir(dirname(__FILE__));
require 'utils.php';

$t->comment( 'no parameter' );
try {
    $threw = false;
    $parser->genCommand('IMPORT');
} catch (Exception $e) {
    $threw = true;
    $t->is( $e->getMessage(), 'Need target filename', 'Need target filename' );
}
$t->ok( $threw === true, 'threw exception' );

$t->comment( 'not scss file import' );
try {
    $threw = false;
    $parser->genCommand('IMPORT', 'filename');
} catch (Exception $e) {
    $threw = true;
    $t->is( $e->getMessage(), 'IMPORT filename must be .scss', 'IMPORT filename must be .scss' );
}
$t->ok( $threw === true, 'threw exception' );

$t->comment( 'target file not found' );
try {
    $threw = false;
    $parser->genCommand('IMPORT', 'none.scss');
} catch (Exception $e) {
    $threw = true;
    $t->is( $e->getMessage(), 'IMPORT file not found', 'IMPORT file not found' );
}
$t->ok( $threw === true, 'threw exception' );

$t->comment( 'import succeed' );
$t->is(
    $parser->genCommand('IMPORT', '../sample/width.scss'),
    '#content { width:960px; margin:0 auto; }' . PHP_EOL,
    'imported content'
);
