<?php

//<?php
$parser = Parser::getInstance();
$parser->debug = true;

/* Prototype file of PHP parser.
 * Written by Masato Bito
 * This file is PUBLIC DOMAIN.
 */

$buffer = null;
$token = null;
$toktype = null;

define('YYERRTOK', 256);
define('LBRACE', 257);
define('RBRACE', 258);
define('SPACE', 259);
define('PLUS', 260);
define('GREATER', 261);
define('ASTERISK', 262);
define('STRING', 263);
define('IDENT', 264);
define('NUMBER', 265);
define('HASH', 266);
define('HEXCOLOR', 267);
define('PERCENTAGE', 268);
define('URI', 269);
define('EMS', 270);
define('EXS', 271);
define('LENGTH', 272);
define('ANGLE', 273);
define('TIME', 274);
define('FREQ', 275);
define('IMPORTANT_SYM', 276);
define('CHARSET', 277);
define('IMPORT_SYM', 278);
define('MEDIA_SYM', 279);
define('PAGE_SYM', 280);
define('EXPRESSION', 281);

  
/*
  #define yyclearin (yychar = -1)
  #define yyerrok (yyerrflag = 0)
  #define YYRECOVERING (yyerrflag != 0)
  #define YYERROR  goto yyerrlab
*/


/** Debug mode flag **/
$yydebug = false;

/** lexical element object **/
$yylval = null;

function yyprintln($msg)
{
  echo "$msg\n";
}

function yyflush()
{
  return;
}



$yytranslate = array(
      0,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   12,   16,   15,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   13,   14,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,    1,    2,    3,    4,
      5,    6,    7,   16,    8,   16,    9,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   10,   16,   16,
     16,   11
  );

define('YYBADCH', 16);
define('YYMAXLEX', 282);
define('YYTERMS', 16);
define('YYNONTERMS', 21);

$yyaction = array(
     49,    0,   53,   16,   17,   39,  -30,    2,   21,   48,
    -13,   32,   23,   63,   35,   48,   10,  -30,-32766,   19,
     47,   25,    0,    0,    0,   61,    0,   18,  -36,    0,
     -9
  );

define('YYLAST', 31);

$yycheck = array(
      7,    0,    9,    5,    6,    3,    3,    2,   15,    8,
      2,   10,    4,    4,    4,    8,   14,   14,    7,   13,
      8,    8,   -1,   -1,   -1,   11,   -1,   12,   12,   -1,
     13
  );

$yybase = array(
      0,    1,   13,   13,    7,    7,    7,    7,    7,    8,
      3,   10,   11,   11,   11,    2,    9,    9,    9,    9,
     14,   12,    5,   16,   15,   17,    6,    0,   -7,   -7,
     -7,   -7,   -7,   -7,   -7,   -7,   -2,    9,   -2,   -7,
     -7,   -7
  );

define('YY2TBLSTATE', 15);

$yydefault = array(
      1,32767,32767,32767,32767,    3,    4,32767,32767,   35,
     35,   14,   17,   18,   19,32767,   35,   35,   35,   35,
  32767,32767,32767,    8,32767,   21,32767
  );



$yygoto = array(
      3,   51,   51,    6,   56,   11,   33,   34,    7,   20,
     37,   43,    0,   37,   38,   38,   14
  );

define('YYGLAST', 17);

$yygcheck = array(
      6,   16,   16,    3,   17,   11,    6,    6,    6,    6,
      8,   12,   -1,    8,    8,    8,   14
  );

$yygbase = array(
      0,    0,    0,   -1,    0,    0,  -10,    0,    9,    0,
      0,   -2,    3,    0,    4,    0,  -12,    1,    0,    0,
      0
  );

$yygdefault = array(
  -32768,    1,   29,    5,    4,    8,   24,   26,   59,   22,
     15,    9,   42,   12,   13,   52,   50,   54,   55,   58,
     60
  );

$yylhs = array(
      0,    1,    1,    2,    2,    4,    5,    5,    5,    7,
      3,    3,    8,    9,    9,   11,   11,   12,   12,   12,
     15,   13,   13,   14,   14,   16,   16,   10,   10,   18,
     18,   17,   17,   19,   20,    6,    6
  );

$yylen = array(
      1,    0,    2,    1,    2,    1,    2,    2,    1,    1,
      1,    2,    4,    1,    5,    1,    3,    1,    1,    2,
      2,    1,    1,    1,    2,    1,    1,    1,    2,    3,
      1,    1,    1,    4,    1,    0,    1
  );

define('YYSTATES', 52);
define('YYNLSTATES', 27);
define('YYINTERRTOK', 1);
define('YYUNEXPECTED', 32767);
define('YYDEFAULT', -32766);

/*
 * Parser entry point
 */

function yyparse()
{
  global $buffer, $token, $toktype, $yyaction, $yybase, $yycheck, $yydebug,
    $yydebug, $yydefault, $yygbase, $yygcheck, $yygdefault, $yygoto, $yylen,
    $yylhs, $yylval, $yyproduction, $yyterminals, $yytranslate;

  $yyastk = array();
  $yysstk = array();

  $yyn = $yyl = 0;
  $yystate = 0;
  $yychar = -1;

  $yysp = 0;
  $yysstk[$yysp] = 0;
  $yyerrflag = 0;
  while (true) {
    if ($yybase[$yystate] == 0)
      $yyn = $yydefault[$yystate];
    else {
      if ($yychar < 0) {
        if (($yychar = yylex()) <= 0) $yychar = 0;
        $yychar = $yychar < YYMAXLEX ? $yytranslate[$yychar] : YYBADCH;
      }

      if ((($yyn = $yybase[$yystate] + $yychar) >= 0
	   && $yyn < YYLAST && $yycheck[$yyn] == $yychar
           || ($yystate < YY2TBLSTATE
               && ($yyn = $yybase[$yystate + YYNLSTATES] + $yychar) >= 0
               && $yyn < YYLAST && $yycheck[$yyn] == $yychar))
	  && ($yyn = $yyaction[$yyn]) != YYDEFAULT) {
        /*
         * >= YYNLSTATE: shift and reduce
         * > 0: shift
         * = 0: accept
         * < 0: reduce
         * = -YYUNEXPECTED: error
         */
        if ($yyn > 0) {
          /* shift */
          $yysp++;

          $yysstk[$yysp] = $yystate = $yyn;
          $yyastk[$yysp] = $yylval;
          $yychar = -1;
          
          if ($yyerrflag > 0)
            $yyerrflag--;
          if ($yyn < YYNLSTATES)
            continue;
            
          /* $yyn >= YYNLSTATES means shift-and-reduce */
          $yyn -= YYNLSTATES;
        } else
          $yyn = -$yyn;
      } else
        $yyn = $yydefault[$yystate];
    }
      
    while (true) {
      /* reduce/error */
      if ($yyn == 0) {
        /* accept */
        yyflush();
        return 0;
      }
      else if ($yyn != YYUNEXPECTED) {
        /* reduce */
        $yyl = $yylen[$yyn];
        $n = $yysp-$yyl+1;
        $yyval = isset($yyastk[$n]) ? $yyastk[$n] : null;
        /* Following line will be replaced by reduce actions */
        switch($yyn) {
        case 1:
{ $yyval = Parser::getInstance()->genTopNode(); } break;
        case 2:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 4:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 5:
{ $yyval = Parser::getInstance()->genCharset($yyastk[$yysp-(1-1)]); } break;
        case 6:
{ $yyval = '+'; } break;
        case 7:
{ $yyval = '>'; } break;
        case 9:
{ $yyval = Parser::getInstance()->genProperty($yyastk[$yysp-(1-1)]); } break;
        case 11:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 12:
{ $yyval = Parser::getInstance()->genRuleset($yyastk[$yysp-(4-1)], $yyastk[$yysp-(4-3)]); } break;
        case 14:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(5-1)], $yyastk[$yysp-(5-5)]); } break;
        case 15:
{ $yyval = Parser::getInstance()->genSelector($yyastk[$yysp-(1-1)]); } break;
        case 16:
{ $yyval = $yyastk[$yysp-(3-1)]; $yyastk[$yysp-(3-1)]->appendValue($yyastk[$yysp-(3-2)], $yyastk[$yysp-(3-3)]); } break;
        case 19:
{ $yyval = $yyastk[$yysp-(2-1)] . $yyastk[$yysp-(2-2)]; } break;
        case 20:
{ $yyval = chr($yyastk[$yysp-(2-1)]) . $yyastk[$yysp-(2-2)]; } break;
        case 24:
{ $yyval = $yyastk[$yysp-(2-1)] . $yyastk[$yysp-(2-2)]; } break;
        case 28:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 29:
{ $yyval = $yyastk[$yysp-(3-3)]; } break;
        case 33:
{ $yyval = Parser::getInstance()->genDeclaration($yyastk[$yysp-(4-1)], $yyastk[$yysp-(4-4)]); } break;
        case 34:
{ $yyval = Parser::getInstance()->genExpr($yyastk[$yysp-(1-1)]); } break;
        }
        /* Goto - shift nonterminal */
        $yysp -= $yyl;
        $yyn = $yylhs[$yyn];
        if (($yyp = $yygbase[$yyn] + $yysstk[$yysp]) >= 0 && $yyp < YYGLAST
            && $yygcheck[$yyp] == $yyn)
          $yystate = $yygoto[$yyp];
        else
          $yystate = $yygdefault[$yyn];
          
        $yysp++;

        $yysstk[$yysp] = $yystate;
        $yyastk[$yysp] = $yyval;
      }
      else {
        /* error */
        switch ($yyerrflag) {
        case 0:
          yyerror("syntax error");
        case 1:
        case 2:
          $yyerrflag = 3;
          /* Pop until error-expecting state uncovered */

          while (!(($yyn = $yybase[$yystate] + YYINTERRTOK) >= 0
                   && $yyn < YYLAST && $yycheck[$yyn] == YYINTERRTOK
                   || ($yystate < YY2TBLSTATE
                       && ($yyn = $yybase[$yystate + YYNLSTATES] + YYINTERRTOK) >= 0
                       && $yyn < YYLAST && $yycheck[$yyn] == YYINTERRTOK))) {
            if ($yysp <= 0) {
              yyflush();
              return 1;
            }
            $yystate = $yysstk[--$yysp];
          }
          $yyn = $yyaction[$yyn];
          $yysstk[++$yysp] = $yystate = $yyn;
          break;

        case 3:
          if ($yychar == 0) {
            yyflush();
            return 1;
          }
          $yychar = -1;
          break;
        }
      }
        
      if ($yystate < YYNLSTATES)
        break;
      /* >= YYNLSTATES means shift-and-reduce */
      $yyn = $yystate - YYNLSTATES;
    }
  }
}


try {
    $lexbuf = file_get_contents('test.css');
    $lexbuf = preg_replace('/^\s*(.*?)\s*$/m', '$1', $lexbuf);
    $lexbuf = preg_replace('/[\r\n]/', '', $lexbuf);
    defineRegexs();
    yyparse();
    $parser = Parser::getInstance();
    echo $parser->run();
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

function __autoload($class) {
    $class = preg_replace('/_/', DIRECTORY_SEPARATOR, $class);
    require "libs/$class.class.php";
}

function yylex() {
    global $lexbuf, $yylval, $regexs;
    $parser = Parser::getInstance();

    while ($lexbuf) {
        if (!empty($parser->debug)) {
            //var_dump($lexbuf);
        }

        foreach ($regexs as $token => $regex) {
            $regex = '/^('.$regex.')/i';
            if (preg_match($regex, $lexbuf, $matches)) {
                //var_dump($matches);
                $yylval = (string)$matches[1];
                $lexbuf = substr($lexbuf, strlen($yylval));
                p($token . ' ' . $yylval);
                if ($token === 'COMMENT') {
                    /* ignore comment */
                    break;
                }
                return constant($token);
            }
        }
        if ($token !== 'COMMENT') {
            $yylval = ord($lexbuf);
            $lexbuf = substr($lexbuf, 1);
            return $yylval;
        }
    }
}

function yyerror($msg) {
    global $lexbuf;
    var_dump($lexbuf);
    die("[error]$msg\n");
}

function p($msg) {
    $parser = Parser::getInstance();
    if (!empty($parser->debug)) {
        echo $msg . "\n";
    }
}

function defineRegexs() {
    global $regexs;
    $regexs = array(
        'LBRACE'        => '\s*{\s*',
        'RBRACE'        => '\s*}\s*',

        'EXPRESSION'    =>
        '(?:'.
            '(?:'.
                '{{unary_operator}}{{PERCENTAGE}}|'.
                '{{unary_operator}}{{LENGTH}}|'.
                '{{unary_operator}}{{EMS}}|'.
                '{{unary_operator}}{{EXS}}|'.
                '{{unary_operator}}{{ANGLE}}|'.
                '{{unary_operator}}{{TIME}}|'.
                '{{unary_operator}}{{FREQ}}|'.
                '{{unary_operator}}{{NUMBER}}|'.
                '{{URI}}|'.
                '{{HEXCOLOR}}|'.
                '{{IDENT}}|'.
                '{{STRING}}'.
            ')'.
        '\s*)+'.
        '({{IMPORTANT_SYM}})?'.
        '(?=[;}])',

        'COMMENT'       => '\s*\/\*.*?\*\/\s*',
        'STRING'        => '{{string}}',
        'URI'           => 'url\(\s*{{string}}\s*\)',
        'IMPORTANT_SYM' => '!important\s*',
        'CHARSET'       => '@charset\s*{{string}};',
        'IMPORT_SYM'    => '@import\s*',
        'MEDIA_SYM'     => '@media\s*',
        'PAGE_SYM'      => '@page\s*',

        'EMS'           => '{{num}}em',
        'EXS'           => '{{num}}ex',
        'LENGTH'        => '{{num}}(px|cm|mm|in|pt|pc)',
        'ANGLE'         => '{{num}}(deg|rad|grad)',
        'TIME'          => '{{num}}(ms|s)',
        'FREQ'          => '{{num}}(hz|khz)',

        'HEXCOLOR'      => '#(?:{{h}}{6}|{{h}}{3})',
        'HASH'          => '#{{name}}+',
        'IDENT'         => '{{ident}}',
        'PERCENTAGE'    => '{{num}}+%',
        'NUMBER'        => '{{num}}',
        'PLUS'          => '\s*\+',
        'GREATER'       => '\s*\>',
        'ASTERISK'      => '\*',
        'SPACE'         => '\s+',
    );
    $rules = array(
        'h'       => '[0-9a-f]',
        'ident'   => '-?{{nmstart}}{{nmchar}}*',
        'nmstart' => '[_a-z]',
        'nmchar'  => '[_a-z0-9-]',
        'name'    => '{{nmchar}}+',
        'num'     => '\d*\.{0,1}\d+',
        'string'  => '(?:".*?"|\'.*?\')',
        'unary_operator' => '(?:\+|\-)?',
    );
    foreach ($rules as $token => &$regex) {
        while (preg_match('/({{(.+?)}})/', $regex, $matches)) {
            $regex = preg_replace("/$matches[1]/", $rules[$matches[2]], $regex);
        }
    }
    foreach ($regexs as $token => &$regex) {
        while (preg_match('/({{(.+?)}})/', $regex, $matches)) {
            $key = $matches[2];
            if (array_key_exists($key, $rules)) {
                $replace = $rules;
            } else if (array_key_exists($key, $regexs)) {
                $replace = $regexs;
            } else {
                throw new Exception("$key is not defined in lexer.");
            }
            $regex = preg_replace("/$matches[1]/", $replace[$key], $regex);
        }
    }
}
