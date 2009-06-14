<?php
require 'initialize.php';
$parser = new SCSS_Parser();

$t->comment('autoload SCSS_Lexer');
$t->ok( !class_exists('SCSS_Lexer', false), 'SCSS_Lexer is not loaded' );
$t->ok( SCSS_AutoLoader::autoload('SCSS_Lexer'), 'loading SCSS_Lexer' );
$t->ok( class_exists('SCSS_Lexer', false), 'SCSS_Lexer exists' );

$t->comment('autoload SCSS_None');
$t->ok( !class_exists('SCSS_None', false), 'SCSS_None is not loaded' );

$t->throws_ok( null, 'SCSS_AutoLoader::autoload("SCSS_None");', 'Could not load class: SCSS_None' );

$t->ok( !class_exists('SCSS_None', false), 'SCSS_None does not loaded yet' );

$t->comment('autoload Hoge (not SCSS::* namespace)');
$t->ok( !class_exists('Hoge', false), 'Hoge is not loaded' );
$t->false( SCSS_AutoLoader::autoload('Hoge'), 'does not loading Hoge' );
$t->ok( !class_exists('Hoge', false), 'Hoge does not loaded yet' );
