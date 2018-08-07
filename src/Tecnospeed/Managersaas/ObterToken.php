<?php

namespace Tecnospeed\Managersaas;

/**
 * Endpoint de descartar
 * 
 * @link https://managersaas.tecnospeed.com.br:1337/api/v1/software-house/token
 * @author Victor Aguiar <victordeaguiarsouza@gmail.com>
 * @copyright (c) 2018
 */
class ObterToken extends \Tecnospeed\Commons\Endpoint {

    /**
     * @return string o nome do endpoint da model 
    */
    public function getEndpoint(){
        
        return 'software-house/token';
    }    
}