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
class Resolver extends \Tecnospeed\Commons\Endpoint {
    
    /**
     * @return string o nome do endpoint da model 
     */
    public function getEndpoint(){
        
        return 'resolve';
    }

    protected function responseHandler($response, $data){

        try{

            $resolve        = new \Tecnospeed\Nfse\Responses\ResolveResponse;
            $httpStatusCode = $this->api->getCurl()->httpStatusCode;

            $retorno = explode($this->api->delimiter, $response);
            
            if($retorno[0] == 'EXCEPTION'){

                switch($retorno[1]){
                    case 'EspdAPIWebServerErrorException': throw new \Tecnospeed\Exceptions\EspdAPIWebServerErrorException($this->api->getCurl());
                    default: throw new \Tecnospeed\Exceptions\TecnospeedException($this->api->getCurl());
                }

            }elseif($httpStatusCode == 200 && strpos($retorno[0],'http:') !== false) {

                $resolve->pdfUrl = $retorno[0];
            }else{
            
                $resolve->pdfBinario = $retorno[0];
            }

            $resolve->status     = $httpStatusCode;
            $resolve->handle     = $retorno[0];
            $resolve->numeroLote = $retorno[1];
            $resolve->numeroNFSe = $retorno[2];
            $resolve->mensagem   = $retorno[3];
            $resolve->response   = $response;

            return $resolve;
        }
        catch(\Exception $e){

            throw $e;
        }        
    }

}