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
                <form action="novo_cliente.php" method="post">
                    <div class="mb-3">
                        <label for="t_nome" class="form-label">Nome completo</label>
                        <input type="text" class="form-control" name="t_nome" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="t_email" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="t_phone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" name="t_phone" autocomplete="off" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                    <a href="clientes.php" role="button" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </section>
    
</body>

</html>