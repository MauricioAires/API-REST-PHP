<?php

require_once "../../../../vendor/autoload.php";

# Inicia as funcções basicas do sistema.
$basicFunctions = new \App\Source\Main;

# Verifica o method

if($basicFunctions->getMethod() == "GET"){
    # Armazena os dados passado.
    $dados = $basicFunctions->getDadosMethod();

    #Valida os paramentros.
    $token = $basicFunctions->validaParamentros('token',$dados,STRING);

    $auth = new \App\Classes\ClassAuth;
    $auth->setToken($token);
    
    # Iniciar função para decodificar o token
    $auth->getDadosToken();

}else{
    $basicFunctions->throwError(METHOD_INVALID,["message" => "Method invalid."]);
}