<?php

//<?php

/* Prototype file of classed PHP parser.
 * Written by Moriyoshi Koizumi, based on the work by Masato Bito.
 * This file is PUBLIC DOMAIN.
 *
 * Little customized by Ryo Miyake (nekoya)
 */
class SCSS_Parser
{
    const YYBADCH      = 34;
    const YYMAXLEX     = 285;
    const YYTERMS      = 34;
    const YYNONTERMS   = 21;
    const YYLAST       = 50;
    const YY2TBLSTATE  = 14;
    const YYGLAST      = 35;
    const YYSTATES     = 93;
    const YYNLSTATES   = 50;
    const YYINTERRTOK  = 1;
    const YYUNEXPECTED = 32767;
    const YYDEFAULT    = -32766;

    // {{{ Tokens
    const YYERRTOK = 256;
    const LBRACE = 257;
    const SPACE = 258;
    const NL = 259;
    const STRING = 260;
    const IDENT = 261;
    const NUMBER = 262;
    const HASH = 263;
    const HEXCOLOR = 264;
    const PERCENTAGE = 265;
    const URI = 266;
    const EMS = 267;
    const EXS = 268;
    const LENGTH = 269;
    const ANGLE = 270;
    const TIME = 271;
    const FREQ = 272;
    const IMPORTANT_SYM = 273;
    const CHARSET = 274;
    const IMPORT = 275;
    const SELECTOR = 276;
    const TERM = 277;
    const COMMA = 278;
    const cLDELIM = 279;
    const cRDELIM = 280;
    const cCOMMAND = 281;
    const cIDENT = 282;
    const cEQUAL = 283;
    const cVALUE = 284;
    // }}}

    public $lex;
    protected $yyval;
    protected $yyastk;
    protected $yysp;
    protected $yyaccept;



    private static $yytranslate = array(
            0,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   33,   34,   22,   34,   32,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   23,   24,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,    3,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,   34,   34,   34,   34,
           34,   34,   34,   34,   34,   34,    1,    2,    4,    5,
            6,    7,    8,   34,    9,   10,   11,   12,   13,   14,
           15,   16,   17,   18,   19,   20,   21,   34,   25,   26,
           27,   28,   29,   30,   31
    );

    private static $yyaction = array(
           25,   14,   26,    0,   27,   28,   29,   30,   31,   32,
           21,   22,   69,   88,   33,   23,   41,    9,   20,   36,
          -25,   34,   17,   96,   97,-32766,   62,   17,   35,   13,
            8,   57,   54,   19,   99,  100,  101,   63,    0,    0,
            0,   98,    0,    0,    0,    0,   15,    0,   16,   18
    );

    private static $yycheck = array(
            8,    2,   10,    0,   12,   13,   14,   15,   16,   17,
            6,    7,   21,    9,   18,   11,    4,   26,    3,   24,
           24,   25,    7,    4,    5,   21,   22,    7,   32,   28,
           29,   20,   19,   23,   27,   27,   27,   33,   -1,   -1,
           -1,   27,   -1,   -1,   -1,   -1,   30,   -1,   31,   31
    );

    private static $yybase = array(
           13,   -8,    4,    4,   15,   -4,   20,   11,   16,   19,
           -9,   19,   19,   12,   19,   19,   19,   19,   19,   19,
           19,   19,   19,   19,   19,   19,   19,   19,   19,   19,
           19,   19,   19,   19,   19,   19,   19,   19,    1,    3,
           -1,   17,   14,    8,   18,   10,    7,    9,   -5,    0,
            0,    0,   -9,   -9,   -9,    0,   -9,   -9,   19,    0,
            0,    0,    0,   19
    );

    private static $yydefault = array(
            3,32767,   11,   11,32767,    8,32767,32767,   42,   42,
            2,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   42,   42,   42,
           42,   42,   42,   42,   42,   42,   42,   43,32767,32767,
        32767,   46,32767,32767,32767,32767,32767,32767,32767,    5
    );

    private static $yygoto = array(
           38,   78,   40,   68,   42,    6,   44,   46,   64,   47,
            2,   67,   90,   89,   87,   91,   86,   79,   81,   82,
           80,   83,   84,   85,   76,   60,   59,   74,   71,   65,
           24,   24,   66,   70,   95
    );

    private static $yygcheck = array(
            8,   18,    8,    8,    8,    8,    8,    8,    8,    8,
            8,    8,    8,    8,    8,    8,    8,    8,    8,    8,
            8,    8,    8,    8,    8,    8,    8,    8,   11,   11,
           14,   14,   11,   15,   20
    );

    private static $yygbase = array(
            0,    0,    0,    0,    0,    0,    0,    0,   -9,    0,
            0,   22,    0,    0,   28,   27,    0,    0,   -2,    0,
           -3
    );

    private static $yygdefault = array(
        -32768,   39,   51,   49,    7,   10,   56,    3,   43,    1,
           45,   73,   11,    4,   12,   72,    5,   48,   77,   37,
           94
    );

    private static $yylhs = array(
            0,    1,    2,    3,    3,    4,    4,    6,    7,    7,
            7,    9,    9,    9,   10,    5,    5,   11,   11,   12,
           13,   13,   13,   13,   15,   17,   17,   16,   16,   18,
           18,   18,   18,   18,   18,   18,   18,   18,   18,   18,
           18,   18,    8,    8,   19,   19,   20,   20,   14,   14,
           14,   14
    );

    private static $yylen = array(
            1,    1,    3,    0,    1,    0,    2,    1,    0,    2,
            2,    0,    1,    1,    2,    1,    2,    7,    2,    1,
            1,    1,    2,    2,    7,    0,    2,    1,    3,    3,
            3,    3,    3,    3,    3,    3,    3,    2,    1,    2,
            2,    2,    0,    1,    1,    2,    1,    1,    5,    7,
            5,    8
    );

    protected function yyprintln($msg) {
        echo "$msg\n";
    }

    protected function yyflush() {
        return;
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
                        
                        if ($yyerrflag > 0)
                            $yyerrflag--;
                        if ($yyn < self::YYNLSTATES)
                            continue;
                            
                        /* $yyn >= YYNLSTATES means shift-and-reduce */
                        $yyn -= self::YYNLSTATES;
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
         $this->yyval = $this->setTopNode($this->yyastk[$this->yysp-(1-1)]); 
    }

    private function yyn2() {
         $this->yyval = $this->catNode($this->yyastk[$this->yysp-(3-1)], array($this->yyastk[$this->yysp-(3-2)], $this->yyastk[$this->yysp-(3-3)])); 
    }

    private function yyn3() {
         $this->yyval = $this->genEmpty(); 
    }

    private function yyn4() {
         $this->yyval = $this->genCharset($this->yyastk[$this->yysp-(1-1)]); 
    }

    private function yyn5() {
         $this->yyval = $this->genEmpty(); 
    }

    private function yyn6() {
         $this->yyval = $this->catNode($this->yyastk[$this->yysp-(2-1)], $this->yyastk[$this->yysp-(2-2)]); 
    }

    private function yyn7() {
         $this->yyval = $this->genImport($this->yyastk[$this->yysp-(1-1)]); 
    }

    private function yyn8() {
         $this->yyval = ' '; 
    }

    private function yyn9() {
         $this->yyval = $this->yyastk[$this->yysp-(2-1)]; 
    }

    private function yyn10() {
         $this->yyval = $this->yyastk[$this->yysp-(2-1)]; 
    }

    private function yyn11() {
         $this->yyval = ''; 
    }

    private function yyn12() {
         $this->yyval = $this->yyastk[$this->yysp-(1-1)]; 
    }

    private function yyn13() {
         $this->yyval = $this->yyastk[$this->yysp-(1-1)]; 
    }

    private function yyn14() {
         $this->yyval = $this->yyastk[$this->yysp-(2-1)]; 
    }

    private function yyn15() {
         $this->yyval = $this->yyastk[$this->yysp-(1-1)]; 
    }

    private function yyn16() {
         $this->yyval = $this->catNode($this->yyastk[$this->yysp-(2-1)], $this->yyastk[$this->yysp-(2-2)]); 
    }

    private function yyn17() {
         $this->yyval = $this->genRuleset($this->yyastk[$this->yysp-(7-1)], $this->yyastk[$this->yysp-(7-5)]); 
    }

    private function yyn18() {
         $this->yyval = $this->yyastk[$this->yysp-(2-1)]; 
    }

    private function yyn19() {
         $this->yyval = $this->genSelector($this->yyastk[$this->yysp-(1-1)]); 
    }

    private function yyn20() {
         $this->yyval = $this->yyastk[$this->yysp-(1-1)]; 
    }

    private function yyn21() {
         $this->yyval = $this->yyastk[$this->yysp-(1-1)]; 
    }

    private function yyn22() {
         $this->yyval = $this->catNode($this->yyastk[$this->yysp-(2-1)], $this->yyastk[$this->yysp-(2-2)]); 
    }

    private function yyn23() {
         $this->yyval = $this->catNode($this->yyastk[$this->yysp-(2-1)], $this->yyastk[$this->yysp-(2-2)]); 
    }

    private function yyn24() {
         $this->yyval = $this->genDeclaration($this->yyastk[$this->yysp-(7-1)], $this->yyastk[$this->yysp-(7-4)], $this->yyastk[$this->yysp-(7-5)]); 
    }

    private function yyn25() {
         $this->yyval = ''; 
    }

    private function yyn26() {
         $this->yyval = $this->yyastk[$this->yysp-(2-1)]; 
    }

    private function yyn27() {
         $this->yyval = $this->yyastk[$this->yysp-(1-1)]; 
    }

    private function yyn28() {
         $this->yyval = trim($this->yyastk[$this->yysp-(3-1)]) . $this->yyastk[$this->yysp-(3-2)] . trim($this->yyastk[$this->yysp-(3-3)]); 
    }

    private function yyn29() {
         $this->yyval = $this->yyastk[$this->yysp-(3-1)] . $this->yyastk[$this->yysp-(3-2)]; 
    }

    private function yyn30() {
         $this->yyval = $this->yyastk[$this->yysp-(3-1)] . $this->yyastk[$this->yysp-(3-2)]; 
    }

    private function yyn31() {
         $this->yyval = $this->yyastk[$this->yysp-(3-1)] . $this->yyastk[$this->yysp-(3-2)]; 
    }

    private function yyn32() {
         $this->yyval = $this->yyastk[$this->yysp-(3-1)] . $this->yyastk[$this->yysp-(3-2)]; 
    }

    private function yyn33() {
         $this->yyval = $this->yyastk[$this->yysp-(3-1)] . $this->yyastk[$this->yysp-(3-2)]; 
    }

    private function yyn34() {
         $this->yyval = $this->yyastk[$this->yysp-(3-1)] . $this->yyastk[$this->yysp-(3-2)]; 
    }

    private function yyn35() {
         $this->yyval = $this->yyastk[$this->yysp-(3-1)] . $this->yyastk[$this->yysp-(3-2)]; 
    }

    private function yyn36() {
         $this->yyval = $this->yyastk[$this->yysp-(3-1)] . $this->yyastk[$this->yysp-(3-2)]; 
    }

    private function yyn37() {
         $this->yyval = $this->yyastk[$this->yysp-(2-1)]; 
    }

    private function yyn38() {
         $this->yyval = $this->yyastk[$this->yysp-(1-1)]; 
    }

    private function yyn39() {
         $this->yyval = $this->yyastk[$this->yysp-(2-1)]; 
    }

    private function yyn40() {
         $this->yyval = $this->yyastk[$this->yysp-(2-1)]; 
    }

    private function yyn41() {
         $this->yyval = $this->yyastk[$this->yysp-(2-1)]; 
    }
    private function yyn42() {}
    private function yyn43() {}
    private function yyn44() {}
    private function yyn45() {}
    private function yyn46() {}
    private function yyn47() {}

    private function yyn48() {
         $this->yyval = ''; $this->genCommand($this->yyastk[$this->yysp-(5-3)]); 
    }

    private function yyn49() {
         $this->yyval = ''; $this->genCommand($this->yyastk[$this->yysp-(7-3)], $this->yyastk[$this->yysp-(7-5)]); 
    }

    private function yyn50() {
         $this->yyval = ''; $this->getVar($this->yyastk[$this->yysp-(5-3)]); 
    }

    private function yyn51() {
         $this->yyval = ''; $this->setVar($this->yyastk[$this->yysp-(8-3)], $this->yyastk[$this->yysp-(8-6)]); 
    }
    protected $lastInsertId = 0;
    protected $topNode;
    protected $nodes = array();
    protected $dirStack = array();  // for pushd/popd
    public $vars = array();
    public $debug;

    /**
     *
     */
    public function setTopNode($node) {
        $this->topNode = $node;
        return $node;
    }

    /**
     *
     */
    public function genRuleset($selector, $declarations) {
        $node = $this->createNode(
            'ruleset',
            array($selector, $declarations)
        );
        return $node;
    }

    /**
     *
     */
    public function genDeclaration($property, $expr, $prio = '') {
        $node = $this->createNode(
            'declaration',
            array($property, $expr, $prio)
        );
        $this->debug(" - $property:$expr $prio");
        return $node;
    }

    /**
     *
     */
    public function genCommand($name, $params = array()) {
        if (!is_array($params)) {
            $params = array($params);
        }

        $className = 'SCSS_Command_' . ucfirst($name);
        // calling autoload deters Fatal error with load class
        if (!class_exists($className, false)) {
            try {
                SCSS_AutoLoader::autoload($className);
            } catch (Exception $e) {
                throw new Exception("Command not found: $name");
            }
        }
        $command = new $className($this, $params);
        return $command->execute();
    }

    /**
     *
     */
    public function __call($method, $args) {
        if (preg_match('/^gen([A-Z][a-z]*)$/', $method, $matches)) {
            $type = strtolower($matches[1]);
            $value = (isset($args[0])) ? $args[0] : null;
            return $this->createNode($type, $value);
        }
        throw new Exception("Method $method not found.");
    }

    /**
     *
     */
    protected function createNode($type, $arg = null) {
        $className = 'SCSS_YYNode_' . ucfirst($type);
        $node = new $className($arg);
        $node->id = $this->lastInsertId++;
        $this->nodes[] = $node;
        $this->debug($node->id. ": create $type:" . (string)$arg);
        return $node;
    }

    /**
     *
     */
    public function catNode($base, $newone) {
        if (is_array($newone)) {
            foreach ($newone as $node) {
                $this->catNode($base, $node);
            }
        }

        if (!$newone instanceof SCSS_YYNode) {
            // skip $newone (ex: catNode(decl, ';'))
            return $base;
        }
        if ($base === '') {
            // skip command/vars
            return $newone;
            $this->debug('skip command/vars');
        }
        $node = $base;
        while ($node->hasNext()) {
            $node = $node->next;
            if (!is_object($node) || !$node instanceof SCSS_YYNode) {
                throw new Exception('Is not node object');
            }
        }
        $node->next = $newone;
        $this->debug($node->id . '<-' . $newone->id);
        return $base;
    }

    /**
     *
     */
    public function run() {
        return $this->topNode->publish();
    }

    /**
     *
     */
    public function debug($msg) {
        if ($this->debug) {
            echo $msg . "\n";
        }
    }

    /**
     *
     */
    public function reset() {
        $this->lastInsertId = 0;
        $this->topNode = null;
        $this->nodes = array();
    }

    /**
     *
     */
    public function setVar($var, $value) {
        $value = substr($value, 1);
        $value = substr($value, 0, strlen($value)-1);
        $this->vars[$var] = $value;
        $this->debug("setVar:$var = $value");
        return $value;
    }

    /**
     *
     */
    public function getVar($var) {
        if ( isset($this->vars[$var]) ) {
            $this->debug("getVar:$var");
            if (!empty($this->lex)) {
                $this->lex->prependBuffer($this->vars[$var]);
            }
            return $this->vars[$var];
        }
    }

    /**
     *
     */
    public function pushd($dirname) {
        if (empty($dirname)) {
            throw new Exception('empty dirname for pushd');
        }
        $this->dirStack[] =  getcwd();
        chdir($dirname);
        $this->debug("pushd: $dirname");
        return true;
    }

    /**
     *
     */
    public function popd() {
        $dirname = array_pop($this->dirStack);
        if ($dirname === null) {
            throw new Exception('no directory in stack');
        }
        chdir($dirname);
        $this->debug("popd: $dirname");
        return $dirname;
    }

    /**
     *
     */
    protected function yyerror($msg) {
        $lineNum = $this->lex->lineNum;
        throw new Exception("$msg at line $lineNum.");
    }
}
