<?php

namespace Tecnospeed\Commons;

/**
 * Define os comportamentos básicos de um endpoint na api
 * 
 * @author Victor Aguiar <victordeaguiarsouza@gmail.com>
 * @copyright (c) 2018
*/
abstract class Endpoint {
    
    protected $api;
    protected $queryString;

    /**
     * @return string o nome do endpoint da model 
     */
    abstract public function getEndpoint();

    /**
     * Construtor.
     * 
     * @param \Tecnospeed\Commons\Api $api
    */
    public function __construct(\Tecnospeed\Commons\Api $api){

        $this->api = $api;
    }

    /**
     * Insere um dado no endpoint
     * 
     * @param array $data = null Parâmetros da requisição
     * @return object Resposta do serviço
    */
    public function post($data = null){
        
        try{
            
            return $this->api->execute('post', $this->getEndpoint(), $data);
        }
        catch(\Exception $e){
            
            throw $e;
        }        
    }

    /**
     * Consulta por registros no endpoint
     * 
     * @param array $data = null Parâmetros da requisição
     * @return object Resposta do serviço
    */
    public function get($data = null){
        
        try{
            
            return $this->api->execute('get', $this->getEndpoint(), $data);
        }
        catch(\Exception $e){
            
            throw $e;
        }        
    }

    /**
     * Edita um dado no endpoint
     * 
     * @param array $id = identificador do registro
     * @param array $data = null Parâmetros da requisição
     * @return object Resposta do serviço
    */
    public function put($id, $data = null){
        
        try{
            
            return $this->api->execute('put', $this->getEndpoint() . "/$id", $data);
        }
        catch(\Exception $e){
            
            throw $e;
        }        
    }

}