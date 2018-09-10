<?php

namespace Tecnospeed\Exceptions;

class EspdManNFSeConfigException extends \Exception implements TecnospeedThrowable {
    

    public function __construct(\Curl\Curl $request){

        $delimiter = ( strpos($request->response, '|') !== false )? '|' : ',';

        $retorno = explode($delimiter, $request->response);

        parent::__construct($retorno[2], 704);
        
        $this->request = $request;
    }
}