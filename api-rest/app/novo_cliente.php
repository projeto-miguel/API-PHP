<?php

// DEPENDENCIES ====================
require_once ("inc/config.php");
require_once ("inc/api_functions.php");
require_once('inc/functions.php');

if($_SERVER['REQUEST_METHOD'] ==  'POST'){
    
    $nome = $_POST['t_nome'];
    $email = $_POST['t_email'];
    $telefone = $_POST['t_phone'];

    $results = api_request('create_new_client','POST',[
        'nome' => $nome,
        'email' => $email,
        'telefone' => $telefone
    ]);

    print_data($results);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicação - Novo cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/estilo.css">
</head>

<body>
    <?php include ('inc/navbar.php') ?>


    <section class="container">
        <div class="row my-5">
            <div class="col-sm-7 offset-sm-2 card bg-light p-4">
                <form action="novo_cliente.php" method="POST">

                    <div class="mb-3">
                        <label>Nome completo</label>
                        <input type="text" class="form-control" name="t_nome">
                    </div>

                    <div class="mb-3">
                        <label>Telefone</label>
                        <input type="text" class="form-control" name="t_phone">
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="text" class="form-control" name="t_email">
                    </div>

                    <div class="mb-3 text-center">
                        <a href="clientes.php" role="button" class="btn btn-secondary btn-sm">Cancelar</a>
                        <input type="submit" class="btn btn-primary btn-sm" value="Cadastrar">
                    </div>

                </form>
            </div>
        </div>
    </section>
    
</body>

</html>