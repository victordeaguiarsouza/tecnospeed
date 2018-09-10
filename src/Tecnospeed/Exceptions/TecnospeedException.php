<?php

namespace Tecnospeed\Exceptions;

class TecnospeedException extends \Exception implements TecnospeedThrowable {
    
    public $request;

    /**
     * Construtor
     * 
     * @param \Curl\Curl $request
     */
    public function __construct(\Curl\Curl $request){
        
        throw new \Exception($request->response, 700);
        
        $this->request = $request;
    }
}