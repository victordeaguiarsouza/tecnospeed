<?php

namespace Tecnospeed\Nfse;

/* A rota consulta será utilizada para consultarmos a situação 
do RPS, bem como outras informações dentro do nosso servidor. */

/**
 * Endpoint de consultar
 * 
 * @link https://managersaas.tecnospeed.com.br:8081/ManagerAPIWeb/nfse/consulta
 * @author Victor Aguiar <victordeaguiarsouza@gmail.com>
 * @copyright (c) 2018
 */
class Consultar extends \Commons\Endpoint {
    
    /**
     * @return string o nome do endpoint da model 
     */
    public function getEndpoint(){
        
        return 'consulta';
    }    
}