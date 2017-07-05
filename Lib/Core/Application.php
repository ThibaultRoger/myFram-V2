<?php

namespace Lib\Core;

use Lib\Core\Request; 
use Lib\Core\Response;
use Lib\Core\FrontController;
use Lib\Core\Routes;
class Application{
	
public function __construct() {
	
	
}



public function run() {
	
	$request = new Request();
	$response = new Response();
	$route = new Routes();
	$route->Router($request);
	
	//echo $request->getURL();
	/*echo '<br/> recup get : ';
	var_dump($request->_getGET());
	echo $request->_getGET('testget');
	echo '<br/>';
	echo $request->_getGET('av');
	echo '<br/>';*/
	$frontcontroller = new FrontController();
	
	
	
}







 public static function __callStatic($name, $arguments)
    {
        // Note : la valeur de $name est sensible à la casse.
        echo "Appel de la méthode statique '$name' "
             . implode(', ', $arguments). "\n";
    }

}

?>
