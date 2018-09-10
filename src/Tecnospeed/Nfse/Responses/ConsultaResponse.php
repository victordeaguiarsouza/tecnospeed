<?php

namespace Tecnospeed\Nfse\Responses;

class ConsultaResponse {

    public function formatarRetorno($linhasRetorno, $data, $delimiter){
        
        $retorno = [];

        $countLinhas = count($linhasRetorno);

        foreach ($linhasRetorno as  $value) {            
            $linhas[] = explode($delimiter, $value);
        }

        $campos      = explode(",", $data['Campos']);
        $countCampos = count($campos);

        for ($i=0; $i < $countLinhas; $i++) { 
            for ($j=0; $j < $countCampos; $j++) { 
                
                $retorno[$i][trim($campos[$j])] = $linhas[$i][$j];

            }
        }

        return $retorno;

    }

}
