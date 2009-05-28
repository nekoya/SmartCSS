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
      0,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   24,   25,   20,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   21,   22,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,   25,   25,   25,   25,
     25,   25,   25,   25,   25,   25,    1,    2,    3,    4,
      5,    6,    7,   25,    8,    9,   10,   11,   12,   13,
     14,   15,   16,   25,   17,   18,   19,   25,   23
  );

define('YYBADCH', 25);
define('YYMAXLEX', 279);
define('YYTERMS', 25);
define('YYNONTERMS', 18);

$yyaction = array(
     20,  -24,   21,   10,   22,   23,   24,   25,   26,   27,
     17,   18,   15,   67,    0,   19,   71,  -24,   48,   13,
    -24,   35,    0,   14,   11,   40,   38,    0,    0,   41,
      0,   16
  );

define('YYLAST', 32);

$yycheck = array(
      7,    3,    9,    2,   11,   12,   13,   14,   15,   16,
      5,    6,    3,    8,    0,   10,    4,   19,   19,    6,
     22,   17,   -1,   21,   23,   20,   18,   -1,   -1,   24,
     -1,   22
  );

$yybase = array(
      4,   -2,   -7,    5,    9,   13,    8,    1,   -1,   13,
     12,   12,   -1,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   14,    2,
      0,    0,    5,    0,    0,   -1,   -1,   -1
  );

define('YY2TBLSTATE', 7);

$yydefault = array(
      3,    8,32767,    8,32767,32767,32767,32767,    2,   22,
     39,   39,32767,   39,   39,   39,   39,   39,   39,   39,
     39,   39,   39,   39,   39,   39,   39,   39,32767,32767,
      5
  );



$yygoto = array(
     12,   56,   42,    3,   45,    9,   69,   68,   66,   65,
     58,   60,   61,   59,   62,   63,   64,   50,   43,   54,
     44,   47
  );

define('YYGLAST', 22);

$yygcheck = array(
      9,   17,    9,    9,    9,    9,    9,    9,    9,    9,
      9,    9,    9,    9,    9,    9,    9,   10,   10,   14,
     10,   13
  );

$yygbase = array(
      0,    0,    0,    0,    0,    0,    0,    0,    0,  -11,
     12,    0,    0,    9,   10,    0,    0,   -2
  );

$yygdefault = array(
  -32768,   28,   32,   30,    6,    8,   37,    2,   29,    5,
     52,    7,    4,   46,   49,   51,    1,   57
  );

$yylhs = array(
      0,    1,    2,    3,    3,    4,    4,    6,    7,    7,
      7,    8,    5,    5,   10,   11,   11,   13,   12,   12,
     12,   12,   15,   15,   14,   16,   16,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,    9,
      9
  );

$yylen = array(
      1,    1,    3,    0,    1,    0,    2,    1,    0,    1,
      1,    2,    1,    2,    6,    1,    4,    1,    1,    1,
      2,    2,    2,    3,    4,    1,    2,    3,    3,    3,
      3,    3,    3,    3,    3,    2,    1,    2,    2,    0,
      1
  );

define('YYSTATES', 64);
define('YYNLSTATES', 31);
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
        case 16:
{ $yyval = cat($yyastk[$yysp-(4-1)], $yyastk[$yysp-(4-4)]); } break;
        case 17:
{ $yyval = gen('selector', $yyastk[$yysp-(1-1)]); } break;
        case 20:
{ $yyval = cat($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 21:
{ $yyval = cat($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 23:
{ $yyval = $yyastk[$yysp-(3-3)]; } break;
        case 24:
{ $yyval = gen('declaration', $yyastk[$yysp-(4-1)], $yyastk[$yysp-(4-4)]); } break;
        case 26:
{ $yyval = $yyastk[$yysp-(2-1)] . ' ' . $yyastk[$yysp-(2-2)]; } break;
        case 27:
{ $yyval = $yyastk[$yysp-(3-1)] . $yyastk[$yysp-(3-2)]; } break;
        case 28:
{ $yyval = $yyastk[$yysp-(3-1)] . $yyastk[$yysp-(3-2)]; } break;
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
