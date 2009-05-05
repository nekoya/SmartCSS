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
define('HASH', 262);

  
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
     16,   16,   13,   16,   16,   16,   16,   16,   16,   16,
     16,   16,   15,   11,    8,   16,   14,   16,   16,   16,
     16,   16,   16,   16,   16,   16,   16,   16,    9,   10,
     16,   16,   12,   16,   16,   16,   16,   16,   16,   16,
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
      5,    6,    7
  );

define('YYBADCH', 16);
define('YYMAXLEX', 263);
define('YYTERMS', 16);
define('YYNONTERMS', 17);

$yyaction = array(
     38,   47,   46,   48,   22,   15,    0,   13,   34,   25,
     26,   27,    2,   15,    8,   33,   39,  -27,-32766,    0,
      0,    4,    0,    0,   44
  );

define('YYLAST', 25);

$yycheck = array(
      7,    4,    5,    6,    3,    4,    0,   14,   15,   11,
     12,   13,    2,    4,    9,    4,    4,    9,   15,   -1,
     -1,    8,   -1,   -1,   10
  );

$yybase = array(
      0,    1,    9,   11,   11,   11,   13,   -2,   -3,    3,
      3,    3,    6,   12,   10,    8,    5,   14,    0,   -7,
     -7,   -7,   -7,   -7,   -2,    0,    0,   -7,   -7,   -7
  );

define('YY2TBLSTATE', 12);

$yydefault = array(
      2,32767,32767,    1,32767,32767,    5,    6,32767,   12,
     13,   14,32767,32767,32767,   15,32767,32767
  );



$yygoto = array(
     36,   36,   21,   40,   11,    0,    7,    0,   29
  );

define('YYGLAST', 9);

$yygcheck = array(
     11,   11,    3,   13,   10,   -1,    6,   -1,    8
  );

$yygbase = array(
      0,    0,    0,   -1,    0,    0,    2,    0,    3,    0,
     -5,  -10,    0,    1,    0,    0,    0
  );

$yygdefault = array(
  -32768,   12,    3,   43,   14,    1,    6,    5,   28,    9,
     10,   35,   37,   41,   42,   16,   17
  );

$yylhs = array(
      0,    1,    2,    2,    3,    4,    4,    7,    7,    7,
      6,    6,    8,    8,    8,    9,    9,   10,   10,   11,
     11,   12,    5,    5,   13,   13,   14,   15,   16,   16,
     16
  );

$yylen = array(
      1,    1,    0,    2,    4,    1,    3,    1,    1,    1,
      1,    3,    1,    1,    2,    1,    1,    1,    2,    1,
      1,    2,    1,    2,    1,    1,    4,    1,    1,    1,
      1
  );

define('YYSTATES', 40);
define('YYNLSTATES', 18);
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
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(3-1)], $yyastk[$yysp-(3-3)]); } break;
        case 10:
{ $yyval = Parser::getInstance()->genSelector($yyastk[$yysp-(1-1)]); } break;
        case 11:
{ $yyval = $yyastk[$yysp-(3-1)]; $yyastk[$yysp-(3-1)]->appendValue(chr($yyastk[$yysp-(3-2)]), $yyastk[$yysp-(3-3)]); } break;
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
        case 26:
{ $yyval = Parser::getInstance()->genDeclaration($yyastk[$yysp-(4-1)], $yyastk[$yysp-(4-3)]); } break;
        case 27:
{ $yyval = Parser::getInstance()->genProperty($yyastk[$yysp-(1-1)]); } break;
        case 28:
{ $yyval = Parser::getInstance()->genExpr($yyastk[$yysp-(1-1)]); } break;
        case 29:
{ $yyval = Parser::getInstance()->genExpr($yyastk[$yysp-(1-1)]); } break;
        case 30:
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
        if (!empty($parser->debug)) {
            var_dump($lexbuf);
        }

        $regexs = array(
            LBRACE => '/^(\s*{\s*)/',
            RBRACE => '/^(\s*}\s*)/',
            LENGTH => '/^((\d+)(em|ex|px|cm|mm|in|pt))/',
            NUMBER => '/^(\d+)/',
            IDENT  => '/^(-?[_a-z][_a-z0-9-]*)/',
            HASH   => '/^(#[_a-z0-9-]+)/'
        );
        foreach ($regexs as $token => $regex) {
            if (preg_match($regex, $lexbuf, $matches)) {
                $yylval = (string)$matches[1];
                $lexbuf = substr($lexbuf, strlen($yylval));
                return $token;
            }
        }
        $yylval = ord($lexbuf);
        $lexbuf = substr($lexbuf, 1);
        return $yylval;
    }
}

function yyerror($msg) {
    echo "[error]$msg\n";
}

function p($msg) {
    $parser = Parser::getInstance();
    if (!empty($parser->debug)) {
        echo $msg . "\n";
    }
}
