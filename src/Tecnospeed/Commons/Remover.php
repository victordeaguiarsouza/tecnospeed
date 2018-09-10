<?php

namespace Tecnospeed\Commons;

class Remover {

    /**
     * Concatena o nome da cidade com a UF, remove os espaços e os acentos
    */
    public static function caracteresEspeciais($str){
        
        try{
            
            $str = preg_replace('/[áàãâä]/ui', 'a', $str);
            $str = preg_replace('/[éèêë]/ui', 'e', $str);
            $str = preg_replace('/[íìîï]/ui', 'i', $str);
            $str = preg_replace('/[óòõôö]/ui', 'o', $str);
            $str = preg_replace('/[úùûü]/ui', 'u', $str);
            $str = preg_replace('/[ç]/ui', 'c', $str);
 
            return $str;
            
        }catch (\Exception $e){
        
            throw $e;
        }
    } 
    
}