<?php

namespace Tecnospeed\Commons;

class Exception extends \Exception {
    
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