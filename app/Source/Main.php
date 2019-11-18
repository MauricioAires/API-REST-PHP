<?php

namespace App\Source;

class Main
{


    public function throwError($code, $data)
    {
        echo json_encode(["status" => $code, "error" => [$data]]);
        exit;
    }


    public function returnResponse($code, $data)
    {
        echo json_encode(["status" => $code, "data" =>  $data]);
        exit;
    }

    /**
     *  Função para retonar o method da requisição.
     * @example POST,GET,PUT
     */
    public function getMethod()
    {
        $method =  $_SERVER['REQUEST_METHOD'];

        return $method;
    }
    /**
     *  Função para retornar os dados passado na requisição.
     *  @param string $methodo
     */

    public function getDadosMethod()
    {



        return json_decode(file_get_contents('php://input'), true);
    }

    /**
     * Função para validar os paramentros .
     * @param string $name nome do paramentro.
     * @param int $data todo o array passado via paramentro.
     * @param mixed $dataType dados do paramentro
     * @param bool $required o parametro e required or não.
     * 
     * @return mixed $value
     */
    public function validaParamentros($name, $data, $dataType, $required = true)
    {

        #Verifica se o paramentro required está vazio.
        if ($required == true && empty($data["$name"])) {
            $this->throwError(METHOD_REQUIRED, ["message" => $name . " paramentro is required."]);
        }

        #Verifica se o paramentro não é necessario, se não for e estiver vazio ele retorna null.
        if ($required == false && empty($data["$name"])) {
            return;
        }

        # Valor do parametro
        $value = $data["$name"];


        #Verifca se o dado corresponde o type do paramentro
        switch ($dataType) {
            case INTERGER:


                if (!is_numeric($value)) {
                    $this->throwError(DATATYPE_INVALID, ["message" => $name . " o paramentro é do tipo numerico"]);
                }
                break;
            case BOOLEAN:
                if (!is_bool($value)) {
                    $this->throwError(DATATYPE_INVALID, ["message" => $name . " o paramentro é do tipo boleano"]);
                }
                break;
            case STRING:
                if (!is_string($value)) {
                    $this->throwError(DATATYPE_INVALID, ["message" => $name . " o paramentro é do tipo string"]);
                }
                break;

            default:
                $this->throwError(DATATYPE_INVALID, ["message" => " Paramentro invalido."]);
                break;
        }

        return $value;
    }
}
