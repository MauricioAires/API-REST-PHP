<?php

require_once "../../../../vendor/autoload.php";

# Inicia as funcções basicas utilizado no sistema.
$basicFunctions = new \App\Source\Main;

# Verifica o method
if ($basicFunctions->getMethod() == "GET") {
    # Recebe os dados passado.
    $dados = $basicFunctions->getDadosMethod();

    #Valida os paramentros
    $limit = $basicFunctions->validaParamentros('limit',$dados,INTERGER,false);
    $indice = $basicFunctions->validaParamentros('indice',$dados,INTERGER,false);

    $usuario = new \App\Classes\ClassUsuario;
    #Armazena do dados
    $usuario->setLimit($limit);
    $usuario->setIndice($indice);

    # Inicia a função que retorna os usuarios.
    $usuario->buscarUsuario();

} else {
    $basicFunctions->throwError(METHOD_INVALID, ['message' => "method invalido."]);
}
