<?php
namespace Lib\Core;

class Request {


    protected $controller;
    protected $action;
    protected $url;
    protected $module;
    protected $params = array();
    const GET = 'GET';
    const POST = 'POST';
    const COOKIE = 'COOKIE';

    public function __construct(){



        if (get_magic_quotes_gpc()) {
            $_POST = array_map('stripslashes_deep', $_POST);
            $_GET = array_map('stripslashes_deep', $_GET);
            $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
        }

        if (!isset($_SERVER['REQUEST_URI']) || empty($_SERVER['REQUEST_URI'])) {
            throw new \Exception('RequestUri non défini');
        }
        $directory= dirname(dirname(__FILE__));
        $directory = dirname($directory);
        $file = __DIR__;
        $this->url = isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'/';


    }



    public function setModule($name)
    {

        $this->module = $name;

    }


    public function setController($name)
    {

        $this->controller = $name;

    }


    public function setAction($name)
    {
        $this->action = $name;

    }


    public function getURL()
    {
        return $this->url;
    }


    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }



    public function getController()
    {

        return (string) $this->controller;
    }


    public function getAction()
    {


        return (string) $this->action;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function setURL() {
        $aa = 'oo';

        return $aa;
    }




    /* Pour récupérer et retourner les superglobales */

    public function __call($method, $key)
    {

        if( $method == 'GET' ) {
            $this->params[self::GET] = $_GET;
            return $this->params[self::GET][$key[0]];

        }elseif( $method == 'POST' ) {
            $this->params[self::POST] = $_POST;
            return $this->params[self::POST][$key[0]];

        }elseif( $method == 'COOKIE' ) {
            $this->params[self::COOKIE] = $_COOKIE;
            return $this->params[self::COOKIE][$key[0]];

        }else {

            echo 'Méthode inconnue dans la classe Request';
            return false;

        }




    }





}

?>
