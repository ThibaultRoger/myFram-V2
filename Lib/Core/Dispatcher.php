<?php

namespace Lib\Core;

use Lib\Core\Request;
use Lib\Core\Response;
use Lib\Core\FrontController;
use Lib\Core\Routes;
class Dispatcher{

    public function __construct() {


    }



    public function dispatch (\Lib\Core\Request $request, \Lib\Core\Response $response) {

            
        $controller=$request->getController();
        $controller = new $controller;
        $controller->req = $request;
        $controller->rep = $response;
        $response->setContent($controller->run($request->getAction()));




    }








}

?>
