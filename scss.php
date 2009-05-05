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

$yydebug = true;

$yyterminals = array(
    "EOF",
    "error",
    "LBRACE",
    "RBRACE",
    "SPACE",
    "PLUS",
    "GREATER",
    "ASTERISK",
    "IDENT",
    "NUMBER",
    "HASH",
    "HEXCOLOR",
    "EMS",
    "EXS",
    "LENGTH",
    "ANGLE",
    "TIME",
    "FREQ",
    "','",
    "':'",
    "';'",
    "'.'"
    , "???"
    );


function yytokname($n)
{
  switch ($n) {
    case 0: return "EOF";
    case 256: return "error";
    case 257: return "LBRACE";
    case 258: return "RBRACE";
    case 259: return "SPACE";
    case 260: return "PLUS";
    case 261: return "GREATER";
    case 262: return "ASTERISK";
    case 263: return "IDENT";
    case 264: return "NUMBER";
    case 265: return "HASH";
    case 266: return "HEXCOLOR";
    case 267: return "EMS";
    case 268: return "EXS";
    case 269: return "LENGTH";
    case 270: return "ANGLE";
    case 271: return "TIME";
    case 272: return "FREQ";
    case 44: return "','";
    case 58: return "':'";
    case 59: return "';'";
    case 46: return "'.'";
  default:
    return "???";
  }
}

$yyproduction = array(
  "start : stylesheet",
  "stylesheet : rulesets",
  "rulesets : /* empty */",
  "rulesets : rulesets ruleset",
  "ruleset : selectors LBRACE declarations RBRACE",
  "selectors : selector",
  "selectors : selector s ',' s selector",
  "combinator : PLUS s",
  "combinator : GREATER s",
  "combinator : SPACE",
  "selector : simple_selector",
  "selector : selector combinator simple_selector",
  "simple_selector : element_name",
  "simple_selector : attributes",
  "simple_selector : element_name attributes",
  "element_name : IDENT",
  "element_name : ASTERISK",
  "attributes : attr",
  "attributes : attributes attr",
  "attr : class",
  "attr : HASH",
  "class : '.' IDENT",
  "declarations : decl",
  "declarations : declarations follow_decl",
  "follow_decl : ';' s decl",
  "follow_decl : ';'",
  "decl : declaration",
  "decl : ruleset",
  "declaration : property ':' expr",
  "property : IDENT",
  "expr : IDENT",
  "expr : EMS",
  "expr : EXS",
  "expr : LENGTH",
  "expr : ANGLE",
  "expr : TIME",
  "expr : FREQ",
  "expr : NUMBER",
  "expr : HEXCOLOR",
  "s : /* empty */",
  "s : SPACE"
);


/* Traditional Debug Mode */
function YYTRACE_NEWSTATE($state, $sym)
{
  global $yydebug, $yyterminals;
  if ($yydebug)
    yyprintln("% State " . $state . ", Lookahead "
                       . ($sym < 0 ? "--none--" : $yyterminals[$sym]));
}

function YYTRACE_READ($sym)
{
  global $yydebug, $yyterminals;
  if ($yydebug)
    yyprintln("% Reading " . $yyterminals[$sym]);
}

function YYTRACE_SHIFT($sym)
{
  global $yydebug, $yyterminals;
  if ($yydebug)
    yyprintln("% Shift " . $yyterminals[$sym]);
}

function YYTRACE_ACCEPT()
{
  global $yydebug;
  if ($yydebug) yyprintln("% Accepted.");
}

function YYTRACE_REDUCE($n)
{
  global $yydebug, $yyproduction;
  if ($yydebug)
    yyprintln("% Reduce by (" . $n . ") " . $yyproduction[$n]);
}

function YYTRACE_POP($state)
{
  global $yydebug;
  if ($yydebug)
    yyprintln("% Recovering, uncovers state " . $state);
}

function YYTRACE_DISCARD($sym)
{
  global $yydebug, $yyterminals;
  if ($yydebug)
    yyprintln("% Discard " . $yyterminals[$sym]);
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
     54,   61,   28,   62,   55,   56,   57,   58,   59,   60,
    -25,   44,   -5,   64,   20,    0,   14,   15,   33,    8,
     40,   39,   18,   40,   22,    2,   45,  -25,    0,    0,
    -40,    0,    0,    0,    0,   16,    0,    0,    1,  -29
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
      1,    1,    1,   -1,    9,    9,    9,   15,   18,   23,
     12,   17,   20,   19,    0,    0,    1,    1,    1,    1,
      1,   11,    9,   11
  );

define('YY2TBLSTATE', 10);

$yydefault = array(
      2,32767,32767,32767,    1,32767,32767,   39,   39,    6,
     12,   13,   14,32767,   39,   39,   39,32767,32767,32767,
      9,32767,   15,32767
  );



$yygoto = array(
      3,   42,   42,   27,   48,   12,   31,   32,    5,    9,
      0,   35
  );

define('YYGLAST', 12);

$yygcheck = array(
      7,   12,   12,    3,   14,   11,    7,    7,    7,    6,
     -1,    9
  );

$yygbase = array(
      0,    0,    0,   -1,    0,    0,    4,   -8,    0,    5,
      0,   -5,  -10,    0,    1,    0,    0,    0,    0
  );

$yygdefault = array(
  -32768,   17,    4,   51,   19,   13,    7,   21,    6,   34,
     10,   11,   41,   43,   46,   47,   50,   23,   52
  );

$yylhs = array(
      0,    1,    2,    2,    3,    4,    4,    8,    8,    8,
      6,    6,    9,    9,    9,   10,   10,   11,   11,   12,
     12,   13,    5,    5,   15,   15,   14,   14,   16,   17,
     18,   18,   18,   18,   18,   18,   18,   18,   18,    7,
      7
  );

$yylen = array(
      1,    1,    0,    2,    4,    1,    5,    2,    2,    1,
      1,    3,    1,    1,    2,    1,    1,    1,    2,    1,
      1,    2,    1,    2,    3,    1,    1,    1,    3,    1,
      1,    1,    1,    1,    1,    1,    1,    1,    1,    0,
      1
  );

define('YYSTATES', 54);
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
    YYTRACE_NEWSTATE($yystate, $yychar);
    if ($yybase[$yystate] == 0)
      $yyn = $yydefault[$yystate];
    else {
      if ($yychar < 0) {
        if (($yychar = yylex()) <= 0) $yychar = 0;
        $yychar = $yychar < YYMAXLEX ? $yytranslate[$yychar] : YYBADCH;
        YYTRACE_READ($yychar);
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
          YYTRACE_SHIFT($yychar);
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
        YYTRACE_ACCEPT();
        yyflush();
        return 0;
      }
      else if ($yyn != YYUNEXPECTED) {
        /* reduce */
        $yyl = $yylen[$yyn];
        $n = $yysp-$yyl+1;
        $yyval = isset($yyastk[$n]) ? $yyastk[$n] : null;
        YYTRACE_REDUCE($yyn);
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
            YYTRACE_POP($yystate);
          }
          $yyn = $yyaction[$yyn];
          YYTRACE_SHIFT(YYINTERRTOK);
          $yysstk[++$yysp] = $yystate = $yyn;
          break;

        case 3:
          YYTRACE_DISCARD($yychar);
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
