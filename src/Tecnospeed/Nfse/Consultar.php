<?php

namespace Tecnospeed\Nfse;

/* A rota consulta será utilizada para consultarmos a situação 
do RPS, bem como outras informações dentro do nosso servidor. */

/**
 * Endpoint de consultar
 * 
 * @link https://managersaas.tecnospeed.com.br:8081/ManagerAPIWeb/nfse/consulta
 * @author Victor Aguiar <victordeaguiarsouza@gmail.com>
 * @copyright (c) 2018
 */
class Consultar extends \Tecnospeed\Commons\Endpoint {

    /**
     * @return string o nome do endpoint da model 
     */
    public function getEndpoint(){

        return 'consulta';
    }

    protected function responseHandler($response, $data){

        try{

            $consulta       = new \Tecnospeed\Nfse\Responses\ConsultaResponse;
            $httpStatusCode = $this->api->getCurl()->httpStatusCode;

            $linhasRetorno = explode("\r\n", $response);

            $consulta->status  = $httpStatusCode;
            $consulta->retorno = $consulta->formatarRetorno($linhasRetorno, $data, $this->api->delimiter);

            return $consulta;
        }
        catch(\Exception $e){

            throw $e;
        }        
    }
}