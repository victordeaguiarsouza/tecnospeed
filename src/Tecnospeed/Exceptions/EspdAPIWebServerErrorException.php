<?php

namespace Tecnospeed\Exceptions;

class EspdAPIWebServerErrorException extends \Exception implements TecnospeedThrowable {
    

    public function __construct(\Curl\Curl $request){

        $delimiter = ( strpos($request->response, '|') !== false )? '|' : ',';

        $retorno = explode($delimiter, $request->response);

        parent::__construct($retorno[2], 703);
        
        $this->request = $request;
    }
}