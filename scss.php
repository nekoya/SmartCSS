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
define('CHARSET_SYM', 277);
define('IMPORT_SYM', 278);
define('EXPRESSION', 279);

  
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
      0,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   15,   19,   18,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   16,   17,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
     19,   19,   19,   19,   19,   19,    1,    2,    3,    4,
      5,    6,    7,    8,    9,   19,   10,   19,   19,   11,
     19,   19,   19,   19,   19,   19,   19,   12,   13,   14
  );

define('YYBADCH', 19);
define('YYMAXLEX', 280);
define('YYTERMS', 19);
define('YYNONTERMS', 23);

$yyaction = array(
     60,   50,  -33,   64,   59,  -16,    0,   28,   15,   18,
     25,   26,   19,   16,   17,    8,  -33,    2,   74,-32766,
     46,   23,   58,   21,   72,    0,   30,   59,   39,    0,
      0,    0,    0,    0,  -39,   20,    0,  -12,    0,   43,
     42
  );

define('YYLAST', 41);

$yycheck = array(
      7,    3,    3,   10,    9,    2,    0,    4,   13,    8,
      8,   18,   11,    5,    6,   17,   17,    2,    4,    7,
      4,   12,    9,   16,   14,   -1,    9,    9,   17,   -1,
     -1,   -1,   -1,   -1,   15,   15,   -1,   16,   -1,   17,
     17
  );

$yybase = array(
      9,   -5,   17,   17,   18,   18,   18,    3,   -1,   16,
     12,   12,   12,   -2,    1,   14,   14,   14,   14,   14,
     14,   14,   10,    2,    6,   11,   13,   15,   19,   20,
     21,    7,   23,   22,    0,    0,   -7,   -7,   -7,   -7,
     -7,   -7,    8,   14,    8,   -7,   -7,   -7
  );

define('YY2TBLSTATE', 13);

$yydefault = array(
      3,32767,32767,32767,    2,32767,32767,   38,   38,   17,
     20,   21,   22,32767,32767,   38,   38,   38,   38,   38,
     38,   38,32767,32767,32767,32767,32767,32767,   11,32767,
     24,32767,32767,32767,    5
  );



$yygoto = array(
      3,   67,   48,   54,    9,   49,   12,   14,   44,   45,
     32,   33,    5,   22,   62,   62
  );

define('YYGLAST', 16);

$yygcheck = array(
      7,   19,   10,   14,   13,   10,   16,    7,    7,    7,
      7,    7,    7,    7,   18,   18
  );

$yygbase = array(
      0,    0,    0,    0,    0,    0,    0,   -8,    0,    0,
      1,    0,    0,   -1,   -3,    0,   -4,    0,    3,   -2,
      0,    0,    0
  );

$yygdefault = array(
  -32768,   24,   36,   34,    1,    4,   41,   29,    6,   31,
     70,   27,   13,    7,   53,   10,   11,   63,   61,   65,
     66,   69,   71
  );

$yylhs = array(
      0,    1,    2,    3,    3,    4,    4,    6,    6,    8,
      8,    8,    9,    5,    5,   10,   11,   11,   13,   13,
     14,   14,   14,   17,   15,   15,   16,   16,   18,   18,
     12,   12,   20,   20,   19,   19,   21,   22,    7,    7
  );

$yylen = array(
      1,    1,    3,    0,    3,    0,    2,    5,    5,    2,
      2,    1,    1,    1,    2,    4,    1,    5,    1,    3,
      1,    1,    2,    2,    1,    1,    1,    2,    1,    1,
      1,    2,    3,    1,    1,    1,    4,    1,    0,    1
  );

define('YYSTATES', 63);
define('YYNLSTATES', 35);
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
{ $yyval = Parser::getInstance()->setTopNode($yyastk[$yysp-(1-1)]); } break;
        case 2:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(3-1)], array($yyastk[$yysp-(3-2)], $yyastk[$yysp-(3-3)])); } break;
        case 3:
{ $yyval = Parser::getInstance()->genEmpty(''); } break;
        case 4:
{ $yyval = Parser::getInstance()->genCharset($yyastk[$yysp-(3-2)]); } break;
        case 5:
{ $yyval = Parser::getInstance()->genEmpty(''); } break;
        case 6:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 7:
{ $yyval = Parser::getInstance()->genImport($yyastk[$yysp-(5-3)]); } break;
        case 8:
{ $yyval = Parser::getInstance()->genImport($yyastk[$yysp-(5-3)]); } break;
        case 9:
{ $yyval = '+'; } break;
        case 10:
{ $yyval = '>'; } break;
        case 12:
{ $yyval = Parser::getInstance()->genProperty($yyastk[$yysp-(1-1)]); } break;
        case 14:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 15:
{ $yyval = Parser::getInstance()->genRuleset($yyastk[$yysp-(4-1)], $yyastk[$yysp-(4-3)]); } break;
        case 17:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(5-1)], $yyastk[$yysp-(5-5)]); } break;
        case 18:
{ $yyval = Parser::getInstance()->genSelector($yyastk[$yysp-(1-1)]); } break;
        case 19:
{ $yyval = $yyastk[$yysp-(3-1)]; $yyastk[$yysp-(3-1)]->appendValue($yyastk[$yysp-(3-2)], $yyastk[$yysp-(3-3)]); } break;
        case 22:
{ $yyval = $yyastk[$yysp-(2-1)] . $yyastk[$yysp-(2-2)]; } break;
        case 23:
{ $yyval = chr($yyastk[$yysp-(2-1)]) . $yyastk[$yysp-(2-2)]; } break;
        case 27:
{ $yyval = $yyastk[$yysp-(2-1)] . $yyastk[$yysp-(2-2)]; } break;
        case 31:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 32:
{ $yyval = $yyastk[$yysp-(3-3)]; } break;
        case 36:
{ $yyval = Parser::getInstance()->genDeclaration($yyastk[$yysp-(4-1)], $yyastk[$yysp-(4-4)]); } break;
        case 37:
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
    initialize();
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

function initialize() {
    defineRegexs();
    global $state_ruleset;
    $state_ruleset = false;
}

function yylex() {
    global $lexbuf, $yylval, $regexs, $state_ruleset;
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
                switch ($token) {
                case 'COMMENT':
                    continue 3;

                case 'LBRACE':
                    $state_ruleset = true;
                    break;

                case 'RBRACE':
                    $state_ruleset = false;
                    break;

                case 'EXPRESSION':
                    if (!$state_ruleset) {
                        $lexbuf = $yylval . $lexbuf;
                        continue 2;
                    }
                    break;
                }
                return constant($token);
            }
        }
        // unmatched regexs
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

function defineRegexs() {
    global $regexs;
    $regexs = array(
        'LBRACE'        => '\s*{\s*',
        'RBRACE'        => '\s*}\s*',

        // only enable between LBRACE and RBRACE
        'EXPRESSION'    =>
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
        '(?=[;}])',

        'COMMENT'       => '\s*\/\*.*?\*\/\s*',
        'STRING'        => '{{string}}',
        'URI'           => 'url\(\s*{{string}}\s*\)',
        'IMPORTANT_SYM' => '!important\s*',
        'CHARSET_SYM'   => '@charset ',
        'IMPORT_SYM'    => '@import\s*',
        'MEDIA_SYM'     => '@media\s*',
        'PAGE_SYM'      => '@page\s*',

        'EMS'           => '{{num}}em',
        'EXS'           => '{{num}}ex',
        'LENGTH'        => '{{num}}(px|cm|mm|in|pt|pc)',
        'ANGLE'         => '{{num}}(deg|rad|grad)',
        'TIME'          => '{{num}}(ms|s)',
        'FREQ'          => '{{num}}(hz|khz)',

        'HEXCOLOR'      => '#(?:{{h}}{6}|{{h}}{3})',
        'HASH'          => '#{{name}}+',
        'IDENT'         => '{{ident}}',
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
