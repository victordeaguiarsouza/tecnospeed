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
class Descartar extends \Tecnospeed\Commons\Endpoint {
    
    /**
     * @return string o nome do endpoint da model 
     */
    public function getEndpoint(){
        
        return 'descarta';
    }

    protected function responseHandler($response, $data){

        try{

            $descarta        = new \Tecnospeed\Nfse\Responses\DescartaResponse;
            $httpStatusCode = $this->api->getCurl()->httpStatusCode;

            $retorno = explode($this->api->delimiter, $response);
            
            if($retorno[0] == 'EXCEPTION'){

                switch($retorno[1]){
                    case 'EspdAPIWebServerErrorException' : throw new \Tecnospeed\Exceptions\EspdAPIWebServerErrorException($this->api->getCurl());
                    case 'EspdManNFSeCheckParamsException': throw new \Tecnospeed\Exceptions\EspdManNFSeCheckParamsException($this->api->getCurl());
                    default: throw new \Tecnospeed\Exceptions\TecnospeedException($this->api->getCurl());
                }

            }elseif($httpStatusCode == 200 && strpos($retorno[0],'http:') !== false) {

                $descarta->pdfUrl = $retorno[0];
            }else{
            
                $descarta->pdfBinario = $retorno[0];
            }

            $descarta->status     = $httpStatusCode;
            $descarta->ok         = $retorno[0];
            $descarta->mensagem   = $retorno[1];
            $descarta->response   = $response;

            return $descarta;
        }
        catch(\Exception $e){

            throw $e;
        }        
    }

}