<?php


// ENVIA A REQUISIÇÃO PARA A API COM BASE NO MÉTODO E RETORNA A RESPOSTA
function api_request($endpoint, $method, $variables = []){

    $client = curl_init();

    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);// a resposta virá em string

    $url = API_BASE_URL;

    if($method == 'GET'){
        $url .= "?endpoint=$endpoint";//se for get, adicione a variavel endpoint à url  
        if(!empty($variables)){
            $url .= "&" . http_build_query($variables);//função nativa para construir a url com as variaveis
        }
    }else if($method == 'POST'){
        $variables = array_merge(['endpoint' => $endpoint], $variables);//adiciona o endpoint às variáveis, dentro da chave 'endpoint'
        curl_setopt($client, CURLOPT_POSTFIELDS, $variables);//envia as variáveis como campos do metodo POST
    }else{
        echo "APP: Método não reconhecido: " . $method;
    }

    curl_setopt($client, CURLOPT_URL, $url);//definindo a url para enviar a resposta

    $response = curl_exec($client);//envia a requisição para a api e retorna a resposta

    return json_decode($response, true);//true para retornar atraves de um array associativo
}