<?php

require_once '../../../../vendor/autoload.php';

# Iniciar as funcões basicas do sistema
$basicFunctions = new \App\Source\Main;

# Verifica se o method é valido 
if ($basicFunctions->getMethod() == "DELETE") {

    # Recebe os dados passado
    $dados = $basicFunctions->getDadosMethod();
    # Valida os paramentros

    
    $id = $basicFunctions->validaParamentros('id',$dados, INTERGER);

    $usuario = new \App\Classes\ClassUsuario;
    $usuario->setId($id);

    # Inicia a funcção de deletar Usuario
    $usuario->deletarUsuario();

    $basicFunctions->returnResponse(SUCCESS_RESPONSE, ["message" => "Usuario deletado com sucesso."]);
} else {
    $basicFunctions->throwError(METHOD_INVALID, ["message" => "method invalido."]);
}
