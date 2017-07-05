<?php

namespace Lib\Core;

use Lib\Core\Request;
use Lib\Core\Response;
use Lib\Core\Routes;

class FrontController{

    public function __construct() {


    }

    public function run() {

        $request = new Request();
        $response = new Response();
        $route = new Routes();
        $route->Router($request);
        $dispatch = new Dispatcher();
        $dispatch->dispatch($request, $response);
        $response->getContent();

    }

}
?>











