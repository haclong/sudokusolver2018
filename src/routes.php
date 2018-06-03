<?php

use Slim\Http\Request;
use Slim\Http\Response;


// Routes

$app->get('/debug', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/debug' route");

    // Render index view
    $grid = ['grid' => 'konichiwa'] ;

    return $response->withJson($grid) ;
//    return $this->renderer->render($grid, 'debug.phtml', $args);
});

$app->get('/new', Sudoku\Infra\Controller\SaveNewGridController::class . ':newAction');

$app->post('/new', Sudoku\Infra\Controller\SaveNewGridController::class . ':saveAction');


$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

