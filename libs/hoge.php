<?php

// 足し算しかできない計算機
//
// 使い方の例
// php hoge.php 1 + 2 + 3 

/* Prototype file of classed PHP parser.
 * Written by Moriyoshi Koizumi, based on the work by Masato Bito.
 * This file is PUBLIC DOMAIN.
 */
class YYParser
{
    const YYBADCH      = 4;
    const YYMAXLEX     = 258;
    const YYTERMS      = 4;
    const YYNONTERMS   = 3;
    const YYLAST       = 5;
    const YY2TBLSTATE  = 0;
    const YYGLAST      = 0;
    const YYSTATES     = 6;
    const YYNLSTATES   = 4;
    const YYINTERRTOK  = 1;
    const YYUNEXPECTED = 32767;
    const YYDEFAULT    = -32766;

    // {{{ Tokens
    const YYERRTOK = 256;
    const NUMBER = 257;
    // }}}

    protected $yyval;
    protected $yyastk;
    protected $yysp;
    protected $yyaccept;



    private static $yytranslate = array(
            0,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    3,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    4,    4,    4,    4,
            4,    4,    4,    4,    4,    4,    1,    2
    );

    private static $yyaction = array(
            7,    0,    3,    0,    6
    );

    private static $yycheck = array(
            2,    0,    3,   -1,    2
    );

    private static $yybase = array(
           -2,    1,   -1,    2
    );

    private static $yydefault = array(
        32767,32767,    1,32767
    );

    private static $yygoto = array(
    );

    private static $yygcheck = array(
    );

    private static $yygbase = array(
            0,    0,    0
    );

    private static $yygdefault = array(
        -32768,    1,    2
    );

    private static $yylhs = array(
            0,    1,    2,    2
    );

    private static $yylen = array(
            1,    1,    3,    1
    );

    protected function yyprintln($msg) {
        echo "$msg\n";
    }

    protected function yyflush() {
        return;
    }

    protected function yyerror($msg) {
        $this->yyprintln($msg);
    }

    protected function yyaccept() {
        $this->yyaccept = 1;
    }

    protected function yyabort() {
        $this->yyaccept = 2;
    }


    /**
     * Parser entry point
     */
    public function yyparse($lex) {
        $this->lex = $lex;

        $this->yyastk = array();
        $yysstk = array();
        $this->yysp = 0;

        $yyn = $yyl = 0;
        $yystate = 0;
        $yychar = -1;

        $yylval = null;
        $yysstk[$this->yysp] = 0;
        $yyaccept = 0;
        $yyerrflag = 0;

        for (;;) {
            if (self::$yybase[$yystate] == 0) {
                $yyn = self::$yydefault[$yystate];
            } else {
                if ($yychar < 0) {
                    if (($yychar = $lex->yylex($yylval)) < 0)
                        $yychar = 0;
                    $yychar = $yychar < self::YYMAXLEX ?
                        self::$yytranslate[$yychar] : self::YYBADCH;
                }
                if ((($yyn = self::$yybase[$yystate] + $yychar) >= 0
                     && $yyn < self::YYLAST && self::$yycheck[$yyn] == $yychar
                     || ($yystate < self::YY2TBLSTATE
                        && ($yyn = self::$yybase[$yystate + self::YYNLSTATES]
                            + $yychar) >= 0
                        && $yyn < self::YYLAST
                        && self::$yycheck[$yyn] == $yychar))
                    && ($yyn = self::$yyaction[$yyn]) != self::YYDEFAULT) {
                    /*
                     * >= YYNLSTATE: shift and reduce
                     * > 0: shift
                     * = 0: accept
                     * < 0: reduce
                     * = -YYUNEXPECTED: error
                     */
                    if ($yyn > 0) {
                        /* shift */
                        $this->yysp++;

                        $yysstk[$this->yysp] = $yystate = $yyn;
                        $this->yyastk[$this->yysp] = $yylval;
                        $yychar = -1;
                        
                        if ($yyrrflag > 0)
                            ;
                    } else {
                        $yyn = -$yyn;
                    }
                } else {
                    $yyn = self::$yydefault[$yystate];
                }
            }
                
            for (;;) {
                /* reduce/error */
                if ($yyn == 0) {
                    /* accept */
                    $this->yyflush();
                    $this->lex = null;
                    return $this->yyaccept - 1;
                } else if ($yyn != self::YYUNEXPECTED) {
                    /* reduce */
                    $yyl = self::$yylen[$yyn];
                    $n = $this->yysp-$yyl+1;
                    $yyval = isset($this->yyastk[$n]) ? $this->yyastk[$n] : null;
                    /* Following line will be replaced by reduce actions */
                    $yydisp = "yyn$yyn";
                    $this->$yydisp($this->yyastk, $this->yysp);
                    if ($this->yyaccept) {
                        $yyn = self::YYNLSTATES;
                    } else {
                        /* Goto - shift nonterminal */
                        $this->yysp -= $yyl;
                        $yyn = self::$yylhs[$yyn];
                        if (($yyp = self::$yygbase[$yyn] + $yysstk[$this->yysp]) >= 0
                             && $yyp < self::YYGLAST
                             && self::$yygcheck[$yyp] == $yyn) {
                            $yystate = self::$yygoto[$yyp];
                        } else {
                            $yystate = self::$yygdefault[$yyn];
                        }

                        $this->yysp++;

                        $yysstk[$this->yysp] = $yystate;
                        $this->yyastk[$this->yysp] = $this->yyval;
                    }
                } else {
                    /* error */
                    switch ($yyerrflag) {
                    case 0:
                        $this->yyerror("syntax error");
                    case 1:
                    case 2:
                        $yyerrflag = 3;
                        /* Pop until error-expecting state uncovered */

                        while (!(($yyn = self::$yybase[$yystate] + self::YYINTERRTOK) >= 0
                                 && $yyn < self::YYLAST
                                 && self::$yycheck[$yyn] == self::YYINTERRTOK
                                 || ($yystate < self::YY2TBLSTATE
                                    && ($yyn = self::$yybase[$yystate + self::YYNLSTATES] + self::YYINTERRTOK) >= 0
                                    && $yyn < self::YYLAST
                                    && self::$yycheck[$yyn] == self::YYINTERRTOK))) {
                            if ($this->yysp <= 0) {
                                $this->yyflush();
                                $this->lex = null;
                                return 1;
                            }
                            $yystate = $yysstk[--$this->yysp];
                        }
                        $yyn = self::$yyaction[$yyn];
                        $yysstk[++$this->yysp] = $yystate = $yyn;
                        break;

                    case 3:
                        if ($yychar == 0) {
                            $this->yyflush();
                            $this->lex = null;
                            return 1;
                        }
                        $yychar = -1;
                        break;
                    }
                }
                    
                if ($yystate < self::YYNLSTATES)
                    break;
                /* >= YYNLSTATES means shift-and-reduce */
                $yyn = $yystate - self::YYNLSTATES;
            }
        }
        $this->lex = null;
    }
    private function yyn0() {}

    private function yyn1() {
         var_dump($this->yyval); 
    }

    private function yyn2() {
         $this->yyval = $this->yyastk[$this->yysp-(3-1)] + $this->yyastk[$this->yysp-(3-3)]; 
    }

    private function yyn3() {
         $this->yyval = $this->yyastk[$this->yysp-(1-1)]; 
    }
}
class Lexer {
    function yylex(&$yylval) {
        $yylval = array_shift($_SERVER['argv']);
        if ($yylval == '+')
            return ord('+');
        else if ($yylval === NULL)
            return 0;
        else
            return YYParser::NUMBER;
    }
}

array_shift($_SERVER['argv']);

$l = new Lexer();
$p = new YYParser();
$p->yyparse($l);
