<?php
namespace Lib\Core;




class Routes{

    static $routes = array();

    public function Router(\Lib\Core\Request $request) {
        $vendorDir2 = dirname(dirname(__FILE__));
        $baseDir2 = dirname($vendorDir2);
        $file = __DIR__;
        //$currenturl = isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'/';

        $xml = new \DOMDocument;
        $xml->load($baseDir2.'/App/routes.xml');
        $routes = $xml->getElementsByTagName('route');
        foreach ($routes as $route)
        {


            if (preg_match('`^'.$route->getAttribute('url').'$`', $request->getURL(), $values))
            {

                $varname = [];
                $tabget = array();
                $liste = array();
                if ($route->hasAttribute('vars'))
                {
                    $varname = explode(',', $route->getAttribute('vars'));

                    foreach ($varname as $key => $value) {

                        $tabget[$value] = $values[$key + 1];

                    }

                    $_GET = array_merge($_GET, $tabget);

                }



                $controllerfile = ucfirst($route->getAttribute('module'));
                $classes='App\Modules\\'.$route->getAttribute('module').'\Controllers\\'.$route->getAttribute('controller').'Controller';
                $request->setModule($route->getAttribute('module'));
                $request->setController($classes);
                $request->setAction($route->getAttribute('action'));

            }


        }

        if (empty($controllerfile)) {

            $xml->load($baseDir2.'/Lib/Helpers/routes.xml');
            $routes = $xml->getElementsByTagName('route');
            foreach ($routes as $route)
            {


                if (preg_match('`^'.$route->getAttribute('url').'$`', $request->getURL(), $values))
                {

                    $varname = [];
                    $tabget = array();
                    $liste = array();
                    if ($route->hasAttribute('vars'))
                    {
                        $varname = explode(',', $route->getAttribute('vars'));

                        foreach ($varname as $key => $value) {

                            $tabget[$value] = $values[$key + 1];
                            var_dump($tabget);
                        }

                        $_GET = array_merge($_GET, $tabget);

                    }



                    $controllerfile = ucfirst($route->getAttribute('module'));

                    $classes = 'Lib\\Helpers\\'.$route->getAttribute('module').'\\Controllers\\'.$route->getAttribute('controller').'Controller';

                    $request->setModule($route->getAttribute('module'));
                    $request->setController($classes);
                    $request->setAction($route->getAttribute('action'));

                }


            }

            if (empty($controllerfile)) {


                require_once ($baseDir2.'/App/404.php');

            }


        }








    }




}
