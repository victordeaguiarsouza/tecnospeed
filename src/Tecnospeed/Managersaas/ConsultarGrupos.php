<?php

namespace Tecnospeed\Managersaas;

/**
 * Endpoint de descartar
 * 
 * @link https://managersaas.tecnospeed.com.br:1337/api/v1/grupo?token={$this->api->getToken()}/token&skip=0&limit=10&sort=identificacao
 * @author Victor Aguiar <victordeaguiarsouza@gmail.com>
 * @copyright (c) 2018
 */
class CadastrarEmpresa extends \Commons\Endpoint {
    
    /**
     * @return string o nome do endpoint da model 
    */
    public function getEndpoint(){
        
        return "grupo";
    }    
}