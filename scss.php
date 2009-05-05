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
define('IDENT', 263);
define('NUMBER', 264);
define('HASH', 265);
define('HEXCOLOR', 266);
define('EMS', 267);
define('EXS', 268);
define('LENGTH', 269);
define('ANGLE', 270);
define('TIME', 271);
define('FREQ', 272);

  
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
      0,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   18,   22,   21,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   19,   20,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,   22,   22,   22,   22,
     22,   22,   22,   22,   22,   22,    1,    2,    3,    4,
      5,    6,    7,    8,    9,   10,   11,   12,   13,   14,
     15,   16,   17
  );

define('YYBADCH', 22);
define('YYMAXLEX', 273);
define('YYTERMS', 22);
define('YYNONTERMS', 20);

$yyaction = array(
     59,   66,  -29,   67,   60,   61,   62,   63,   64,   65,
    -26,   35,   49,   -9,    0,   23,   18,   16,   17,  -29,
     45,   25,    3,   20,   45,   44,   69,  -26,    9,   31,
      0,   43,    0,  -42,    0,   -5,    0,   19
  );

define('YYLAST', 38);

$yycheck = array(
      8,    9,    3,   11,   12,   13,   14,   15,   16,   17,
      3,    3,   10,    2,    0,    4,   18,    5,    6,   20,
      7,    8,    2,   21,    7,    8,    4,   20,   20,    4,
     -1,    8,   -1,   18,   -1,   19,   -1,   19
  );

$yybase = array(
     17,   -8,   -8,   13,   13,   17,   17,   17,   11,    7,
     25,   -1,    2,    2,    2,    8,   22,   22,   22,   22,
     23,   14,   20,   15,   -2,   16,   18,    2,    0,    0,
      2,    2,    2,    2,    2,   12,   22,   12,   22
  );

define('YY2TBLSTATE', 12);

$yydefault = array(
  32767,32767,32767,32767,32767,    1,32767,32767,   41,   41,
     10,   41,   13,   14,   15,32767,   41,   41,   41,   41,
  32767,32767,32767,    4,32767,   17,32767
  );



$yygoto = array(
      4,   33,    2,   47,   47,   58,   34,   29,   30,    6,
      1,   52,   10,    0,   14,   39
  );

define('YYGLAST', 16);

$yygcheck = array(
      4,    6,    4,   14,   14,   19,    6,    4,    4,    4,
      4,   15,    9,   -1,   12,   10
  );

$yygbase = array(
      0,    0,    0,    0,   -9,    0,    1,    0,    0,    6,
      8,    0,    2,    0,  -10,    7,    0,    0,    0,    3
  );

$yygdefault = array(
  -32768,   21,    5,    7,   24,   26,   55,   22,   15,    8,
     38,   12,   13,   48,   46,   50,   51,   54,   11,   57
  );

$yylhs = array(
      0,    1,    3,    3,    3,    5,    2,    2,    6,    7,
      7,    9,    9,   10,   10,   10,   13,   11,   11,   12,
     12,   14,   14,    8,    8,   16,   16,   15,   15,   17,
     18,   18,   19,   19,   19,   19,   19,   19,   19,   19,
     19,    4,    4
  );

$yylen = array(
      1,    1,    2,    2,    1,    1,    1,    2,    4,    1,
      5,    1,    3,    1,    1,    2,    2,    1,    1,    1,
      2,    1,    1,    1,    2,    3,    1,    1,    1,    4,
      1,    3,    1,    1,    1,    1,    1,    1,    1,    1,
      1,    0,    1
  );

define('YYSTATES', 59);
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
        case 5:
{ $yyval = Parser::getInstance()->genProperty($yyastk[$yysp-(1-1)]); } break;
        case 6:
{ $yyval = Parser::getInstance()->setTopNode(); } break;
        case 7:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 8:
{ $yyval = Parser::getInstance()->genRuleset($yyastk[$yysp-(4-1)], $yyastk[$yysp-(4-3)]); } break;
        case 9:
{ $yyval = $yyastk[$yysp-(1-1)]; } break;
        case 10:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(5-1)], $yyastk[$yysp-(5-5)]); } break;
        case 11:
{ $yyval = Parser::getInstance()->genSelector($yyastk[$yysp-(1-1)]); } break;
        case 12:
{ $yyval = $yyastk[$yysp-(3-1)]; $yyastk[$yysp-(3-1)]->appendValue($yyastk[$yysp-(3-2)], $yyastk[$yysp-(3-3)]); } break;
        case 15:
{ $yyval = $yyastk[$yysp-(2-1)] . $yyastk[$yysp-(2-2)]; } break;
        case 16:
{ $yyval = chr($yyastk[$yysp-(2-1)]) . $yyastk[$yysp-(2-2)]; } break;
        case 20:
{ $yyval = $yyastk[$yysp-(2-1)] . $yyastk[$yysp-(2-2)]; } break;
        case 23:
{ $yyval = $yyastk[$yysp-(1-1)]; } break;
        case 24:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 25:
{ $yyval = $yyastk[$yysp-(3-3)]; } break;
        case 29:
{ $yyval = Parser::getInstance()->genDeclaration($yyastk[$yysp-(4-1)], $yyastk[$yysp-(4-4)]); } break;
        case 30:
{ $yyval = Parser::getInstance()->genExpr($yyastk[$yysp-(1-1)]); } break;
        case 31:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(3-1)], $yyastk[$yysp-(3-3)]); } break;
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
    yyparse();
    $parser = Parser::getInstance();
    echo "----\n";
    echo $parser->run();
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

function __autoload($class) {
    $class = preg_replace('/_/', DIRECTORY_SEPARATOR, $class);
    require "libs/$class.class.php";
}

function yylex() {
    global $lexbuf, $yylval;
    $parser = Parser::getInstance();

    while ($lexbuf) {
        if (!empty($parser->debug)) {
//            var_dump($lexbuf);
        }

        $regexs = array(
            'LBRACE'   => '/^(\s*{\s*)/',
            'RBRACE'   => '/^(\s*}\s*)/',

            'EMS'      => '/^((\d+)em)/',
            'EXS'      => '/^((\d+)ex)/',
            'LENGTH'   => '/^((\d+)(px|cm|mm|in|pt|pc))/',
            'ANGLE'    => '/^((\d+)(deg|rad|grad))/',
            'TIME'     => '/^((\d+)(ms|s))/',
            'FREQ'     => '/^((\d+)(hz|khz))/',

            'HEXCOLOR' => '/^(#([0-9a-f]{6}|[0-9a-f]{3}))/',
            'IDENT'    => '/^(-?[_a-z][_a-z0-9-]*)/',
            'HASH'     => '/^(#[_a-z0-9-]+)/',
            'NUMBER'   => '/^(\d+)/',
            'SPACE'    => '/^(\s+)/',
            'PLUS'     => '/^(\+)/',
            'GREATER'  => '/^(\>)/',
            'ASTERISK' => '/^(\*)/',
        );
        foreach ($regexs as $token => $regex) {
            if (preg_match($regex, $lexbuf, $matches)) {
                $yylval = (string)$matches[1];
                $lexbuf = substr($lexbuf, strlen($yylval));
                p($token . ' ' . $yylval);
                return constant($token);
            }
        }
        $yylval = ord($lexbuf);
        $lexbuf = substr($lexbuf, 1);
        return $yylval;
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
