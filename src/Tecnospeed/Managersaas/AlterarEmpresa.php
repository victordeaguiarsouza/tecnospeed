<?php

namespace Tecnospeed\Managersaas;

/**
 * Endpoint para alterar cadastro de empresa
 * 
 * @link https://managersaas.tecnospeed.com.br:1337/api/v1/empresa/{{idEmpresa}}
 * @author Victor Aguiar <victordeaguiarsouza@gmail.com>
 * @copyright (c) 2018
 */
class AlterarEmpresa extends \Tecnospeed\Commons\Endpoint {
    
    /**
     * @return string o nome do endpoint da model 
    */
    public function getEndpoint(){
        
        return "empresa";
    }    
}