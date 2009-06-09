#!/bin/sh
kmyacc -m kmyacc.class.php.parser -L php -p SCSS_Parser Parser.y
mv Parser.php ../libs/SCSS/Parser.class.php
