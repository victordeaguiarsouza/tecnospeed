<?php

namespace Tecnospeed\Nfse;

/**
 * Responsável pela comunicação com a api tecnospeed
 * 
 * @author Victor Aguiar <victordeaguiarsouza@gmail.com>
 * @copyright (c) 2018
 */
class Api {
    
    private $curl;
    private $url;
    private $appToken;
    private $accessToken;
    private $timeout;

    /**
     * Construtor
     * 
     * @param string $url
     * @param string $appToken
     * @param string $accessToken
     * @param int $timeout
     */
    public function __construct($url, $appToken, $accessToken, $timeout){

        $this->curl        = new \Curl\Curl();
        $this->url         = $url;
        $this->appToken    = $appToken;
        $this->accessToken = $accessToken;
        $this->timeout     = $timeout;
    }

    /**
     * Executa um endpoint
     * 
     * @param string $action post|put|get|delete
     * @param string endpoint
     * @param array $data Parâmetros da requisicao
     * @throws \Exception
     * @return string Resposta do serviço
    */
    public function execute($action, $endpoint, $data){
        
        try{
            
            $this->curl->setOpt(CURLOPT_RETURNTRANSFER , true);
            $this->curl->setOpt(CURLOPT_FOLLOWLOCATION , true);
            $this->curl->setOpt(CURLOPT_SSL_VERIFYPEER , false);
            $this->curl->setOpt(CURLOPT_SSL_VERIFYHOST , false);
            
            $this->curl->setHeader('Content-Type' , 'application/x-www-form-urlencoded');
            $this->curl->setHeader('app_token'    , $this->appToken);
            $this->curl->setHeader('access_token' , $this->accessToken);

            $this->curl->setConnectTimeout($this->timeout);

            $this->curl->$action($this->url . $endpoint, $data);

            if($this->curl->error) {

                throw new \Tecnospeed\Nfse\Exception($this->curl);
            }

            return $this->curl->response;
        }
        catch(\Exception $e){
            
            throw $e;
        }        
    }
}