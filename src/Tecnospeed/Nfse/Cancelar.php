<?php

namespace Tecnospeed\Nfse;

/* A rota cancela será utilizada para cancelarmos uma NFS-e que esteja autorizada 
a Prefeitura, a comunicação é síncrona, portanto o retorno da requisição que 
fizermos, será a resposta do SaaS dizendo se a nota foi cancelada ou se não foi cancelada. */

/**
 * Endpoint de cancelar
 * 
 * @link https://managersaas.tecnospeed.com.br:8081/ManagerAPIWeb/nfse/cancela
 * @author Victor Aguiar <victordeaguiarsouza@gmail.com>
 * @copyright (c) 2018
 */
class Cancelar extends \Commons\Endpoint {
    
    /**
     * @return string o nome do endpoint da model 
     */
    public function getEndpoint(){
        
        return 'cancela';
    }    
}