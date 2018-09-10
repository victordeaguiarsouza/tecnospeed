<?php

namespace Tecnospeed\Exceptions;

class EspdManNFSeCheckParamsException extends \Exception implements TecnospeedThrowable {

    public function __construct(\Curl\Curl $request){

        $delimiter = ( strpos($request->response, '|') !== false )? '|' : ',';

        $retorno = explode($delimiter, $request->response);

        parent::__construct($retorno[2], 707);

        $this->request = $request;
    }
}