<?php

// DEPENDENCIES ====================
require_once ("inc/config.php");
require_once ("inc/api_functions.php");
require_once('inc/functions.php');
//ajshdajsdgh
$error_msg = '';
$success_msg = '';

if($_SERVER['REQUEST_METHOD'] ==  'POST'){
    $produto = $_POST['t_produto'];
    $quantidade = $_POST['n_quantidade'];
    
    $results = api_request('create_new_product', 'POST', ['produto' => $produto,'quantidade' => $quantidade]);
    
    if($results['data']['status']=='SUCCESS'){
        $success_msg = $results['data']['message'];
    }elseif($results['data']['status']=='ERROR'){
        $error_msg = $results['data']['message'];
    }
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
                <form action="novo_produto.php" method="POST">

                    <div class="mb-3">
                        <label>Nome do produto</label>
                        <input type="text" class="form-control" name="t_produto">
                    </div>

                    <div class="mb-3">
                        <label>Quantidade</label>
                        <input type="number" class="form-control" name="n_quantidade">
                    </div>

                    <div class="mb-3 text-center">
                        <a href="produtos.php" role="button" class="btn btn-secondary btn-sm">Cancelar</a>
                        <input type="submit" class="btn btn-primary btn-sm" value="Cadastrar">
                    </div>

                    <?php if(!empty($error_msg)): ?>
                        <div class="alert alert-danger p-2 text-center">
                            <?= $error_msg ?>
                        </div>
                    <?php elseif(!empty($success_msg)): ?>
                        <div class="alert alert-success p-2 text-center">
                            <?= $success_msg ?>
                        </div>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </section>
    
</body>

</html>