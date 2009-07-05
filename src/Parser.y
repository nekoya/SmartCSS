/*
 * SmartCSS yacc
 */

%{
//<?php
%}
%token LBRACE '}' SPACE NL
%token STRING IDENT NUMBER HASH HEXCOLOR PERCENTAGE URI
%token EMS EXS LENGTH ANGLE TIME FREQ
%token IMPORTANT_SYM
%token CHARSET IMPORT
%token SELECTOR
%token TERM
%token '-' ':' ';'
%token COMMA
%token cLDELIM cRDELIM cCOMMAND cIDENT cEQUAL cVALUE

%%
root : stylesheet { $$ = $this->setTopNode($1); }

stylesheet
    : charset imports rulesets { $$ = $this->catNode($1, array($2, $3)); }

charset
    : /* empty */ { $$ = $this->genEmpty(); }
    | CHARSET     { $$ = $this->genCharset($1); }

imports
    : /* empty */    { $$ = $this->genEmpty(); }
    | imports import { $$ = $this->catNode($1, $2); }

import
    : IMPORT { $$ = $this->genImport($1); }

operator
    : { $$ = ' '; }
    | '/' s   { $$ = $1; }
    | COMMA s { $$ = $1; }

unary_operator
    : { $$ = ''; }
    | '-' { $$ = $1; }
    | '+' { $$ = $1; }

property
    : IDENT s { $$ = $1; }

rulesets
    : s                { $$ = $this->genEmpty(); }
    | rulesets ruleset { $$ = $this->catNode($1, $2); }

ruleset
    : selector s LBRACE s declarations '}' s              { $$ = $this->genRuleset($1, $5); }
    | selector s LBRACE s last_declaration s              { $$ = $this->genRuleset($1, $5); }
    | selector s LBRACE s declarations last_declaration s { $this->catNode($5, $6); $$ = $this->genRuleset($1, $5); }
    | selector s LBRACE s              '}' s              { $$ = $this->genRuleset($1, null); }
    | command s { $$ = $1; }

selector
    : SELECTOR { $$ = $this->genSelector($1); }

declarations
    : declaration { $$ = $1; }
    | ruleset     { $$ = $1; }
    | declarations declaration { $$ = $this->catNode($1, $2); }
    | declarations ruleset     { $$ = $this->catNode($1, $2); }

declaration
    : property ':' s expr prio ';' s { $$ = $this->genDeclaration($1, $4, $5); }

last_declaration
    : property ':' s expr prio '}'   { $$ = $this->genDeclaration($1, $4, $5); }

prio
    : { $$ = ''; }
    | IMPORTANT_SYM s { $$ = $1; }

expr
    : term               { $$ = $1; }
    | expr operator term { $$ = trim($1) . $2 . trim($3); }

term
    : unary_operator PERCENTAGE s { $$ = $1 . $2; }
    | unary_operator LENGTH s     { $$ = $1 . $2; }
    | unary_operator EMS s        { $$ = $1 . $2; }
    | unary_operator EXS s        { $$ = $1 . $2; }
    | unary_operator ANGLE s      { $$ = $1 . $2; }
    | unary_operator TIME s       { $$ = $1 . $2; }
    | unary_operator FREQ s       { $$ = $1 . $2; }
    | unary_operator NUMBER s     { $$ = $1 . $2; }
    | URI s                       { $$ = $1; }
    | HEXCOLOR s                  { $$ = $1; }
    | IDENT s                     { $$ = $1; }
    | STRING s                    { $$ = $1; }
    | command s                   { $$ = $1; }

s   : | spaces

spaces
    : space
    | spaces space

space : SPACE | NL

command
    : cLDELIM s cCOMMAND s cRDELIM               { $$ = ''; $this->genCommand($3); }
    | cLDELIM s cCOMMAND SPACE cVALUE s cRDELIM  { $$ = ''; $this->genCommand($3, $5); }
    | cLDELIM s cIDENT s cRDELIM                 { $$ = ''; $this->getVar($3); }
    | cLDELIM s cIDENT cEQUAL s cVALUE s cRDELIM { $$ = ''; $this->setVar($3, $6); }

%%
    protected $lastInsertId = 0;
    protected $topNode;
    protected $nodes = array();
    protected $dirStack = array();  // for pushd/popd
    public $vars = array();
    public $debug;
    static public $compress;

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

        $className = 'SCSS_Command_' . ucfirst(strtolower($name));
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
        $content = $this->topNode->publish();
        return rtrim($content, PHP_EOL) . PHP_EOL;
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
    public function isDirStacked() {
        return count($this->dirStack) ? true : false;
    }


    /**
     *
     */
    protected function yyerror($msg) {
        $lineNum = $this->lex->lineNum;
        throw new Exception("$msg at line $lineNum, near by \"" . $this->lex->bufferHead() . '"');
    }
}
