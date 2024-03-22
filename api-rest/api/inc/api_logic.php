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

    // ===============================================================
    // CLIENTES
    // ===============================================================
    public function get_all_clients(){

        $sql = "SELECT * FROM clientes";

        $db = new database();
        $results = $db->EXE_QUERY($sql);

        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK',
            'results' => $results
        ];
    }
    // ===============================================================
    public function get_all_active_clients(){
        $sql = "SELECT * FROM clientes WHERE deleted_at IS NULL";

        $db = new database();
        $results = $db->EXE_QUERY($sql);

        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK',
            'results' => $results
        ];
    }
    // ===============================================================
    public function get_all_inactive_clients(){
        $sql = "SELECT * FROM clientes WHERE deleted_at IS NOT NULL";

        $db = new database();
        $results = $db->EXE_QUERY($sql);

        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK',
            'results' => $results
        ];
    }
    // ===============================================================
    public function get_client(){
        $sql = "SELECT * FROM clientes WHERE 1 ";

        if(key_exists('id',$this->params)){

            if(filter_var($this->params['id'], FILTER_VALIDATE_INT)){
                $sql .= "AND id_cliente = " . intval($this->params['id']);
            }
        }else{
            return [
                'status' => 'ERROR',
                'message' => 'CLIENT ID NOT ESPECIFIED',
                'results' => []
            ];
        }

        $db = new database();
        $results = $db->EXE_QUERY($sql);

        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK',
            'results' => $results
        ];
    }
    // ===============================================================
    /* public function get_client_by_ddd(){
        $sql = "SELECT * FROM clientes WHERE 1 ";

        if(key_exists('ddd',$this->params)){

            if(filter_var($this->params['ddd'], FILTER_VALIDATE_INT)){
                $sql .= "AND telefone LIKE '(" . intval($this->params['ddd']) . ")%'";
            }
        }else{
            return [
                'status' => 'ERROR',
                'message' => 'CLIENT DDD NOT ESPECIFIED',
                'results' => []
            ];
        }

        $db = new database();
        $results = $db->EXE_QUERY($sql);

        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK',
            'results' => $results
        ];
    }
    // ===============================================================
    public function get_client_by_name(){
        $sql = "SELECT * FROM clientes WHERE 1 ";

        if(key_exists('name',$this->params)){
            $sql .= "AND nome LIKE '%" . $this->params['name'] . "%'";
        }else{
            return [
                'status' => 'ERROR',
                'message' => 'CLIENT NAME NOT ESPECIFIED',
                'results' => []
            ];
        }

        $db = new database();
        $results = $db->EXE_QUERY($sql);

        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK',
            'results' => $results
        ];
    }
    // ===============================================================
    public function get_client_by_email(){
        $sql = "SELECT * FROM clientes WHERE 1 ";

        if(key_exists('email',$this->params)){
            $sql .= "AND email LIKE '%" . $this->params['email'] . "%'";
        }else{
            return [
                'status' => 'ERROR',
                'message' => 'CLIENT EMAIL NOT ESPECIFIED',
                'results' => []
            ];
        }

        $db = new database();
        $results = $db->EXE_QUERY($sql);

        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK',
            'results' => $results
        ];
    }
    // ===============================================================
    public function get_client_by_phone(){
        $sql = "SELECT * FROM clientes WHERE 1 ";

        if(key_exists('phone',$this->params)){

            if(filter_var($this->params['phone'], FILTER_VALIDATE_INT)){
                $sql .= "AND telefone LIKE '%" . intval($this->params['phone']) . "%'";
            }
        }else{
            return [
                'status' => 'ERROR',
                'message' => 'CLIENT PHONE NUMBER NOT ESPECIFIED',
                'results' => []
            ];
        }

        $db = new database();
        $results = $db->EXE_QUERY($sql);

        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK',
            'results' => $results
        ];
    } */
    // ===============================================================
    public function create_new_client(){

        //Checar se todos dados estão preenchidos
        if(
            !isset($this->params['nome']) || 
            !isset($this->params['email']) || 
            !isset($this->params['telefone']) ||
            $this->params['nome']=='' ||
            $this->params['email']=='' ||
            $this->params['telefone']=='' 
        ){
            return [
                'status'=> 'ERROR',
                'message'=> 'Informações insuficientes para adicionar cliente',
                'results'=> []
            ];
        }

        //Checar se já existe um cliente com o mesmo nome ou email
        $db = new database();
        $params = [
            ':nome' => $this->params['nome'],
            ':email' => $this->params['email']
        ];
        $results = $db->EXE_QUERY("
            SELECT id_cliente FROM clientes
            WHERE
            nome = :nome OR email = :email
        ", $params);
        if(count($results) != 0){
            return [
                'status' => 'ERROR',
                'message' => 'Já existe um cliente com o mesmo nome ou email.',
                'results' => []
            ];
        }

        $params = [
            ':nome' => $this->params['nome'],
            ':email' => $this->params['email'],
            ':telefone' => $this->params['telefone']
        ];

        $db = new database();
        $db->EXE_QUERY("
            INSERT INTO clientes (nome,email,telefone) VALUES (
                :nome,
                :email,
                :telefone
            )
        ", $params);

        return[
            'status' => 'SUCCESS',
            'message' => 'Novo cliente adicionado',
            'results' => []
        ];
    }
    // ===============================================================






    // ===============================================================
    // PRODUTOS
    // ===============================================================
    public function get_all_products(){

        $db = new database();
        $results = $db->EXE_QUERY('SELECT * FROM produtos');

        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK',
            'results' =>  $results
        ];
    }
    // ===============================================================
    public function get_all_active_products(){
        $sql = "SELECT * FROM produtos WHERE deleted_at IS NULL";

        $db = new database();
        $results = $db->EXE_QUERY($sql);

        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK',
            'results' => $results
        ];
    }
    // ===============================================================
    public function get_all_inactive_products(){
        $sql = "SELECT * FROM produtos WHERE deleted_at IS NOT NULL";

        $db = new database();
        $results = $db->EXE_QUERY($sql);

        return [
            'status' => 'SUCCESS',
            'message' => 'API RUNNING OK',
            'results' => $results
        ];
    }
    // ===============================================================
    public function get_unavailable_products(){
        $sql = "SELECT * FROM produtos WHERE quantidade <= 0 AND deleted_at IS NULL ";

        $db = new database();
        $results = $db->EXE_QUERY($sql);

        return [
            'status' => 'OK',
            'message' => 'API RUNNING OK',
            'results' => $results
        ];
    }
    // ===============================================================
    public function create_new_product(){

        //Checar se todos dados estão preenchidos
        if(
            !isset($this->params['produto']) || 
            !isset($this->params['quantidade']) || 
            $this->params['produto'] == '' ||
            $this->params['quantidade'] == null
        ){
            return [
                'status'=> 'ERROR',
                'message'=> 'Informações insuficientes para adicionar produto',
                'results'=> []
            ];
        }

        //Checar se já existe um produto com mesmo nome
        $db = new database();
        $params = [
            ':produto' => $this->params['produto']
        ];
        $results = $db->EXE_QUERY("
            SELECT id_produto FROM produtos
            WHERE
            produto = :produto
        ", $params);
        if(count($results) != 0){
            return [
                'status' => 'ERROR',
                'message' => 'Já existe um produto com o mesmo nome.',
                'results' => []
            ];
        }

        $params = [
            ':produto' => $this->params['produto'],
            ':quantidade' => $this->params['quantidade']
        ];

        $db = new database();
        $db->EXE_QUERY("
            INSERT INTO produtos (produto,quantidade) VALUES (
                :produto,
                :quantidade
            )
        ", $params);

        return[
            'status' => 'SUCCESS',
            'message' => 'Novo produto adicionado',
            'results' => []
        ];
    }

}