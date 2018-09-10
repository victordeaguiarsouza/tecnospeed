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
class Imprimir extends \Tecnospeed\Commons\Endpoint {
    
    /**
     * @return string o nome do endpoint da model 
     */
    public function getEndpoint(){
        
        return 'imprime';
    }

    /**
     * @return string o nome do endpoint da model 
     */
    protected function responseHandler($response, $data){

        try{

            $imprime        = new \Tecnospeed\Nfse\Responses\ImprimeResponse;
            $httpStatusCode = $this->api->getCurl()->httpStatusCode;

            $retorno = explode($this->api->delimiter, $response);
            
            if($retorno[0] == 'EXCEPTION'){

                switch($retorno[1]){
                    case 'EspdAPIWebServerErrorException': throw new \Tecnospeed\Exceptions\EspdAPIWebServerErrorException($this->api->getCurl());
                    default: throw new \Tecnospeed\Exceptions\TecnospeedException($this->api->getCurl());
                }

            }elseif($httpStatusCode == 200 && strpos($retorno[0],'http:') !== false) {

                $imprime->pdfUrl = $retorno[0];
            }else{
            
                $imprime->pdfBinario = $retorno[0];
            }

            $imprime->status   = $httpStatusCode;
            $imprime->response = $response;

            return $imprime;
        }
        catch(\Exception $e){

            throw $e;
        }        
    }

}