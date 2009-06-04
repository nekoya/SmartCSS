<?php

//<?php

/* Prototype file of PHP parser.
 * Written by Masato Bito
 * This file is PUBLIC DOMAIN.
 */

$buffer = null;
$token = null;
$toktype = null;

define('YYERRTOK', 256);
define('LBRACE', 257);
define('SPACE', 258);
define('STRING', 259);
define('IDENT', 260);
define('NUMBER', 261);
define('HASH', 262);
define('HEXCOLOR', 263);
define('PERCENTAGE', 264);
define('URI', 265);
define('EMS', 266);
define('EXS', 267);
define('LENGTH', 268);
define('ANGLE', 269);
define('TIME', 270);
define('FREQ', 271);
define('IMPORTANT_SYM', 272);
define('CHARSET', 273);
define('IMPORT', 274);
define('SELECTOR', 275);
define('TERM', 276);
define('COMMA', 277);
define('cLDELIM', 278);
define('cRDELIM', 279);
define('cCOMMAND', 280);
define('cIDENT', 281);
define('cEQUAL', 282);
define('cVALUE', 283);

  
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
     31,   31,   31,   31,   31,    3,   31,   31,   31,   31,
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
     31,   31,   31,   31,   31,   31,    1,    2,    4,    5,
      6,    7,   31,    8,    9,   10,   11,   12,   13,   14,
     15,   16,   31,   17,   18,   19,   31,   23,   24,   25,
     26,   27,   28,   29
  );

define('YYBADCH', 31);
define('YYMAXLEX', 284);
define('YYTERMS', 31);
define('YYNONTERMS', 18);

$yyaction = array(
     26,   13,   27,    0,   28,   29,   30,   31,   32,   33,
     22,   23,   84,   79,   62,   24,   36,   20,   48,   11,
     18,   18,   14,   15,    8,   53,   62,   51,   34,   11,
     17,   19,    0,   21,    0,   54,   87,    0,   85,    0,
      0,   88,   86,    0,    0,    0,    0,   40
  );

define('YYLAST', 48);

$yycheck = array(
      7,    2,    9,    0,   11,   12,   13,   14,   15,   16,
      5,    6,    4,    8,   19,   10,    4,    3,   17,   24,
      6,    6,   23,   26,   27,   20,   19,   18,   22,   24,
     28,   21,   -1,   29,   -1,   30,   25,   -1,   25,   -1,
     -1,   25,   25,   -1,   -1,   -1,   -1,   29
  );

$yybase = array(
      1,    6,   -7,    5,   14,   15,    9,   -5,    2,   -1,
     -3,    8,    8,    8,    8,   12,    7,    8,    8,    8,
      8,    8,    8,    8,    8,    8,    8,    8,    8,    8,
      8,    8,    8,    8,    8,    3,   18,   13,   11,   10,
     17,    4,   16,    0,    0,    5,    0,    0,   -5,   -5,
     -5,    0,    8
  );

define('YY2TBLSTATE', 9);

$yydefault = array(
      3,    8,32767,    8,32767,32767,32767,    2,   39,32767,
  32767,   39,   39,   39,   39,   39,32767,   39,   39,   39,
     39,   39,   39,   39,   39,   39,   39,   39,   39,   39,
     39,   39,   39,   39,   39,32767,   40,32767,32767,32767,
  32767,32767,32767,    5
  );



$yygoto = array(
     10,   59,    5,   16,   37,   68,   41,   55,    3,   58,
     42,   81,   80,   78,   82,   77,   70,   72,   73,   71,
     74,   75,   76,   67,   64,   56,   57,   25,   63,   25,
     61
  );

define('YYGLAST', 31);

$yygcheck = array(
      9,    9,    9,    9,    9,   17,    9,    9,    9,    9,
      9,    9,    9,    9,    9,    9,    9,    9,    9,    9,
      9,    9,    9,    9,   10,   10,   10,   13,   15,   13,
     14
  );

$yygbase = array(
      0,    0,    0,    0,    0,    0,    0,    0,    0,  -11,
     19,    0,    0,   26,   14,   23,    0,    2
  );

$yygdefault = array(
  -32768,   35,   45,   43,    6,    7,   50,    2,   39,   38,
     66,    9,    4,   12,   60,   65,    1,   69
  );

$yylhs = array(
      0,    1,    2,    3,    3,    4,    4,    6,    7,    7,
      7,    8,    5,    5,   10,   10,   11,   11,   14,   12,
     12,   12,   12,   15,   16,   16,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,    9,
      9,   13,   13,   13,   13
  );

$yylen = array(
      1,    1,    3,    0,    1,    0,    2,    1,    0,    1,
      1,    2,    1,    2,    6,    2,    1,    4,    1,    1,
      1,    2,    2,    6,    1,    2,    3,    3,    3,    3,
      3,    3,    3,    3,    2,    1,    2,    2,    2,    0,
      1,    5,    6,    5,    8
  );

define('YYSTATES', 83);
define('YYNLSTATES', 44);
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
        case 21:
{ $yyval = cat($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 22:
{ $yyval = cat($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 23:
{ $yyval = gen('declaration', $yyastk[$yysp-(6-1)], $yyastk[$yysp-(6-4)]); } break;
        case 25:
{ $yyval = trim($yyastk[$yysp-(2-1)]) . ' ' . trim($yyastk[$yysp-(2-2)]); } break;
        case 26:
{ $yyval = $yyastk[$yysp-(3-1)] . $yyastk[$yysp-(3-2)]; } break;
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
        case 41:
{ $yyval = gen('command', $yyastk[$yysp-(5-3)]); } break;
        case 42:
{ $yyval = gen('command', $yyastk[$yysp-(6-3)], $yyastk[$yysp-(6-5)]); } break;
        case 43:
{ $yyval = ''; getvar($yyastk[$yysp-(5-3)]); } break;
        case 44:
{ $yyval = ''; setvar($yyastk[$yysp-(8-3)], $yyastk[$yysp-(8-6)]); } break;
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
    $basedir = dirname(__FILE__);
    $classfile = preg_replace('/_/', DIRECTORY_SEPARATOR, $class);
    $filename = $basedir. DIRECTORY_SEPARATOR . $classfile . '.class.php';
    if (file_exists($filename)) {
        require $filename;
    }
    if (!class_exists($class, false)) {
        throw new Exception("Could not load class: $class");
    }
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
