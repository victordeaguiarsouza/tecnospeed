<?php

namespace Tecnospeed\Commons;

/**
 * Responsável pela comunicação com a api da tecnospeed
 * 
 * @author Victor Aguiar <victordeaguiarsouza@gmail.com>
 * @copyright (c) 2018
*/
class Api {
    
    private $curl;
    private $url;
    private $token;
    private $timeout;
    private $headers = array();

    /**
     * Construtor
     * 
     * @param string $url
     * @param string $token
     * @param int    $timeout
    */
    public function __construct($url, $token, $timeout){

        $this->curl     = new \Curl\Curl();
        $this->url      = $url;
        $this->token    = $token;
        $this->timeout  = $timeout;
    }

    /**
     * Adiciona um item no Header
     * 
     * @param string $key
     * @param string $value
    */
    public function addHeader($key, $value){
        
        if(!empty($key) && !empty($value)){
            $this->headers[$key] = $value;
        }
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
            
            foreach($this->headers as $key => $value){
                
                $this->curl->setHeader($key, $value);
            }

            $this->curl->setConnectTimeout($this->timeout);

            $this->curl->$action($this->url . $endpoint, $data);

            if($this->curl->error) {

                throw new \Tecnospeed\Commons\Exception($this->curl);
            }

            return $this->curl->response;
        }
        catch(\Exception $e){
            
            throw $e;
        }        
    }

    /**
     * Retorna o token
     * 
     * @return $token
    */
    public function getToken(){
        
        return $this->token;
    }
}