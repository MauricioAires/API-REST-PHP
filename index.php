<?php

/**
* 
*   DELETE
*   $request = array("id" => "66");
*   
*    INSERIR
*    $request = array("name" => "Ananda","email" => "ananda@gmail.com","password" => "masdbasd","active" => 1);
*/


$curl = curl_init();

$request = array("token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOjE1NzQwODE3NTAsImV4cCI6MTU3NDA4MTg1MCwiZGF0YSI6eyJsaW1pdCI6MTAsImluZGljZSI6MH19.5ZOJPpTKjRYTqfjD1oEdJ3cLBO1bR5UCxfkvZSgZYfg");


curl_setopt_array($curl, array(
    CURLOPT_URL => "http://localhost/composer/app/api/usuario/auth/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => json_encode($request),
    CURLOPT_HTTPHEADER => array(
        "content-type: application/json"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "Curl Error #:" . $err;
} else {
    echo $response;
}
