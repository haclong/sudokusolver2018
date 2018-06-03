<?php

namespace Sudoku\Infra\Controller;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Sudoku\Infra\Entity\NewGridToSave;

/**
 * Description of SaveNewGridController
 *
 * @author haclong
 */
class SaveNewGridController {

    public function __construct(ContainerInterface $container) {
        $this->container = $container ;
    }

    public function newAction(Request $request, Response $response, array $args) {
        // Sample log message
        $this->container->get('logger')->info("Sudoku Solver '/new' route");

        return $this->container->get('renderer')->render($response, 'new.phtml', $args);
    }

    public function saveAction(Request $request, Response $response, array $args) {
        // Sample log message
        $this->container->get('logger')->info("Sudoku Solver '/new' route");
    
        //    echo get_class($request->getParams()) ;
        $newGrid = new NewGridFromPost($request->getParams()) ;
        // $mapper = new NewGridToSave($request->getParam('t'), $request->getParam('size')) ;

        return var_dump($newGrid) ;
        return $response->withJson($request->getParam('size')) ;
        return $this->renderer->render($response, 'new.phtml', $args);
    }

}
