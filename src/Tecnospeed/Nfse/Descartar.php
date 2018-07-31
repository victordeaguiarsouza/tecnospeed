<?php

namespace Tecnospeed\Nfse;

/* A rota descarta será utilizada nos casos onde a nota foi rejeitada pela Prefeitura, 
porém precisamos enviar essa nota corrigida utilizando a mesma numeração da nota que 
foi rejeitada anteriormente.
Apenas as notas com situação igual a REJEITADA ou REGISTRADA estarão liberadas para 
serem descartadas. */

/**
 * Endpoint de descartar
 * 
 * @link https://managersaas.tecnospeed.com.br:8081/ManagerAPIWeb/nfse/descarta
 * @author Victor Aguiar <victordeaguiarsouza@gmail.com>
 * @copyright (c) 2018
 */
class Descartar extends Endpoint{
    
    /**
     * @return string o nome do endpoint da model 
     */
    public function getEndpoint(){
        
        return 'descarta';
    }    
}