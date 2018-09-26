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
class Cancelar extends \Tecnospeed\Commons\Endpoint {
    
    /**
     * @return string o nome do endpoint da model 
     */
    public function getEndpoint(){
        
        return 'cancela';
    }


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
                }

            }

            $cancela = new \Tecnospeed\Nfse\Responses\CancelaResponse;
    
            $cancela->status     = $this->api->getCurl()->httpStatusCode;
            $cancela->handle     = $retorno[0];
            $cancela->nnfse      = $retorno[1];
            $cancela->protocolo  = $retorno[2];
            $cancela->mensagem   = $retorno[3];
            $cancela->response   = $response;

            return $cancela;
        }
        catch(\Exception $e){
            
            throw $e;
        }        
    }
}