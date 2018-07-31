<?php

namespace Tecnospeed\Nfse;

/* A rota imprime será utilizada para gerarmos um PDF de uma NFS-e. */

/**
 * Endpoint de imprimir
 * 
 * @link https://managersaas.tecnospeed.com.br:8081/ManagerAPIWeb/nfse/imprime
 * @author Victor Aguiar <victordeaguiarsouza@gmail.com>
 * @copyright (c) 2018
 */
class Imprimir extends Endpoint{
    
    /**
     * @return string o nome do endpoint da model 
     */
    public function getEndpoint(){
        
        return 'imprime';
    }    
}