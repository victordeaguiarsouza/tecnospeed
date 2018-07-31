<?php

namespace Tecnospeed\Nfse;

/* A rota resolve será utilizada nos casos onde a Prefeitura está passando por 
instabilidades, pois imagine a seguinte situação, enviamos um RPS, porém o 
WebService deles estava muito lento e não nos trouxe a resposta do envio, 
ou seja, o SaaS não tem a situação oficial dela, se ela está autorizada ou rejeitada.
Neste caso, ao utilizar o resolve, o SaaS tentará efetuar a consulta dessa 
nota e atualizar a situação dela no SaaS. */

/**
 * Endpoint de resolver
 * 
 * @link https://managersaas.tecnospeed.com.br:8081/ManagerAPIWeb/nfse/resolve
 * @author Victor Aguiar <victordeaguiarsouza@gmail.com>
 * @copyright (c) 2018
 */
class Resolver extends Endpoint{
    
    /**
     * @return string o nome do endpoint da model 
     */
    public function getEndpoint(){
        
        return 'resolve';
    }    
}