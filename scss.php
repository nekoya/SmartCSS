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
define('CHARSET', 277);
define('IMPORT', 278);
define('EXPRESSION', 279);
define('SELECTOR', 280);
define('DECLARATION', 281);

  
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
      0,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   11,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,    1,    2,    3,    4,
      5,    6,   12,   12,   12,   12,   12,   12,   12,   12,
     12,   12,   12,   12,   12,   12,   12,    7,    8,   12,
      9,   10
  );

define('YYBADCH', 12);
define('YYMAXLEX', 282);
define('YYTERMS', 12);
define('YYNONTERMS', 15);

$yyaction = array(
     30,  -14,    0,   13,   24,   41,    4,   39,    7,    8,
     27,    0,   21,    0,    0,    0,   33,   34,  -10,    0,
     39,    0,    9
  );

define('YYLAST', 23);

$yycheck = array(
      3,    2,    0,    4,    8,    4,    2,   10,    5,    6,
      4,   -1,    7,   -1,   -1,   -1,    9,    9,    9,   -1,
     10,   -1,   11
  );

$yybase = array(
      5,   -1,   -3,    6,   10,   -4,    7,    1,    1,    1,
      7,    2,    4,    9,    8,   11,    0,    0,    3,    7,
      3,    7,    7
  );

define('YY2TBLSTATE', 6);

$yydefault = array(
      3,   23,32767,   15,32767,32767,    2,   23,   23,   23,
  32767,32767,32767,   24,32767,32767,    5
  );



$yygoto = array(
     25,   26,   10,   28,   29,   35,    3
  );

define('YYGLAST', 7);

$yygcheck = array(
      8,    8,    8,    9,    9,   13,   12
  );

$yygbase = array(
      0,    0,    0,    0,    0,    0,    0,    0,   -7,   -2,
      0,    0,   -4,    1,    0
  );

$yygdefault = array(
  -32768,   11,   18,   16,    5,    6,   23,   14,   15,   38,
     12,    2,    1,   36,   37
  );

$yylhs = array(
      0,    1,    2,    3,    3,    4,    4,    6,    7,    7,
      7,    5,    5,    9,   10,   10,   12,   12,   11,   11,
     13,   13,   14,    8,    8
  );

$yylen = array(
      1,    1,    3,    0,    1,    0,    2,    1,    2,    2,
      1,    1,    2,    4,    1,    5,    1,    3,    1,    2,
      1,    1,    1,    0,    1
  );

define('YYSTATES', 35);
define('YYNLSTATES', 17);
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
{ $yyval = Parser::getInstance()->genCharset($yyastk[$yysp-(1-1)]); } break;
        case 5:
{ $yyval = Parser::getInstance()->genEmpty(''); } break;
        case 6:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 7:
{ $yyval = Parser::getInstance()->genImport($yyastk[$yysp-(1-1)]); } break;
        case 8:
{ $yyval = '+'; } break;
        case 9:
{ $yyval = '>'; } break;
        case 12:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 13:
{ $yyval = Parser::getInstance()->genRuleset($yyastk[$yysp-(4-1)], $yyastk[$yysp-(4-3)]); } break;
        case 15:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(5-1)], $yyastk[$yysp-(5-5)]); } break;
        case 16:
{ $yyval = Parser::getInstance()->genSelector($yyastk[$yysp-(1-1)]); } break;
        case 17:
{ $yyval = $yyastk[$yysp-(3-1)]; $yyastk[$yysp-(3-1)]->appendValue($yyastk[$yysp-(3-2)], $yyastk[$yysp-(3-3)]); } break;
        case 19:
{ $yyval = Parser::getInstance()->catNode($yyastk[$yysp-(2-1)], $yyastk[$yysp-(2-2)]); } break;
        case 22:
{ $yyval = Parser::getInstance()->genDeclaration($yyastk[$yysp-(1-1)]); } break;
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
    $state_ruleset = 0;
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
                if (!empty($parser->debug)) {
                    var_dump($matches);
                }
                $yylval = (string)$matches[1];
                $lexbuf = substr($lexbuf, strlen($yylval));
                switch ($token) {
                case 'COMMENT':
                    continue 3;

                case 'LBRACE':
                    $state_ruleset++;
                    break;

                case 'RBRACE':
                    $state_ruleset--;
                    break;

                case 'EXPRESSION':
                    if (!$state_ruleset) {
                        $lexbuf = $yylval . $lexbuf;
                        continue 2;
                    }
                    break;
                }
                p($token . ' ' . $yylval);
                return constant($token);
            }
        }
        // unmatched regexs
        p('token unmatched');
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
        '(?:;\s*|(?=}))',

        'DECLARATION'   => '{{ident}}\s*:\s*{{EXPRESSION}}',

        'SELECTOR'      => '(?:(?:{{ident}}|\*)(?:#{{name}}+|\.{{ident}})*|(?:#{{name}}+|\.{{ident}})+)',

        'COMMENT'       => '\s*\/\*.*?\*\/\s*',
        'STRING'        => '{{string}}',
        'URI'           => 'url\(\s*{{string}}\s*\)',
        'IMPORTANT_SYM' => '!important\s*',
        'CHARSET'       => '@charset {{string}};',
        'IMPORT'        => '@import\s*(?:{{string}}|{{URI}})\s*{{media_types}};',

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
        'string'  => '(?:".*?"|' . "'.*?')",
        'unary_operator' => '(?:\+|\-)?',
        'media_types'    => '(?:{{ident}}\s*(?:,\s*{{ident}}\s*)*){0,1}',
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
