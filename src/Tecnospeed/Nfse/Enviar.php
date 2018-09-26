<?php

namespace Tecnospeed\Nfse;

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

    /**
     * @return string o nome do endpoint da model 
     */
    protected function responseHandler($response, $data){

        try{

            $retorno = explode($this->api->delimiter, $response);
            
            if($retorno[0] == 'EXCEPTION'){

                switch($retorno[1]){
                    case 'EspdManNFSeJaExisteException'             : throw new \Tecnospeed\Exceptions\EspdManNFSeJaExisteException($this->api->getCurl());
                    case 'EspdManNFSeScriptsConverterException'     : throw new \Tecnospeed\Exceptions\EspdManNFSeScriptsConverterException($this->api->getCurl());
                    case 'EspdManNFSeNaoSuportadoNoPadraoException' : throw new \Tecnospeed\Exceptions\EspdManNFSeNaoSuportadoNoPadraoException($this->api->getCurl());
                    default: throw new \Tecnospeed\Exceptions\TecnospeedException($this->api->getCurl());
                }

            }else{

                if(strpos($retorno[3], 'Rejeitada') !== false){
                    
                    throw new \Tecnospeed\Exceptions\RejeicaoException($this->api->getCurl());
                }

            }

            $envio = new \Tecnospeed\Nfse\Responses\EnviaResponse;
    
            $envio->status     = $this->api->getCurl()->httpStatusCode;
            $envio->handle     = $retorno[0];
            $envio->nlote      = $retorno[1];
            $envio->nnfse      = $retorno[2];
            $envio->mensagem   = $retorno[3];
            $envio->response   = $response;

            return $envio;
        }
        catch(\Exception $e){
            
            throw $e;
        }        
    }
}