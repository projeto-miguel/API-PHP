<?php

class Api_logic{
    // ===============================================================
    // PROPERTIES
    // ===============================================================
    private $endpoint;
    private $params;

    // ===============================================================
    // CONSTRUCTOR
    // ===============================================================
    public function __construct($endpoint, $params = null){
        $this->endpoint = $endpoint;
        $this->params = $params;
    }

    // ===============================================================
    public function check_endpoint(){// verifica se o endpoint recebido é valido
        return method_exists($this, $this->endpoint);// função nativa para checar se o endpoint existe no contexto atual
    }













    // ===============================================================
    // METHODS FOR EACH ENDPOINT
    // ===============================================================

    public function status(){
        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK',
            'results' => null
        ];
    }

    public function get_all_clients(){

        $db = new database();
        $results = $db->EXE_QUERY('SELECT * FROM clientes');

        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK',
            'results' => $results
        ];
    }
    public function get_all_products(){

        $db = new database();
        $results = $db->EXE_QUERY('SELECT * FROM produtos');

        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK',
            'results' =>  $results
        ];
    }
}