<?php

#Requisição para uma url invalida

echo json_encode(["code" => 400, "error" => ["message" => "Requisição feita para uma url invalida"]]);
