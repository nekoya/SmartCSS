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
    const YYBADCH      = 31;
    const YYMAXLEX     = 284;
    const YYTERMS      = 31;
    const YYNONTERMS   = 18;
    const YYLAST       = 48;
    const YY2TBLSTATE  = 9;
    const YYGLAST      = 32;
    const YYSTATES     = 84;
    const YYNLSTATES   = 45;
    const YYINTERRTOK  = 1;
    const YYUNEXPECTED = 32767;
    const YYDEFAULT    = -32766;

    // {{{ Tokens
    const YYERRTOK = 256;
    const LBRACE = 257;
    const SPACE = 258;
    const STRING = 259;
    const IDENT = 260;
    const NUMBER = 261;
    const HASH = 262;
    const HEXCOLOR = 263;
    const PERCENTAGE = 264;
    const URI = 265;
    const EMS = 266;
    const EXS = 267;
    const LENGTH = 268;
    const ANGLE = 269;
    const TIME = 270;
    const FREQ = 271;
    const IMPORTANT_SYM = 272;
    const CHARSET = 273;
    const IMPORT = 274;
    const SELECTOR = 275;
    const TERM = 276;
    const COMMA = 277;
    const cLDELIM = 278;
    const cRDELIM = 279;
    const cCOMMAND = 280;
    const cIDENT = 281;
    const cEQUAL = 282;
    const cVALUE = 283;
    // }}}

    public $lex;
    protected $yyval;
    protected $yyastk;
    protected $yysp;
    protected $yyaccept;



    private static $yytranslate = array(
            0,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   30,   31,   20,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   21,   22,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,    3,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,   31,   31,   31,   31,
           31,   31,   31,   31,   31,   31,    1,    2,    4,    5,
            6,    7,   31,    8,    9,   10,   11,   12,   13,   14,
           15,   16,   31,   17,   18,   19,   31,   23,   24,   25,
           26,   27,   28,   29
    );

    private static $yyaction = array(
           27,   13,   28,    0,   29,   30,   31,   32,   33,   34,
           23,   24,   85,   80,   63,   25,   37,   21,   49,   11,
           18,   18,   14,   15,    8,   54,   63,   52,   35,   11,
           17,   20,    0,   19,    0,   55,   88,    0,   86,    0,
            0,   89,   87,    0,    0,    0,    0,   22
    );

    private static $yycheck = array(
            7,    2,    9,    0,   11,   12,   13,   14,   15,   16,
            5,    6,    4,    8,   19,   10,    4,    3,   17,   24,
            6,    6,   23,   26,   27,   20,   19,   18,   22,   24,
           28,   21,   -1,   29,   -1,   30,   25,   -1,   25,   -1,
           -1,   25,   25,   -1,   -1,   -1,   -1,   29
    );

    private static $yybase = array(
            1,    6,   -7,    5,   14,   15,    9,   -5,    2,   -1,
           -3,    8,    8,    8,    8,   12,    7,    8,    8,    8,
            8,    8,    8,    8,    8,    8,    8,    8,    8,    8,
            8,    8,    8,    8,    8,    8,    3,    4,   13,   11,
           10,   18,   17,   16,    0,    0,    5,    0,    0,   -5,
           -5,   -5,    0,    8
    );

    private static $yydefault = array(
            3,    8,32767,    8,32767,32767,32767,    2,   39,32767,
        32767,   39,   39,   39,   39,   39,32767,   39,   39,   39,
           39,   39,   39,   39,   39,   39,   39,   39,   39,   39,
           39,   39,   39,   39,   39,   39,32767,   40,32767,32767,
        32767,32767,32767,32767,    5
    );

    private static $yygoto = array(
           10,   60,    5,   16,   38,   69,   41,   56,   42,    3,
           59,   43,   82,   81,   79,   83,   78,   71,   73,   74,
           72,   75,   76,   77,   68,   65,   57,   58,   26,   64,
           26,   62
    );

    private static $yygcheck = array(
            9,    9,    9,    9,    9,   17,    9,    9,    9,    9,
            9,    9,    9,    9,    9,    9,    9,    9,    9,    9,
            9,    9,    9,    9,    9,   10,   10,   10,   13,   15,
           13,   14
    );

    private static $yygbase = array(
            0,    0,    0,    0,    0,    0,    0,    0,    0,  -11,
           20,    0,    0,   27,   15,   24,    0,    2
    );

    private static $yygdefault = array(
        -32768,   36,   46,   44,    6,    7,   51,    2,   40,   39,
           67,    9,    4,   12,   61,   66,    1,   70
    );

    private static $yylhs = array(
            0,    1,    2,    3,    3,    4,    4,    6,    7,    7,
            7,    8,    5,    5,   10,   10,   11,   11,   14,   12,
           12,   12,   12,   15,   16,   16,   17,   17,   17,   17,
           17,   17,   17,   17,   17,   17,   17,   17,   17,    9,
            9,   13,   13,   13,   13
    );

    private static $yylen = array(
            1,    1,    3,    0,    1,    0,    2,    1,    0,    1,
            1,    2,    1,    2,    6,    2,    1,    4,    1,    1,
            1,    2,    2,    6,    1,    2,    3,    3,    3,    3,
            3,    3,    3,    3,    2,    1,    2,    2,    2,    0,
            1,    5,    7,    5,    8
    );

    protected function yyprintln($msg) {
        echo "$msg\n";
    }

    protected function yyflush() {
        return;
    }

    protected function yyerror($msg) {
        throw new Exception($msg);
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
         $this->yyval = ''; 
    }

    private function yyn9() {
         $this->yyval = $this->yyastk[$this->yysp-(1-1)]; 
    }

    private function yyn10() {
         $this->yyval = $this->yyastk[$this->yysp-(1-1)]; 
    }

    private function yyn11() {
         $this->yyval = $this->yyastk[$this->yysp-(2-1)]; 
    }

    private function yyn12() {
         $this->yyval = $this->yyastk[$this->yysp-(1-1)]; 
    }

    private function yyn13() {
         $this->yyval = $this->catNode($this->yyastk[$this->yysp-(2-1)], $this->yyastk[$this->yysp-(2-2)]); 
    }

    private function yyn14() {
         $this->yyval = $this->genRuleset($this->yyastk[$this->yysp-(6-1)], $this->yyastk[$this->yysp-(6-4)]); 
    }

    private function yyn15() {
         $this->yyval = $this->yyastk[$this->yysp-(2-1)]; 
    }

    private function yyn16() {
         $this->yyval = $this->yyastk[$this->yysp-(1-1)]; 
    }

    private function yyn17() {
         $this->yyval = $this->catNode($this->yyastk[$this->yysp-(4-1)], $this->yyastk[$this->yysp-(4-4)]); 
    }

    private function yyn18() {
         $this->yyval = $this->genSelector($this->yyastk[$this->yysp-(1-1)]); 
    }

    private function yyn19() {
         $this->yyval = $this->yyastk[$this->yysp-(1-1)]; 
    }

    private function yyn20() {
         $this->yyval = $this->yyastk[$this->yysp-(1-1)]; 
    }

    private function yyn21() {
         $this->yyval = $this->catNode($this->yyastk[$this->yysp-(2-1)], $this->yyastk[$this->yysp-(2-2)]); 
    }

    private function yyn22() {
         $this->yyval = $this->catNode($this->yyastk[$this->yysp-(2-1)], $this->yyastk[$this->yysp-(2-2)]); 
    }

    private function yyn23() {
         $this->yyval = $this->genDeclaration($this->yyastk[$this->yysp-(6-1)], $this->yyastk[$this->yysp-(6-4)]); 
    }

    private function yyn24() {
         $this->yyval = $this->yyastk[$this->yysp-(1-1)]; 
    }

    private function yyn25() {
         $this->yyval = trim($this->yyastk[$this->yysp-(2-1)]) . ' ' . trim($this->yyastk[$this->yysp-(2-2)]); 
    }

    private function yyn26() {
         $this->yyval = $this->yyastk[$this->yysp-(3-1)] . $this->yyastk[$this->yysp-(3-2)]; 
    }

    private function yyn27() {
         $this->yyval = $this->yyastk[$this->yysp-(3-1)] . $this->yyastk[$this->yysp-(3-2)]; 
    }

    private function yyn28() {
         $this->yyval = $this->yyastk[$this->yysp-(3-1)] . $this->yyastk[$this->yysp-(3-2)]; 
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
         $this->yyval = $this->yyastk[$this->yysp-(2-1)]; 
    }

    private function yyn35() {
         $this->yyval = $this->yyastk[$this->yysp-(1-1)]; 
    }

    private function yyn36() {
         $this->yyval = $this->yyastk[$this->yysp-(2-1)]; 
    }

    private function yyn37() {
         $this->yyval = $this->yyastk[$this->yysp-(2-1)]; 
    }

    private function yyn38() {
         $this->yyval = $this->yyastk[$this->yysp-(2-1)]; 
    }
    private function yyn39() {}
    private function yyn40() {}

    private function yyn41() {
         $this->yyval = ''; $this->genCommand($this->yyastk[$this->yysp-(5-3)]); 
    }

    private function yyn42() {
         $this->yyval = ''; $this->genCommand($this->yyastk[$this->yysp-(7-3)], $this->yyastk[$this->yysp-(7-5)]); 
    }

    private function yyn43() {
         $this->yyval = ''; $this->getVar($this->yyastk[$this->yysp-(5-3)]); 
    }

    private function yyn44() {
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
        $node = $this->createNode('ruleset');
        $node->children = array($selector, $declarations);
        return $node;
    }

    /**
     *
     */
    public function genDeclaration($property, $expr) {
        $node = $this->createNode('declaration');
        $this->debug(" - $property:$expr");
        $node->property = trim($property);
        $node->expr = trim($expr);
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
    protected function createNode($type, $value = null) {
        //echo "[[$type]]\n";
        $className = 'SCSS_YYNode_' . ucfirst($type);
        $node = new $className;
        $node->id = $this->lastInsertId++;
        //echo "----\n";
        //var_dump($node, $value);
        if (!is_null($value)) {
            $node->value = (string)$value;
        }
        array_push($this->nodes, $node);
        $this->debug($node->id. ": create $type:" . $node->value);
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
        array_push($this->dirStack, getcwd());
        chdir($dirname);
        $this->debug("chdir to $dirname");
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
        $this->debug("chdir to $dirname");
        return $dirname;
    }
}
