<?php
// ==========================================================================
// FUNÇÕES PARA CADA ENDPOINT
// ==========================================================================
function api_random(&$data){ 
    $min = 0;
    $max = 1000;

    if(isset($_GET['min'])){
        $min = intval($_GET['min']);
    }
    if(isset($_GET['max'])){
        $max = intval($_GET['max']);
    }

    if($min>=$max){
        response($data);//retorna erro, pois nao chega ao define_response
        die();
    }
    define_response($data, rand($min, $max));
}

// ==========================================================================
function api_status(&$data){    
    define_response($data, 'API OK');
}

// ==========================================================================
function api_hash(&$data){
    define_response($data, md5(sha1(uniqid())));
}

// ==========================================================================
function define_response(&$data, $value){//referencia o $data que foi definido no escopo global
    $data['status'] = 'SUCCESS';
    $data['data'] = $value;
}

// ==========================================================================
// ======== CONSTRUÇÃO DA RESPONSE =========
function response($data_response){
    header("Content-Type:application/json");//a resposta irá em formato JSON
    echo json_encode($data_response);
}