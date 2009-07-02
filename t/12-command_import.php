<?php
require 'initialize.php';
$parser = new SCSS_Parser();

$t->comment( 'no parameter' );
$t->throws_ok( $parser, '$p->genCommand("IMPORT");', 'Need target filename' );

$t->comment( 'not scss file import' );
$t->throws_ok( $parser, '$p->genCommand("IMPORT", "filename");', 'IMPORT filename must be .scss' );

$t->comment( 'target file not found' );
$t->throws_ok( $parser, '$p->genCommand("IMPORT", "none.scss");', 'IMPORT file not found' );

$t->comment( 'import succeed' );
$t->is(
    $parser->genCommand('IMPORT', '../sample/width.scss'),
    "#content {\n    width:960px; margin:0 auto;\n}\n",
    'imported content'
);
