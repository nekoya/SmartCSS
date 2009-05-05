<?php

//<?php
$parser = Parser::getInstance();
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
define('PLUS', 260);
define('GREATER', 261);
define('ASTERISK', 262);
define('IDENT', 263);
define('NUMBER', 264);
define('LENGTH', 265);
define('HASH', 266);
define('HEXCOLOR', 267);

  
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
      0,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   13,   17,   16,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   14,   15,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   17,   17,
     17,   17,   17,   17,   17,   17,    1,    2,    3,    4,
      5,    6,    7,    8,    9,   10,   11,   12
  );

define('YYBADCH', 17);
define('YYMAXLEX', 268);
define('YYTERMS', 17);
define('YYNONTERMS', 19);

$yyaction = array(
     55,   54,   56,    1,   57,   28,  -25,   44,   -5,    0,
     20,   59,   18,   14,   15,   33,    0,    8,  -25,   40,
     39,   40,   22,   45,    7,    0,  -35,    0,    0,   16,
      0,  -29
  );

define('YYLAST', 32);

$yycheck = array(
      8,    9,   10,    2,   12,    3,    3,   11,    2,    0,
      4,    4,   16,    5,    6,    4,   -1,   15,   15,    7,
      8,    7,    8,    8,   14,   -1,   13,   -1,   -1,   13,
     -1,   14
  );

$yybase = array(
      0,   14,   14,   12,   12,   12,    6,   -8,    3,   11,
     -4,   -4,   -4,    2,    7,    7,    7,    9,   15,    1,
     13,   16,   17,   10,    0,   -4,   -4,   -4,   -4,   -4,
      8,    0,    7,    8
  );

define('YY2TBLSTATE', 10);

$yydefault = array(
      2,32767,32767,    1,32767,32767,   34,32767,   34,    6,
     12,   13,   14,32767,   34,   34,   34,32767,32767,32767,
      9,32767,   15,32767
  );



$yygoto = array(
      2,   42,   42,   48,   35,   27,   31,   32,    4,    9,
      0,    0,    0,   12
  );

define('YYGLAST', 14);

$yygcheck = array(
      7,   12,   12,   14,    9,    3,    7,    7,    7,    6,
     -1,   -1,   -1,   11
  );

$yygbase = array(
      0,    0,    0,    2,    0,    0,    5,   -8,    0,   -1,
      0,    3,  -10,    0,    1,    0,    0,    0,    0
  );

$yygdefault = array(
  -32768,   17,    3,   51,   19,   13,    6,   21,    5,   34,
     10,   11,   41,   43,   46,   47,   50,   23,   52
  );

$yylhs = array(
      0,    1,    2,    2,    3,    4,    4,    8,    8,    8,
      6,    6,    9,    9,    9,   10,   10,   11,   11,   12,
     12,   13,    5,    5,   15,   15,   14,   14,   16,   17,
     18,   18,   18,   18,    7,    7
  );

$yylen = array(
      1,    1,    0,    2,    4,    1,    5,    2,    2,    1,
      1,    3,    1,    1,    2,    1,    1,    1,    2,    1,
      1,    2,    1,    2,    3,    1,    1,    1,    3,    1,
      1,    1,    1,    1,    0,    1
  );

define('YYSTATES', 49);
define('YYNLSTATES', 24);
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
        case 2:
{ $yyval = Parser::getInstance()->setTopNode(); } break;
        case 3:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 4:
{ $yyval = Parser::getInstance()->genRuleset($yyastk[$yysp-(4-1)], $yyastk[$yysp-(4-3)]); } break;
        case 5:
{ $yyval = $yyastk[$yysp-(1-1)]; } break;
        case 6:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(5-1)], $yyastk[$yysp-(5-5)]); } break;
        case 10:
{ $yyval = Parser::getInstance()->genSelector($yyastk[$yysp-(1-1)]); } break;
        case 11:
{ $yyval = $yyastk[$yysp-(3-1)]; $yyastk[$yysp-(3-1)]->appendValue($yyastk[$yysp-(3-2)], $yyastk[$yysp-(3-3)]); } break;
        case 14:
{ $yyval = $yyastk[$yysp-(2-1)] . $yyastk[$yysp-(2-2)]; } break;
        case 18:
{ $yyval = $yyastk[$yysp-(2-1)] . $yyastk[$yysp-(2-2)]; } break;
        case 21:
{ $yyval = chr($yyastk[$yysp-(2-1)]) . $yyastk[$yysp-(2-2)]; } break;
        case 22:
{ $yyval = $yyastk[$yysp-(1-1)]; } break;
        case 23:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 24:
{ $yyval = $yyastk[$yysp-(3-3)]; } break;
        case 28:
{ $yyval = Parser::getInstance()->genDeclaration($yyastk[$yysp-(3-1)], $yyastk[$yysp-(3-3)]); } break;
        case 29:
{ $yyval = Parser::getInstance()->genProperty($yyastk[$yysp-(1-1)]); } break;
        case 30:
{ $yyval = Parser::getInstance()->genExpr($yyastk[$yysp-(1-1)]); } break;
        case 31:
{ $yyval = Parser::getInstance()->genExpr($yyastk[$yysp-(1-1)]); } break;
        case 32:
{ $yyval = Parser::getInstance()->genExpr($yyastk[$yysp-(1-1)]); } break;
        case 33:
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
            'LENGTH'   => '/^((\d+)(em|ex|px|cm|mm|in|pt))/',
            'NUMBER'   => '/^(\d+)/',
            'HEXCOLOR' => '/^(#([0-9a-f]{6}|[0-9a-f]{3}))/',
            'IDENT'    => '/^(-?[_a-z][_a-z0-9-]*)/',
            'HASH'     => '/^(#[_a-z0-9-]+)/',
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
