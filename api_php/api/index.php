<?php // github.com/sys4soft

//import output.php
require_once('output.php');

//PREPARAÇÃO DA RESPOSTA
$data['status'] = 'ERROR';//o retorno é erro por padrão
$data['data'] = [];//é preferível um array vazio a um null, que pode causar erros


// ROTAS DA API
if(isset($_GET['option'])){//se houver uma opcão especificada na requisição à API
    switch ($_GET['option']) {
        case 'status':
            api_status($data);
            break;

        case 'random':
            api_random($data);
            break;
        
        case 'hash':
            api_hash($data);
            break;
    }
}

// EMISSÃO DA RESPOSTA
response($data);