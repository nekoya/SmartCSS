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
define('IDENT', 259);
define('NUMBER', 260);
define('LENGTH', 261);
define('S', 262);

  
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
      0,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,    7,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,    8,    9,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,   10,   10,   10,   10,
     10,   10,   10,   10,   10,   10,    1,    2,    3,    4,
      5,    6,   10
  );

define('YYBADCH', 10);
define('YYMAXLEX', 263);
define('YYTERMS', 10);
define('YYNONTERMS', 11);

$yyaction = array(
     26,   25,   27,    4,    0,   15,    1,   18,    6,    8,
      0,    0,    0,    0,  -13,    0,   23
  );

define('YYLAST', 17);

$yycheck = array(
      4,    5,    6,    2,    0,    3,    8,    4,    7,    4,
     -1,   -1,   -1,   -1,    8,   -1,    9
  );

$yybase = array(
      0,   -4,    2,    1,    5,    3,    3,    4,    6,   -2,
      7,    0,    0,    5
  );

define('YY2TBLSTATE', 3);

$yydefault = array(
      2,32767,32767,32767,32767,    1,32767,32767,    7,32767,
  32767
  );



$yygoto = array(
     19,   17,   14
  );

define('YYGLAST', 3);

$yygcheck = array(
      7,    6,    3
  );

$yygbase = array(
      0,    0,    0,   -3,    0,    0,   -5,   -4,    0,    0,
      0
  );

$yygdefault = array(
  -32768,    7,    5,   22,    3,    2,   16,   20,   21,    9,
     10
  );

$yylhs = array(
      0,    1,    2,    2,    3,    4,    4,    6,    5,    5,
      7,    7,    8,    9,   10,   10,   10
  );

$yylen = array(
      1,    1,    0,    2,    4,    1,    3,    1,    1,    2,
      1,    1,    4,    1,    1,    1,    1
  );

define('YYSTATES', 24);
define('YYNLSTATES', 11);
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
{ $yyval = Parser::getInstance()->addRuleset($yyastk[$yysp-(4-1)], $yyastk[$yysp-(4-3)]); } break;
        case 5:
{ $yyval = $yyastk[$yysp-(1-1)]; } break;
        case 6:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(3-1)], $yyastk[$yysp-(3-3)]); } break;
        case 7:
{ $yyval = Parser::getInstance()->addSelector($yyastk[$yysp-(1-1)]); } break;
        case 8:
{ $yyval = $yyastk[$yysp-(1-1)]; } break;
        case 9:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 12:
{ $yyval = Parser::getInstance()->addDeclaration($yyastk[$yysp-(4-1)], $yyastk[$yysp-(4-3)]); } break;
        case 13:
{ $yyval = Parser::getInstance()->addProperty($yyastk[$yysp-(1-1)]); } break;
        case 14:
{ $yyval = Parser::getInstance()->addExpr($yyastk[$yysp-(1-1)]); } break;
        case 15:
{ $yyval = Parser::getInstance()->addExpr($yyastk[$yysp-(1-1)]); } break;
        case 16:
{ $yyval = Parser::getInstance()->addExpr($yyastk[$yysp-(1-1)]); } break;
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


//$GLOBALS['debug'] = 1;
$lexbuf = file_get_contents('test.css');
$lexbuf = preg_replace('/^\s*(.*?)\s*$/m', '$1', $lexbuf);
$lexbuf = preg_replace('/[\r\n]/', '', $lexbuf);
yyparse();
$parser = Parser::getInstance();
echo "----\n";
echo $parser->run();

function __autoload($class) {
    $class = preg_replace('/_/', DIRECTORY_SEPARATOR, $class);
    require "libs/$class.class.php";
}

function yylex() {
    global $lexbuf, $yylval;
    $parser = Parser::getInstance();

    while ($lexbuf) {
        if (!empty($GLOBALS['debug'])) {
            var_dump($lexbuf);
        }

        if (strpos($lexbuf, '{') === 0) {
            $lexbuf = substr($lexbuf, 1);
            //p('LBRACE');
            return LBRACE;
        } else if (strpos($lexbuf, '}') === 0) {
            $lexbuf = substr($lexbuf, 1);
            //p('RBRACE');
            return RBRACE;
        } else if (preg_match('/^(\d+)(em|ex|px|cm|mm|in|pt)/', $lexbuf, $matches)) {
            $yylval = $matches[1] . $matches[2];
            $lexbuf = substr($lexbuf, strlen($yylval));
            p("LENGTH:[$yylval]");
            return LENGTH;
        } else if (preg_match('/^(\d+)/', $lexbuf, $matches)) {
            $yylval = (string)$matches[1];
            $lexbuf = substr($lexbuf, strlen($yylval));
            p("NUMBER:[$yylval]");
            return NUMBER;
        } else if (preg_match('/^(-?[_a-z][_a-z0-9-]*)/', $lexbuf, $matches)) {
            $yylval = $matches[1];
            $lexbuf = substr($lexbuf, strlen($yylval));
            p("IDENT:[$yylval]");
            return IDENT;
        } else {
            $ret = ord($lexbuf);
            $lexbuf = substr($lexbuf, 1);
            if ($ret === 32) {
                //p('skip space');
                continue;
            }
            p("UNKNOWN:[$ret]");
            return $ret;
        }
    }
}

function yyerror($msg) {
    echo "[error]$msg\n";
}

function p($msg) {
    if (!empty($GLOBALS['debug'])) {
        echo $msg . "\n";
    }
}
