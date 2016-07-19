<?php

namespace UtilBundle\lib;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class StringTools {

    const PERSON_NOT_FOUND = 'Persona no Encontrada';
    const DOCUMENT_NOT_FOUND = 'Documento no Encontrado';

    static function truncate($text, $length = 20) {
        return substr($text, 0, $length) . '...';
    }

    public static function getBracketString($string) {
        return '(' . $string . ')';
    }
    
    public static function usernamealize($string){
        return str_replace(' ','.', strtolower($string));
    }
    

}

?>
