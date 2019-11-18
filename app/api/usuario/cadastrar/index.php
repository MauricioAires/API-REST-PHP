<?php

# Inicia o autoload
require '../../../../vendor/autoload.php';



# Inclui as funções basicas que são utilizadas no sistema.
$basicFunctions = new \App\Source\Main;



# Verifica o metodo, POST unico permitido 
$metodo = $basicFunctions->getMethod();



if ($metodo == 'POST') {
       # Recebe os dados passado
       $dados = $basicFunctions->getDadosMethod();

    # Validação de paramentros
    $name = $basicFunctions->validaParamentros('name', $dados, STRING);
    $email = $basicFunctions->validaParamentros('email', $dados, STRING);
    $password = $basicFunctions->validaParamentros('password', $dados, STRING);
    $active = $basicFunctions->validaParamentros('active', $dados, INTERGER);


    $usuario = new \App\Classes\ClassUsuario;
    #Armazenar paramentros
    $usuario->setName($name);
    $usuario->setEmail($email);
    $usuario->setPassword($password);
    $usuario->setActive($active);

    # Inicia a função de cadastar usuario;
    $usuario->cadastrarUsuario();

    $basicFunctions->returnResponse(SUCCESS_RESPONSE, ["message" => "Sucesso ao cadastrar usuario."]);
} else {
    $basicFunctions->throwError(METHOD_INVALID, ['message' => 'method invalido']);
}
