<?php
namespace Lib\Helpers\Crud\Controllers;
use Lib\Core\Controller;
use Lib\Helpers\Crud\Models\Crud;

  
  class CrudController extends Controller {
    
  
   
  public function index(){


       $appel = new Crud();
       $crud = $appel->findall();
     $this->variable('crud', $crud); 
	$this->render('index', 'Crud', 'crud');

	}
	
	
	
	public function generate(){
      if(isset($this->request['table'])){
		  $appel = new Crud();
       $crud = $appel-> findcolumns($this->request['table']);
       $fk = $appel-> foreignkey($this->request['table']);
       $name = ucfirst($this->request['table']);
        $table = $this->request['table'];
        $namemodel = ucfirst($this->request['table']);
        $tablemodel = $this->request['table'];
       $dir = 'App/Modules/'.$name;
       if(!is_dir($dir)){
		   
		    mkdir($dir, 0777);
		    mkdir($dir.'/Controllers', 0777);
		    mkdir($dir.'/Models', 0777);
		    mkdir($dir.'/Views', 0777);
		  
		    
		    $controller = fopen($dir.'/Controllers/'.$name.'Controller.php', 'a+');
		    $model = fopen($dir.'/Models/'.$name.'.php', 'a+');
		    $index = fopen($dir.'/Views/index.php', 'a+');
		    $show = fopen($dir.'/Views/show.php', 'a+');
		    $edit = fopen($dir.'/Views/edit.php', 'a+');
           $insertphpfile = fopen($dir.'/Views/insert.php', 'a+');
                    $routing=fopen('App/routes.xml', 'r+');
		   
                    $column_name = array();
                    $column_value = array();
                    $showfield = array();
                    $editfield = array();
                    $insertfield = array();
                    $requestupdate = null;

                    
                    foreach ($crud as $k => $v) {

	            $column_name[$k] = '<th>'.$v->COLUMN_NAME.'</th>';	
                    $column_value[$k] = "echo '<td>'.substr(wordwrap(strip_tags(\$v->$v->COLUMN_NAME), 50, '<br />', true),0,150).'</td>';";
                    $showfield[$k] = "<div class=\"control-group\">
                        <label class=\"control-label\">$v->COLUMN_NAME</label>
                        <div class=\"controls\">
                            <label >  
                                <?php echo wordwrap(strip_tags(\$result->$v->COLUMN_NAME), 50, '<br />', true);?>
                            </label>
                        </div>
                      </div>";
            
	             }
                  
                     $insert=file_get_contents('Lib/Helpers/Crud/controller.txt');
                    $contenu=str_replace('CRUD', $name, $insert);  
		    fwrite($controller,$contenu); 
		    fclose($controller);
		    
		    
            $search = array('CRUD','crudtable');
		    $replace = array($namemodel, $tablemodel);
		    $insert=file_get_contents('Lib/Helpers/Crud/model.txt');
		    $contenu=str_replace($search, $replace, $insert);
		    fwrite($model,$contenu); 
		    fclose($model);
                    
		   
                    $search = array('CRUD','COLUMN-NAME','COLUMN-VALUE');
	                $column_name = implode("\n", $column_name);
                    echo $column_name.'<br />';
                    $column_value= implode("\n", $column_value);
                    $replace = array($table, $column_name, $column_value);
                    $insert=file_get_contents('Lib/Helpers/Crud/index.txt');
               
                    $contenu=str_replace($search, $replace, $insert);
                    fwrite($index,$contenu); 
	                fclose($index);
                    
                    $searchshow = array('CRUDSHOW','CRUD');
                    $showfield = implode("\n", $showfield);
                    $replaceshow = array($showfield, $table);
                    $insertshow=file_get_contents('Lib/Helpers/Crud/show.txt');
                    $contenushow=str_replace($searchshow, $replaceshow, $insertshow);
                    fwrite($show,$contenushow);
                    fclose($show);
                    
                    foreach ($crud as $k => $v) {

	            $column_name[$k] = '<th>'.$v->COLUMN_NAME.'</th>';	
                    $column_value[$k] = "echo '<td>'.substr(wordwrap(strip_tags(\$v->$v->COLUMN_NAME), 50, '<br />', true),0,150).'</td>';";
                    $editfield[$k] = "<div class=\"control-group\">
                        <label class=\"control-label\">$v->COLUMN_NAME</label>
                        <div class=\"controls\">
                            <label >  
                                <?php echo wordwrap(strip_tags(\$value->$v->COLUMN_NAME), 50, '<br />', true);?>
                                <td><input type=\"text\" name=\"$v->COLUMN_NAME\" value=\"<?php echo \$value->$v->COLUMN_NAME ?>\" ></td>;
                            </label>
                        </div>
                      </div>";
            
	             }
                    
                    
                    $searchedit = array('CRUDEDIT','CRUD');
                    $editfield = implode("\n", $editfield);
                    $replaceedit = array($editfield, $table);
                    $insertedit=file_get_contents('Lib/Helpers/Crud/edit.txt');
                    $contenuedit=str_replace($searchedit, $replaceedit, $insertedit);
                    fwrite($edit,$contenuedit);
                    fclose($edit);
                    
                    
                     foreach ($crud as $k => $v) {
                        
	            $column_name[$k] = '<th>'.$v->COLUMN_NAME.'</th>';	
                    $column_value[$k] = "echo '<td>'.substr(wordwrap(strip_tags($v->COLUMN_NAME), 50, '<br />', true),0,150).'</td>';";
                    $insertfield[$k] = "<div class=\"control-group\">
                        <label class=\"control-label\">$v->COLUMN_NAME</label>
                        <div class=\"controls\">
                            <label >  
                               
                                <td><input type=\"text\" name=\"$v->COLUMN_NAME\"></td>;
                            </label>
                        </div>
                      </div>";
            
	             }
                    
                    
                    $searchinsert = array('CRUDINSERT','CRUD');
                    $insertfield = implode("\n", $insertfield);
                    $replaceinsert = array($insertfield, $table);
                    $insertfile=file_get_contents('Lib/Helpers/Crud/insert.txt');
                    $contenuinsert=str_replace($searchinsert, $replaceinsert, $insertfile);
                    fwrite($insertphpfile,$contenuinsert);
                    fclose($insertphpfile);
                    
                    
                    $routes = array();
                    $routes[0]= "<route url=\"/$table\" module=\"$name\" controller=\"$name\" action=\"index\" />";
                    $routes[1]= "<route url=\"/$table/([0-9]+)\" module=\"$name\" controller=\"$name\" action=\"show\" vars=\"id\"/>";
                    $routes[2]= "<route url=\"/$table/edit/([0-9]+)\" module=\"$name\" controller=\"$name\" action=\"edit\" vars=\"id\" />";
                    $routes[3]= "<route url=\"/$table/insert\" module=\"$name\" controller=\"$name\" action=\"insert\"  />";
                    $routes[4]= "<route url=\"/$table/delete/([0-9]+)\" module=\"$name\" controller=\"$name\" action=\"delete\" vars=\"id\" />";
                    $routes[5]="</routes>";
                    
                    $replaceroute = implode("\n", $routes);
                    $insertroute=file_get_contents('App/routes.xml');
                 
                    $contenuroute=str_replace('</routes>', $replaceroute,  $insertroute);
                    ftruncate($routing,0);
                    fwrite($routing,$contenuroute); 
	                fclose($routing);

                    
                   
                   
                    
                    
                    
                    
       }
       die();
	  }
     $this->redirection('crud');
	}
	
	

  }
?>
