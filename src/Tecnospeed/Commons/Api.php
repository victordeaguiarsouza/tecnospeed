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
    private $timeout;
    private $headers = array();
    public  $delimiter;

    /**
     * Construtor
     * 
     * @param string $url
     * @param int    $timeout
    */
    public function __construct($url, $username, $password, $timeout, $delimiter = ','){

        $this->curl      = new \Curl\Curl();
        $this->url       = $url;
        $this->timeout   = $timeout;
        $this->delimiter = $delimiter;

        if(!isset($username) || !isset($password)) throw new \Exception("Usuario e senha do grupo não informado");
        
        $this->addHeader('Content-Type' ,'application/x-www-form-urlencoded');
        
        $this->curl->setOpt(CURLOPT_USERPWD, "$username:$password");
    }

    public function getCurl(){
        return $this->curl;
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
     * Remove um item no Header
     * 
     * @param string $key
     * @param string $value
    */
    public function removeHeader($key){
        
        if(!empty($key)){
            unset($this->headers[$key]);
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

            //Convertendo o encode para UTF-8
            $data['Encode'] = true;

            foreach($this->headers as $key => $value){

                $this->curl->setHeader($key, $value);
            }

            $this->curl->setConnectTimeout($this->timeout);

            $this->curl->$action($this->url . $endpoint, $data);

            if($this->curl->error) {

                throw new \Exception($this->curl->error);
                
                //throw new \Tecnospeed\Exceptions\TecnospeedException($this->curl);
            }

            $this->curl->response    = str_replace('\delimiter', '', utf8_encode($this->curl->response));
            $this->curl->rawResponse = str_replace('\delimiter', '', utf8_encode($this->curl->rawResponse));

            return $this->curl->response;
        }
        catch(\Exception $e){

            throw $e;
        }
    }

}