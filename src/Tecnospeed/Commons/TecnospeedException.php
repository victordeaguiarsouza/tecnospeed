<?php

namespace Tecnospeed\Commons;

class TecnospeedException extends \Exception {
    
    public $request;

    /**
     * Construtor
     * 
     * @param \Curl\Curl $request
     */
    public function __construct(\Curl\Curl $request){

        $this->request = $request;
    }
}