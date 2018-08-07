<?php

namespace Tecnospeed;

/* A rota envia será utilizada para enviarmos um RPS para a prefeitura que irá 
converter em uma NFS-e, a comunicação é síncrona, portanto o retorno da 
requisição que fizermos, será a resposta do SaaS dizendo se a nota foi 
autorizada, rejeitada ou ainda se está em processamento por parte da prefeitura. */

/**
 * Endpoint de enviar nfse
 * 
 * @link https://managersaas.tecnospeed.com.br:8081/ManagerAPIWeb/nfse/envia
 * @author Victor Aguiar <victordeaguiarsouza@gmail.com>
 * @copyright (c) 2018
 */
class Enviar extends \Tecnospeed\Commons\Endpoint {
    
    /**
     * @return string o nome do endpoint da model 
     */
    public function getEndpoint(){
        
        return 'envia';
    }    
}