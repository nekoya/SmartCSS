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
define('IDENT', 260);
define('NUMBER', 261);
define('LENGTH', 262);
define('HASH', 263);
define('HEXCOLOR', 264);

  
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
     17,   17,   16,   13,   10,   17,   15,   17,   17,   17,
     17,   17,   17,   17,   17,   17,   17,   17,   11,   12,
     17,   17,   14,   17,   17,   17,   17,   17,   17,   17,
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
      5,    6,    7,    8,    9
  );

define('YYBADCH', 17);
define('YYMAXLEX', 265);
define('YYTERMS', 17);
define('YYNONTERMS', 19);

$yyaction = array(
     50,   49,   51,   28,   52,  -25,   54,    0,   17,   34,
     40,    1,   26,   27,  -25,   23,   39,    7,    0,   35,
     35,    4,    0,   15,    9,  -29
  );

define('YYLAST', 26);

$yycheck = array(
      5,    6,    7,    4,    9,    3,    4,    0,    5,    5,
      5,    2,   13,   14,   12,    3,    8,   11,   -1,   16,
     16,   10,   -1,   15,   12,   11
  );

$yybase = array(
      0,    3,    3,    4,    4,    4,   11,   -5,   -1,    2,
      8,    8,    8,   12,    7,    5,    9,   14,    6,    0,
      8,    8,    8,    8,    8,   -1
  );

define('YY2TBLSTATE', 7);

$yydefault = array(
      2,32767,32767,    1,32767,32767,    5,32767,    6,   34,
     12,   13,   14,32767,32767,32767,32767,   15,32767
  );



$yygoto = array(
     37,   37,   22,   43,   12,    0,    8,    0,   30
  );

define('YYGLAST', 9);

$yygcheck = array(
     11,   11,    3,   13,   10,   -1,    6,   -1,    8
  );

$yygbase = array(
      0,    0,    0,   -1,    0,    0,    2,    0,    3,    0,
     -6,  -11,    0,    1,    0,    0,    0,    0,    0
  );

$yygdefault = array(
  -32768,   14,    3,   46,   16,   13,    6,    5,   29,   10,
     11,   36,   38,   41,   42,    2,   45,   18,   47
  );

$yylhs = array(
      0,    1,    2,    2,    3,    4,    4,    7,    7,    7,
      6,    6,    8,    8,    8,    9,    9,   10,   10,   11,
     11,   12,    5,    5,   14,   14,   13,   13,   16,   17,
     18,   18,   18,   18,   15,   15
  );

$yylen = array(
      1,    1,    0,    2,    4,    1,    3,    1,    1,    1,
      1,    3,    1,    1,    2,    1,    1,    1,    2,    1,
      1,    2,    1,    2,    3,    1,    1,    1,    3,    1,
      1,    1,    1,    1,    0,    1
  );

define('YYSTATES', 44);
define('YYNLSTATES', 19);
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
        case 16:
{ $yyval = '*'; } break;
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
