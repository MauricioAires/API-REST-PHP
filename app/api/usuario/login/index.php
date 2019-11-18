<?php

require_once "../../../../vendor/autoload.php";

# Inicia as funcções basicas do sistema.
$basicFunctions = new \App\Source\Main;

# Verifica o method

if($basicFunctions->getMethod() == "GET"){
    # Armazena os dados passado.
    $dados = $basicFunctions->getDadosMethod();

    #Valida os paramentros.
    
    $auth = new \App\Classes\ClassAuth;
    $auth->setDados($dados);
    
    # Iniciar função para gerar o token
    $auth->gerarToken();

}else{
    $basicFunctions->throwError(METHOD_INVALID,["message" => "Method invalid."]);
}