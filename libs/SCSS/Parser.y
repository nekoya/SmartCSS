/*
 * SmartCSS yacc
 */

%{
//<?php
%}
%token LBRACE '}' SPACE
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

unary_operator
    : { $$ = ''; }
    | '-' { $$ = $1; }
    | '+' { $$ = $1; }

property
    : IDENT s { $$ = $1; }

rulesets
    : ruleset { $$ = $1; }
    | rulesets ruleset { $$ = $this->catNode($1, $2); }

ruleset
    : selectors LBRACE s declarations '}' s { $$ = $this->genRuleset($1, $4); }
    | command s { $$ = $1; }

selectors
    : selector { $$ = $1; }
    | selectors COMMA s selector { $$ = $this->catNode($1, $4); }

selector
    : SELECTOR { $$ = $this->genSelector($1); }
//    | command

declarations
    : declaration { $$ = $1; }
    | ruleset { $$ = $1; }
    | declarations declaration { $$ = $this->catNode($1, $2); }
    | declarations ruleset     { $$ = $this->catNode($1, $2); }
//    | declarations followdecl { $$ = cat($1, $2); }

/*
followdecl
    : ';' s
    | ';' s declaration { $$ = $3; }
*/

declaration
    : property ':' s expr ';' s { $$ = $this->genDeclaration($1, $4); }
//    : property ':' s expr { $$ = gen('declaration', $1, $4); }

expr
    : term      { $$ = $1; }
    | expr term { $$ = trim($1) . ' ' . trim($2); }

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
    | HEXCOLOR                    { $$ = $1; }
    | IDENT s                     { $$ = $1; }
    | STRING s                    { $$ = $1; }
    | command s                   { $$ = $1; }

s : | SPACE

command
    : cLDELIM s cCOMMAND s cRDELIM               { $$ = $this->genCommand($3); }
    | cLDELIM s cCOMMAND SPACE cVALUE cRDELIM    { $$ = $this->genCommand($3, $5); }
    | cLDELIM s cIDENT s cRDELIM                 { $$ = ''; $this->getVar($3); }
    | cLDELIM s cIDENT cEQUAL s cVALUE s cRDELIM { $$ = ''; $this->setVar($3, $6); }

%%
    protected $lastInsertId = 0;
    protected $topNode;
    protected $nodes = array();
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
    public function genCommand($name, $value = null) {
        $className = 'SCSS_Command_' . ucfirst($name);
        // calling autoload deters Fatal error with load class
        try {
            AutoLoader::autoload($className);
        } catch (Exception $e) {
            throw new Exception("Command not found: $name");
        }
        $command = new $className($value);
        $command->execute();
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
                $this->lex->lexbuf = $this->vars[$var] . $this->lex->lexbuf;
            }
            return $this->vars[$var];
        }
    }
}
