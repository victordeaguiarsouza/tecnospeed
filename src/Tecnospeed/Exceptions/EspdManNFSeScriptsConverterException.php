<?php

namespace Tecnospeed\Exceptions;

class EspdManNFSeScriptsConverterException extends \Exception implements TecnospeedThrowable {
    

    public function __construct(\Curl\Curl $request){

        $delimiter = ( strpos($request->response, '|') !== false )? '|' : ',';

        $retorno = explode($delimiter, $request->response);

        parent::__construct($retorno[2], 705);
        
        $this->request = $request;
    }
}