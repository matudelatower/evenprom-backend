<?php

namespace UtilBundle\lib\doctrine;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
 
/**
 * ParseDateToChar = "to_char" "(" ArithmeticPrimary "," ArithmeticPrimary ")"
 * Based to Benjamin Eberlei <kontakt@beberlei.de>
 * 
 * @package         DoctrineCustomFunctions
 * @subpackage      Postgres Custom Functions for Doctrine 2
 * @author          Maycol Alvarez<maycolalvarez@gmail.com>
 * @copyright       Maycol ALvarez
 * @license         http://www.gnu.org/licenses/gpl-1.0.html
 * @version         v1.0 28/09/2011 12:00 PM
 */
class ParseDateToChar extends FunctionNode
{
    // define las partes de la funcion
    public $firstDateExpression = null;
    public $secondStringExpression = null;
 
    // pasear la funcion y establecer las partes
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->firstDateExpression = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->secondStringExpression = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
 
    // devuelve el sql nativo
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return 'to_char(' .
            $this->firstDateExpression->dispatch($sqlWalker) . ', ' .
            $this->secondStringExpression->dispatch($sqlWalker) .
        ')';
    }
}