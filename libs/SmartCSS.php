<?php

//<?php
$parser = SCSS_Parser::getInstance();
//$parser->debug = true;

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
define('STRING', 260);
define('IDENT', 261);
define('NUMBER', 262);
define('HASH', 263);
define('HEXCOLOR', 264);
define('PERCENTAGE', 265);
define('URI', 266);
define('EMS', 267);
define('EXS', 268);
define('LENGTH', 269);
define('ANGLE', 270);
define('TIME', 271);
define('FREQ', 272);
define('IMPORTANT_SYM', 273);
define('CHARSET', 274);
define('IMPORT', 275);
define('SELECTOR', 276);
define('TERM', 277);
define('COMMA', 278);
define('cLDELIM', 279);
define('cRDELIM', 280);
define('cCOMMAND', 281);
define('cIDENT', 282);
define('cEQUAL', 283);
define('cVALUE', 284);

  
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
      0,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   30,   31,   20,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   21,   22,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
     31,   31,   31,   31,   31,   31,    1,    2,    3,    4,
      5,    6,    7,   31,    8,    9,   10,   11,   12,   13,
     14,   15,   16,   31,   17,   18,   19,   31,   23,   24,
     25,   26,   27,   28,   29
  );

define('YYBADCH', 31);
define('YYMAXLEX', 285);
define('YYTERMS', 31);
define('YYNONTERMS', 19);

$yyaction = array(
     27,   15,   28,  -19,   29,   30,   31,   32,   33,   34,
     23,   24,   21,   80,  -26,   25,   60,   17,   10,    0,
     85,   14,   16,   19,  -19,   51,   49,   46,   20,   14,
     18,   22,   40,  -26,    0,   52,    0,   88,   87,   86
  );

define('YYLAST', 40);

$yycheck = array(
      7,    2,    9,    2,   11,   12,   13,   14,   15,   16,
      5,    6,    3,    8,    3,   10,   19,   26,   27,    0,
      4,   24,   23,    6,   23,   20,   18,   17,   21,   24,
     28,   22,   29,   22,   -1,   30,   -1,   25,   25,   25
  );

$yybase = array(
     10,   11,   -7,    5,   17,    8,   17,    1,   -3,   -3,
      2,    9,   -1,   -9,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   16,   16,   16,   19,   14,   13,    7,    3,
     12,    0,    0,    5,    0,    0,   -3,   -3,   -3,   16,
      0,    0,   16
  );

define('YY2TBLSTATE', 11);

$yydefault = array(
      3,    8,32767,    8,32767,32767,   23,   42,    2,32767,
     42,32767,32767,32767,   42,   42,   42,   42,   42,   42,
     42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
     42,   42,   42,   42,   42,32767,32767,32767,32767,32767,
  32767,    5
  );



$yygoto = array(
     37,   69,   66,   59,   13,    4,    9,   36,   39,   53,
      3,   56,    6,   82,   81,   79,   83,   78,   71,   73,
     74,   72,   75,   76,   77,   26,    0,   26,   54,   67,
      0,   55,    0,   61
  );

define('YYGLAST', 34);

$yygcheck = array(
      9,   18,   15,   14,    9,    9,    9,    9,    9,    9,
      9,    9,    9,    9,    9,    9,    9,    9,    9,    9,
      9,    9,    9,    9,    9,   13,   -1,   13,   10,   10,
     -1,   10,   -1,   13
  );

$yygbase = array(
      0,    0,    0,    0,    0,    0,    0,    0,    0,  -10,
     23,    0,    0,   24,   -6,   -4,    0,    0,   -2
  );

$yygdefault = array(
  -32768,   35,   43,   41,    5,    8,   48,    2,   38,   57,
     63,   12,   11,    7,   58,   62,   64,    1,   70
  );

$yylhs = array(
      0,    1,    2,    3,    3,    4,    4,    6,    7,    7,
      7,    8,    5,    5,   10,   10,   11,   11,   14,   14,
     12,   12,   12,   16,   16,   16,   15,   17,   17,   18,
     18,   18,   18,   18,   18,   18,   18,   18,   18,   18,
     18,   18,    9,    9,   13,   13,   13
  );

$yylen = array(
      1,    1,    3,    0,    1,    0,    2,    1,    0,    1,
      1,    2,    1,    2,    6,    2,    1,    4,    1,    1,
      1,    1,    2,    2,    3,    3,    4,    1,    2,    3,
      3,    3,    3,    3,    3,    3,    3,    2,    1,    2,
      2,    2,    0,    1,    5,    5,    7
  );

define('YYSTATES', 81);
define('YYNLSTATES', 42);
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
{ $yyval = topnode($yyastk[$yysp-(1-1)]); } break;
        case 2:
{ $yyval = cat($yyastk[$yysp-(3-1)], array($yyastk[$yysp-(3-2)], $yyastk[$yysp-(3-3)])); } break;
        case 3:
{ $yyval = gen('empty'); } break;
        case 4:
{ $yyval = gen('charset', $yyastk[$yysp-(1-1)]); } break;
        case 5:
{ $yyval = gen('empty'); } break;
        case 6:
{ $yyval = cat($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 7:
{ $yyval = gen('import', $yyastk[$yysp-(1-1)]); } break;
        case 8:
{ $yyval = ''; } break;
        case 13:
{ $yyval = cat($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 14:
{ $yyval = gen('ruleset', $yyastk[$yysp-(6-1)], $yyastk[$yysp-(6-4)]); } break;
        case 17:
{ $yyval = cat($yyastk[$yysp-(4-1)], $yyastk[$yysp-(4-4)]); } break;
        case 18:
{ $yyval = gen('selector', $yyastk[$yysp-(1-1)]); } break;
        case 22:
{ $yyval = cat($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 24:
{ $yyval = $yyastk[$yysp-(3-3)]; } break;
        case 25:
{ $yyval = $yyastk[$yysp-(3-3)]; } break;
        case 26:
{ $yyval = gen('declaration', $yyastk[$yysp-(4-1)], $yyastk[$yysp-(4-4)]); } break;
        case 28:
{ $yyval = $yyastk[$yysp-(2-1)] . ' ' . $yyastk[$yysp-(2-2)]; } break;
        case 29:
{ $yyval = $yyastk[$yysp-(3-1)] . $yyastk[$yysp-(3-2)]; } break;
        case 30:
{ $yyval = $yyastk[$yysp-(3-1)] . $yyastk[$yysp-(3-2)]; } break;
        case 31:
{ $yyval = $yyastk[$yysp-(3-1)] . $yyastk[$yysp-(3-2)]; } break;
        case 32:
{ $yyval = $yyastk[$yysp-(3-1)] . $yyastk[$yysp-(3-2)]; } break;
        case 33:
{ $yyval = $yyastk[$yysp-(3-1)] . $yyastk[$yysp-(3-2)]; } break;
        case 34:
{ $yyval = $yyastk[$yysp-(3-1)] . $yyastk[$yysp-(3-2)]; } break;
        case 35:
{ $yyval = $yyastk[$yysp-(3-1)] . $yyastk[$yysp-(3-2)]; } break;
        case 36:
{ $yyval = $yyastk[$yysp-(3-1)] . $yyastk[$yysp-(3-2)]; } break;
        case 44:
{ $yyval = gen('command', $yyastk[$yysp-(5-3)]); } break;
        case 45:
{ $yyval = getvar($yyastk[$yysp-(5-3)]); } break;
        case 46:
{ $yyval = setvar($yyastk[$yysp-(7-3)], $yyastk[$yysp-(7-6)]); } break;
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


function __autoload($class) {
    $dirname = dirname(__FILE__);
    $class = preg_replace('/_/', DIRECTORY_SEPARATOR, $class);
    $filename = $dirname . DIRECTORY_SEPARATOR . $class . '.class.php';
    require $filename;
}

function yylex() {
    $lexer = SCSS_Lexer::getInstance();
    $token = $lexer->yylex();
    return (defined($token)) ? constant($token) : $token;
}

function yyerror($msg) {
    throw new Exception($msg);
}

function gen($type, $val1 = null, $val2 = null) {
    $parser = SCSS_Parser::getInstance();
    $method = 'gen' . ucfirst($type);
    return $parser->$method($val1, $val2);
}

function cat($base, $newone) {
    $parser = SCSS_Parser::getInstance();
    return $parser->catNode($base, $newone);
}

function topnode($node) {
    $parser = SCSS_Parser::getInstance();
    return $parser->setTopNode($node);
}

function setvar($var, $value) {
    $parser = SCSS_Parser::getInstance();
    return $parser->setVar($var, $value);
}

function getvar($var) {
    $parser = SCSS_Parser::getInstance();
    return $parser->getVar($var);
}
