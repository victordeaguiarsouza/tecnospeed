<?php

namespace Tecnospeed\Nfse;

/* A rota exporta será utilizada para exportar um arquivo .zip do XML e PDF de notas 
enviadas para o SaaS de acordo com um filtro especifico. */

/**
 * Endpoint de exportar
 * 
 * @link https://managersaas.tecnospeed.com.br:8081/ManagerAPIWeb/nfse/exportaxml
 * @author Victor Aguiar <victordeaguiarsouza@gmail.com>
 * @copyright (c) 2018
 */
class Exportar extends \Tecnospeed\Commons\Endpoint {
    
    /**
     * @return string o nome do endpoint da model 
     */
    public function getEndpoint(){
        
        return 'exportaxml';
    }    
}