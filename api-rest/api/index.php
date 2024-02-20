<?php

// DEPENDENCIES
require_once(dirname(__FILE__) ."/inc/config.php");
require_once(dirname(__FILE__) ."/inc/api_response.php");
require_once(dirname(__FILE__) ."/inc/api_logic.php");
require_once(dirname(__FILE__) ."/inc/database.php");


// ===============================================================
// INSTANTIATE THE API CLASS
$api_response = new Api_response();


// ===============================================================
// CHECK IF METHOD IS VALID
if(!$api_response->check_method($_SERVER['REQUEST_METHOD'])){
    $api_response->api_request_error('MÉTODO DE REQUISIÇÃO INVÁLIDO: ' . $_SERVER['REQUEST_METHOD']);
}


// ===============================================================
// SET REQUEST METHOD & GET PARAMS FROM REQUISITION
$api_response->set_method($_SERVER['REQUEST_METHOD']);
$params = null;

if($api_response->get_method() == 'GET'){
    $api_response->set_endpoint($_GET['endpoint']);
    $params = $_GET;
}else if($api_response->get_method() == 'POST'){
    $api_response->set_endpoint($_POST['endpoint']);
    $params = $_POST;
}


// ===============================================================
// INSTANTIATE API LOGIC
$api_logic = new Api_logic($api_response->get_endpoint(), $params);

// ===============================================================
// CHECK IF ENDPOINT EXISTS
if(!$api_logic->check_endpoint()){
    $api_response->api_request_error('ENDPOINT DOES NOT EXIST: ' . $api_response->get_endpoint());
}

// REQUEST TO THE API_LOGIC
$result = $api_logic->{$api_response->get_endpoint()}();//executa o método correspondente ao endpoint
$api_response->add_to_data('data', $result);

$api_response->send_response();
// $api_response->send_api_status();


