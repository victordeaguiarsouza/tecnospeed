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

    /**
     * @return string o nome do endpoint da model 
    */
    protected function responseHandler($response, $data){

        try{

            $retorno = explode($this->api->delimiter, $response);
            
            if($retorno[0] == 'EXCEPTION'){

                switch($retorno[1]){
                    case 'EspdManNFSeConfigException': throw new \Tecnospeed\Exceptions\EspdManNFSeConfigException($this->api->getCurl());
                    default: throw new \Tecnospeed\Exceptions\TecnospeedException($this->api->getCurl());
                }

            }else{

                if(strpos($retorno[3], 'Rejeitada') !== false){
                    
                    throw new \Tecnospeed\Exceptions\RejeicaoException($this->api->getCurl());
                }else if(strpos($retorno[0], 'OK')){
                    throw new \Tecnospeed\Exceptions\TecnospeedException($this->api->getCurl());
                }

            }

            $envio = new \Tecnospeed\Nfse\Responses\EnviaResponse;
    
            $envio->status   = $this->api->getCurl()->httpStatusCode;
            $envio->url      = $retorno[0];
            $envio->response = $response;

            return $envio;
        }
        catch(\Exception $e){
            
            throw $e;
        }        
    }
}