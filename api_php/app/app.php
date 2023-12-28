<?php

define('API_BASE', 'http://localhost/api_php/api/index.php?option=');//define o caminho da api

echo 'APLICAÇÂO' . '<hr>';

for($i=0;$i<10;$i++){
    $requisicao = api_request('hash');

    if($requisicao['status'] == 'ERROR'){
        die('Ocorreu um erro na requisição da API.');
    }

    echo 'Valor gerado: ' . $requisicao['data'] . '<br>';
}


/* 
echo '<pre>';//formata o texto do array
print_r($requisicao); */

function api_request($option){
    $client = curl_init(API_BASE . $option);//inicializa a sessão curl
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);//define que a resposta será em formato string
    $response = curl_exec($client);//executa a requisição e obtem a variável $data da API
    return json_decode($response, true);//converte a respota da API para um array associativo
}