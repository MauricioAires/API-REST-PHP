<?php

namespace App\Classes;

use \Firebase\JWT\JWT;



class ClassAuth
{

    # Atributos locais 
    private $token;
    # Variavel que armazena os dados que iram ser salvos no token
    private $dados;
    # Atributos globais
    private $dbConnect;
    private $basicFunctions;

    public function __construct()

    {
        # Conexão com o banco
        $connection = new \App\Source\Connection;
        $this->dbConnect = $connection;

        # Carregar as funcções basicas do sistema
        $basicFunctions = new \App\Source\Main;
        $this->basicFunctions = $basicFunctions;
    }


    # Metods GET - SET
    public function getToken()
    {
        return $this->token;
    }
    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getDados()
    {
        return $this->dados;
    }
    public function setDados($dados)
    {
        $this->dados = $dados;
    }


    # Metodos.
    public function gerarToken()
    {
        try {

            $data = array(
                "iss" => time(),
                "exp" => time() + 100,
                "data" => $this->dados
            );

            # Inicia a função para criar o token 
            $jwt = JWT::encode($data, SECRET_KEY);

            $this->basicFunctions->returnResponse(SUCCESS_RESPONSE, ["token" => $jwt]);
        } catch (\Exception $ex) {
            $this->basicFunctions->throwError(JWT_ERROR, $ex->getMessage());
        }
    }

    public function getDadosToken()
    {


        try {

            $dados = JWT::decode($this->token, SECRET_KEY, array('HS256'));

            $this->basicFunctions->returnResponse(SUCCESS_RESPONSE, $dados);
        } catch (\Exception $ex) {
            $this->basicFunctions->throwError(JWT_ERROR, $ex->getMessage());
        }
    }
}


// ************* ANOTAÇÃO *************\\
/**
 *  iss => issued at ( emitido em), armazena o horario que o token for criado.
 *  exp => expiratiom time ( tempo de expliração ), armazena o tempo de expiração do token.
 *  
 * 
 */
