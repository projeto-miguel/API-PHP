<?php

// DEPENDENCIES ====================
require_once("inc/config.php");
require_once("inc/api_functions.php");

$results = api_request('get_all_products','GET');

if($results['data']['status'] == 'SUCCESS'){
    $produtos = $results['data']['results'];
}else{
    $produtos = [];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aplicação - Produtos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/estilo.css">
    </head>
    <body>
        <?php include('inc/navbar.php') ?>

        <section class="container">
            <div class="row">
                <div class="col">
                    <h2>Produtos</h2>
                    <hr>

                    <?php if(count($produtos) == 0): ?>
                        <p>Não há produtos registrados</p>
                    <?php else: ?>
                        <p class="text-end">Total: <strong><?= count($produtos) ?></strong></p>
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Quantidade em estoque</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($produtos as $p): ?>
                                <tr>
                                    <td><?= $p['id_produto'] ?></td>
                                    <td><?= $p['produto']?></td>
                                    <td><?= $p['quantidade'] ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <button type="button" class="btn btn-outline-primary">Editar</button>
                                            <button type="button" class="btn btn-outline-danger">Deletar</button>
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