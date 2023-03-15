<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->post('/', function (Request $request, Response $response) {
    $response->getBody()->write('Hello world!');

    return $response
        ->withHeader('Content-Type', 'text/plain');
});

$app->post('/change-state', function (Request $request, Response $response) {
    $response->getBody()->write('Created csv file');

    return $response;
});

$app->run();
