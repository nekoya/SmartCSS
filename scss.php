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
define('STRING', 263);
define('IDENT', 264);
define('NUMBER', 265);
define('HASH', 266);
define('HEXCOLOR', 267);
define('PERCENTAGE', 268);
define('URI', 269);
define('EMS', 270);
define('EXS', 271);
define('LENGTH', 272);
define('ANGLE', 273);
define('TIME', 274);
define('FREQ', 275);
define('IMPORTANT_SYM', 276);
define('EXPRESSION', 277);

  
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
      0,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   11,   15,   14,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   12,   13,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   15,   15,   15,
     15,   15,   15,   15,   15,   15,    1,    2,    3,    4,
      5,    6,    7,   15,    8,   15,    9,   15,   15,   15,
     15,   15,   15,   15,   15,   15,   15,   10
  );

define('YYBADCH', 15);
define('YYMAXLEX', 278);
define('YYTERMS', 15);
define('YYNONTERMS', 19);

$yyaction = array(
     33,  -26,   47,   -9,    0,   21,   57,   19,   13,   14,
      7,  -26,   43,   42,   43,   23,    1,   29,   41,   55,
     16,    0,  -32,   15,    0,    0,    0,   -5
  );

define('YYLAST', 28);

$yycheck = array(
      3,    3,    9,    2,    0,    4,    4,   14,    5,    6,
     13,   13,    7,    8,    7,    8,    2,    4,    8,   10,
     12,   -1,   11,   11,   -1,   -1,   -1,   12
  );

$yybase = array(
      0,    7,    7,    5,    5,    5,    1,   -2,   13,   -7,
     -7,   -7,   -3,    2,    2,    2,    2,    9,    4,   10,
     14,   11,   12,   15,    8,    0,   -7,   -7,   -7,   -7,
     -7,    3,    2,    3
  );

define('YY2TBLSTATE', 9);

$yydefault = array(
      6,32767,32767,    1,32767,32767,   31,   31,   10,   13,
     14,   15,32767,   31,   31,   31,   31,32767,32767,32767,
  32767,    4,32767,   17,32767
  );



$yygoto = array(
      2,   45,   45,   50,   37,   32,   27,   28,    4,   17,
      8,    0,   11
  );

define('YYGLAST', 13);

$yygcheck = array(
      4,   14,   14,   15,   10,    6,    4,    4,    4,    4,
      9,   -1,   12
  );

$yygbase = array(
      0,    0,    0,    0,   -7,    0,    2,    0,    0,    6,
     -1,    0,    3,    0,   -9,    1,    0,    0,    0
  );

$yygdefault = array(
  -32768,   18,    3,    5,   22,   24,   53,   20,   12,    6,
     36,    9,   10,   46,   44,   48,   49,   52,   54
  );

$yylhs = array(
      0,    1,    3,    3,    3,    5,    2,    2,    6,    7,
      7,    9,    9,   10,   10,   10,   13,   11,   11,   12,
     12,   14,   14,    8,    8,   16,   16,   15,   15,   17,
     18,    4,    4
  );

$yylen = array(
      1,    1,    2,    2,    1,    1,    0,    2,    4,    1,
      5,    1,    3,    1,    1,    2,    2,    1,    1,    1,
      2,    1,    1,    1,    2,    3,    1,    1,    1,    4,
      1,    0,    1
  );

define('YYSTATES', 47);
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
        case 2:
{ $yyval = '+'; } break;
        case 3:
{ $yyval = '>'; } break;
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
    defineRegexs();
    yyparse();
    $parser = Parser::getInstance();
    echo $parser->run();
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

function __autoload($class) {
    $class = preg_replace('/_/', DIRECTORY_SEPARATOR, $class);
    require "libs/$class.class.php";
}

function yylex() {
    global $lexbuf, $yylval, $regexs;
    $parser = Parser::getInstance();

    while ($lexbuf) {
        if (!empty($parser->debug)) {
            //var_dump($lexbuf);
        }

        foreach ($regexs as $token => $regex) {
            $regex = '/^('.$regex.')/i';
            if (preg_match($regex, $lexbuf, $matches)) {
                //var_dump($matches);
                $yylval = (string)$matches[1];
                $lexbuf = substr($lexbuf, strlen($yylval));
                p($token . ' ' . $yylval);
                if ($token === 'COMMENT') {
                    /* ignore comment */
                    break;
                }
                return constant($token);
            }
        }
        if ($token !== 'COMMENT') {
            $yylval = ord($lexbuf);
            $lexbuf = substr($lexbuf, 1);
            return $yylval;
        }
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

function defineRegexs() {
    global $regexs;
    $regexs = array(
        'LBRACE'        => '\s*{\s*',
        'RBRACE'        => '\s*}\s*',

        'EXPRESSION'    =>
        '?:('.
            '(?:'.
                '(?:'.
                    '{{unary_operator}}{{PERCENTAGE}}|'.
                    '{{unary_operator}}{{LENGTH}}|'.
                    '{{unary_operator}}{{EMS}}|'.
                    '{{unary_operator}}{{EXS}}|'.
                    '{{unary_operator}}{{ANGLE}}|'.
                    '{{unary_operator}}{{TIME}}|'.
                    '{{unary_operator}}{{FREQ}}|'.
                    '{{unary_operator}}{{NUMBER}}|'.
                    '{{URI}}|'.
                    '{{HEXCOLOR}}|'.
                    '{{IDENT}}|'.
                    '{{STRING}}'.
                ')'.
            '\s*)+'.
            '({{IMPORTANT_SYM}})?'.
        ')[;}]',

        'COMMENT'       => '\s*\/\*.*?\*\/\s*',
        'STRING'        => '{{string}}',
        'URI'           => 'url\(\s*{{string}}\s*\)',
        'IMPORTANT_SYM' => '!important\s*',

        'EMS'           => '{{num}}em',
        'EXS'           => '{{num}}ex',
        'LENGTH'        => '{{num}}(px|cm|mm|in|pt|pc)',
        'ANGLE'         => '{{num}}(deg|rad|grad)',
        'TIME'          => '{{num}}(ms|s)',
        'FREQ'          => '{{num}}(hz|khz)',

        'HEXCOLOR'      => '#(?:{{h}}{6}|{{h}}{3})',
        'IDENT'         => '{{ident}}',
        'HASH'          => '#{{name}}+',
        'PERCENTAGE'    => '{{num}}+%',
        'NUMBER'        => '{{num}}',
        'PLUS'          => '\s*\+',
        'GREATER'       => '\s*\>',
        'ASTERISK'      => '\*',
        'SPACE'         => '\s+',
    );
    $rules = array(
        'h'       => '[0-9a-f]',
        'ident'   => '-?{{nmstart}}{{nmchar}}*',
        'nmstart' => '[_a-z]',
        'nmchar'  => '[_a-z0-9-]',
        'name'    => '{{nmchar}}+',
        'num'     => '\d*\.{0,1}\d+',
        'string'  => '(?:".*?"|\'.*?\')',
        'unary_operator' => '(?:\+|\-)?',
    );
    foreach ($rules as $token => &$regex) {
        while (preg_match('/({{(.+?)}})/', $regex, $matches)) {
            $regex = preg_replace("/$matches[1]/", $rules[$matches[2]], $regex);
        }
    }
    foreach ($regexs as $token => &$regex) {
        while (preg_match('/({{(.+?)}})/', $regex, $matches)) {
            $key = $matches[2];
            if (array_key_exists($key, $rules)) {
                $replace = $rules;
            } else if (array_key_exists($key, $regexs)) {
                $replace = $regexs;
            } else {
                throw new Exception("$key is not defined in lexer.");
            }
            $regex = preg_replace("/$matches[1]/", $replace[$key], $regex);
        }
    }
}
