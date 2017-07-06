<?php
namespace Lib\Core;
use Lib\Helpers\Form;
use Lib\Core\MyExceptions;

abstract class Controller{

    private $vars     = array();
    private $rendered = false;
    public $routing;
    public $uri;
    public $session;
    public $basedir2;
    public $req;
    public $rep;
    public $request = array();
    public $errors = array();
    public $form;
    public $validate = array();

    function __construct(){

        $this->Session = new Session();
        $this->Form = new Form($this);
        $vendorDir2 = dirname(dirname(__FILE__));
        $this->baseDir2 = dirname($vendorDir2);
        $this->uri = str_replace("/var/www", "", $this->baseDir2);

        if(!empty($_REQUEST)){

            foreach($_REQUEST as $k=>$v){
                $this->request[$k]=$v;

            }

        }
    }

    public function render($view, $module, $layout = 'layout'){
        if($this->rendered){ return false; }
        extract($this->vars);
        if(strpos($view,'/')===0){
            $view = $this->baseDir2.'/App/Modules/Home/Views/home.php';
        }elseif(file_exists($this->baseDir2.'/App/Modules/'.$module.'/Views/'.$view.'.php')){
            $view = $this->baseDir2.'/App/Modules/'.$module.'/Views/'.$view.'.php';
        }elseif(file_exists($this->baseDir2.'/Lib/Helpers/'.$module.'/Views/'.$view.'.php')){
            $view = $this->baseDir2.'/Lib/Helpers/'.$module.'/Views/'.$view.'.php';
        }
        ob_start();
        require($view);
        $content_for_layout = ob_get_clean();
        require $this->baseDir2.'/App/Layouts/'.$layout.'.php';
        $this->rendered = true;
    }


    public function variable($name, $value=null)
    {
        if(is_array($name)){
            $this->vars += $name;
        }else{
            $this->vars[$name] = $value;
        }
    }

    public function UnsetVariable ($variable)
    {

        unset($variable);

    }


    public function model($model,$module){
        $classe = 'App\\Modules\\'.$module.'\\Models\\'.$model;
        $c = new $classe();

        return $c;

    }

    static function call($controller,$action,$module){
        $classe = 'App\\Modules\\'.$module.'\\Controllers\\'.$controller.'Controller';
        $rqt = new Request();
        $rsp = new Response();
        $c = new $classe($rqt, $rsp);
        return $c->$action();
    }

    public function redirection($url){

        header("Location: ".$this->uri.'/'.$url);
        exit();
    }

    public function run($actionname) {

        try{


            $this->{ $actionname }();


        } catch(Exception $e){
            echo $e->getMessage();
        }
    }




}
