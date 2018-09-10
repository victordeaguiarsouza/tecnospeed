<?php

namespace Tecnospeed\Exceptions;

class RejeicaoException extends \Exception implements TecnospeedThrowable {
    

    public function __construct(\Curl\Curl $request){

        $delimiter = ( strpos($request->response, '|') !== false )? '|' : ',';

        $retorno = explode($delimiter, $request->response);

        parent::__construct($retorno[3], 702);
        
        $this->request = $request;
    }

}