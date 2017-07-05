<?php

namespace Lib\core;

class Router {
	
	public function router() {
		
		     
		$controllerfile = ucfirst($route->getAttribute('module'));
		
		$classes = 'App\\Modules\\'.$route->getAttribute('module').'\\Controllers\\'.$route->getAttribute('controller').'Controller';
		$controller = new $classes();
		if (file_exists($baseDir2.'/App/Modules/' . $route->getAttribute('module') . '/Models/'.$route->getAttribute('controller'))) {
                $model = 'App\\Modules\\'.$route->getAttribute('module').'\\Models\\'.$route->getAttribute('controller');
                  
            }
         
      $action = $route->getAttribute('action');
	$controller->{ $action }();
		
	}
	
	
}

?>
