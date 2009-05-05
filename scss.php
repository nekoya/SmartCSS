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
define('YYNONTERMS', 19);

$yyaction = array(
     55,   62,   33,   63,   56,   57,   58,   59,   60,   61,
    -26,   47,   -9,   65,   21,    0,   14,   15,   29,    8,
     43,   42,   19,   43,   23,    2,   41,  -26,    0,    0,
    -40,    0,    0,    0,    0,   16,    0,    0,   17,   -5
  );

define('YYLAST', 40);

$yycheck = array(
      8,    9,    3,   11,   12,   13,   14,   15,   16,   17,
      3,   10,    2,    4,    4,    0,    5,    6,    4,   20,
      7,    8,   21,    7,    8,    2,    8,   20,   -1,   -1,
     18,   -1,   -1,   -1,   -1,   18,   -1,   -1,   19,   19
  );

$yybase = array(
      0,   -8,   16,   16,   13,   13,   13,   10,    7,   14,
      1,    1,    1,   -1,    9,    9,    9,    9,   15,   18,
     23,   12,   17,   20,   19,    0,    0,    1,    1,    1,
      1,    1,   11,    9,   11
  );

define('YY2TBLSTATE', 10);

$yydefault = array(
      6,32767,32767,32767,    1,32767,32767,   39,   39,   10,
     13,   14,   15,32767,   39,   39,   39,   39,32767,32767,
  32767,    4,32767,   17,32767
  );



$yygoto = array(
      3,   45,   45,   32,   50,   12,   27,   28,    5,    1,
      9,    0,   37
  );

define('YYGLAST', 13);

$yygcheck = array(
      4,   14,   14,    6,   15,   12,    4,    4,    4,    4,
      9,   -1,   10
  );

$yygbase = array(
      0,    0,    0,    0,   -8,    0,   -1,    0,    0,    5,
      6,    0,   -5,    0,  -10,    1,    0,    0,    0
  );

$yygdefault = array(
  -32768,   18,    4,    6,   22,   24,   53,   20,   13,    7,
     36,   10,   11,   46,   44,   48,   49,   52,   54
  );

$yylhs = array(
      0,    1,    3,    3,    3,    5,    2,    2,    6,    7,
      7,    9,    9,   10,   10,   10,   13,   11,   11,   12,
     12,   14,   14,    8,    8,   16,   16,   15,   15,   17,
     18,   18,   18,   18,   18,   18,   18,   18,   18,    4,
      4
  );

$yylen = array(
      1,    1,    2,    2,    1,    1,    0,    2,    4,    1,
      5,    1,    3,    1,    1,    2,    2,    1,    1,    1,
      2,    1,    1,    1,    2,    3,    1,    1,    1,    4,
      1,    1,    1,    1,    1,    1,    1,    1,    1,    0,
      1
  );

define('YYSTATES', 55);
define('YYNLSTATES', 25);
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
{ $yyval = Parser::getInstance()->genExpr($yyastk[$yysp-(1-1)]); } break;
        case 32:
{ $yyval = Parser::getInstance()->genExpr($yyastk[$yysp-(1-1)]); } break;
        case 33:
{ $yyval = Parser::getInstance()->genExpr($yyastk[$yysp-(1-1)]); } break;
        case 34:
{ $yyval = Parser::getInstance()->genExpr($yyastk[$yysp-(1-1)]); } break;
        case 35:
{ $yyval = Parser::getInstance()->genExpr($yyastk[$yysp-(1-1)]); } break;
        case 36:
{ $yyval = Parser::getInstance()->genExpr($yyastk[$yysp-(1-1)]); } break;
        case 37:
{ $yyval = Parser::getInstance()->genExpr($yyastk[$yysp-(1-1)]); } break;
        case 38:
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
