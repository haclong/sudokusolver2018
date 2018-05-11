<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Sudoku\Domain\Entity\In\NewGridToSave;

// Routes

$app->get('/debug', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/debug' route");

    // Render index view
    $grid = ['grid' => 'konichiwa'] ;

    return $response->withJson($grid) ;
//    return $this->renderer->render($grid, 'debug.phtml', $args);
});

$app->get('/new', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Sudoku Solver '/new' route");

    return $this->renderer->render($response, 'new.phtml', $args);
});


$app->post('/new', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Sudoku Solver '/new' route");
    
//    echo get_class($request->getParams()) ;
    $filteredInput = new NewGridFilter($request->getParams()) ;
//    $mapper = new NewGridToSave($request->getParam('t'), $request->getParam('size')) ;

    return var_dump($request->getParams()) ;
    return $response->withJson($request->getParam('size')) ;
    return $this->renderer->render($response, 'new.phtml', $args);
});


$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

