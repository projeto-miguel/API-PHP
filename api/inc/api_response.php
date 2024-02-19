<?php

// CLASSE COM MÉTODOS PARA CONSTRUIR E RETORNAR O CORPO DA RESPOSTA
class Api_response{
    
    // ===============================================================
    // PROPERTIES
    private $data;
    private $available_methods = ['GET','POST'];
    
    // ===============================================================
    // CONSTRUCTOR
    public function __construct(){//construtor
        $this->data = [];
    }

    // ===============================================================
    // CHECK & BUILD RESPONSE BODY
    public function check_method($method){ //verifica se o metodo da requisição é válido
        return in_array($method, $this->available_methods);
    }

    // ===============================================================
    public function set_method($method){//adiciona o método à resposta
        $this->data['method'] = $method;
    }

    // ===============================================================
    public function get_method(){
        return $this->data['method'];
    }
    // ===============================================================
    public function set_endpoint($endpoint){ //adiciona o endpoint à resposta
        $this->data['endpoint'] = $endpoint; 
    }
    // ===============================================================
    public function get_endpoint(){
        return $this->data['endpoint'];
    }   
    // ===============================================================
    public function add_to_data($key, $value){//adiciona o resultado da consulta à resposta
        $this->data[$key] = $value;
    }

   
















    // ===============================================================
    // OUTPUT
    // ===============================================================
    public function api_request_error($message = ''){ //envia mensagem de erro da api no corpo da resposta
        $this->data['data'] = [
            'status' => 'ERROR',
            'message'=> $message,
            'results'=> null
        ];
        $this->send_response();
    }

    // ===============================================================
    public function send_api_status(){//envia status da API
        $this->data['status'] = 'SUCCESS';
        $this->data['message'] = 'API RUNNING OK!!!';
        $this->send_response();
    }

    // ===============================================================
    public function send_response(){//exbibir resposta final
        header('Content-Type:application/json');
        echo json_encode($this->data);
        die(1);
    }
}
