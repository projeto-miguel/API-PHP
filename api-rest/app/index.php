<?php



// DEPENDENCIES ====================
require_once("inc/config.php");
require_once("inc/api_functions.php");

echo '<pre>';

$results = api_request('get_all_active_clients','GET');
print_r($results);
echo '========================================================================================<br>';
$results = api_request('get_all_inactive_clients','GET');
print_r($results);
echo '========================================================================================<br>';
$results = api_request('get_client_by_ddd','GET',['ddd' => 2]);
print_r($results);