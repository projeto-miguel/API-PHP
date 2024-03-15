<?php

// DEPENDENCIES ====================
require_once("inc/config.php");
require_once("inc/api_functions.php");
require_once("inc/functions.php");

$results = api_request('get_all_clients','GET');

if($results['data']['status'] == 'SUCCESS'){
    $clientes = $results['data']['results'];
}else{
    $clientes = [];
}

//filtra o resultado da consulta para apenas a chave results dentro da chave data
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aplicação - Clientes</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/estilo.css">
    </head>
    <body>
        <?php include('inc/navbar.php') ?>
        <section class="container">
            <div class="row">
                <div class="col">

                    <div class="row">
                        <div class="col">
                            <h2>Clientes</h2>
                            
                        </div>
                        <div class="col text-end align-self-center">
                            <a role="button" class="btn btn-primary" href="novo_cliente.php">Adicionar cliente</a>
                        </div>
                    </div>
                    <hr>



                    <?php if(count($clientes) == 0): ?>
                        <p>Não existem clientes registrados.</p>
                    <?php else: ?>
                        <p class="text-end">Total: <strong><?= count($clientes) ?></strong></p>
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($clientes as $c): ?>
                                    <tr>
                                        <td><?= $c['id_cliente'] ?></td>
                                        <td><?= $c['nome'] ?></td>
                                        <td><?= $c['email'] ?></td>
                                        <td><?= $c['telefone'] ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <a role="button" class="btn btn-outline-primary">Editar</a>
                                                <a role="button" class="btn btn-outline-danger">Deletar</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </section>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>