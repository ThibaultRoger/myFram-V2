<?php
namespace Lib\Core;

use PDO;

class ModelCrud {
    public $dbname;

    public function __construct(){
        $rootdir = dirname(dirname(__FILE__));
        $rootdir = dirname($rootdir);
        $xml = new \DOMDocument;
        $xml->load($rootdir.'/Config/db.xml');
        $config= $xml->getElementsByTagName('conf');
        foreach ($config as $conf) {
            try{
                $this->dbname = $conf->getAttribute('database');
                $database ='information_schema';
                $pdo = new PDO(
                    'mysql:host='.$conf->getAttribute('host').';dbname='.$database.';',
                    $conf->getAttribute('login'),
                    $conf->getAttribute('password'),
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
                $this->db = $pdo;
            }

            catch(PDOException $e){
                if(Conf::$debug >= 1){
                    die($e->getMessage());
                }else{
                    die('Impossible de se connecter à la base de donnée');
                }
            }

        }



    }



}
?>
