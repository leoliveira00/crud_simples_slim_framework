<?php

use function src\{
    slimConfiguration
};

use App\Controllers\{
    ClienteController
};

$app = new \Slim\App(slimConfiguration());

$app->get('/cliente', ClienteController::class . ':getClientes');
$app->get('/clienteByName/{cli_nome}', ClienteController::class . ':getClienteByName');
$app->get('/clienteById/{cli_id}', ClienteController::class . ':getClienteById');
$app->post('/cliente', ClienteController::class . ':insertCliente');
$app->put('/cliente/{cli_id}', ClienteController::class . ':updateCliente');
$app->delete('/cliente/{cli_id}', ClienteController::class . ':deleteCliente');

$app->run();
