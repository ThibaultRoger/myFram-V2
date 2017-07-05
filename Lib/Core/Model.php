<?php
namespace Lib\Core;

use PDO;

class Model {
	static $connexion = array();
	public $defaut = 'defaut';
	public $statement;
	public $request;
	protected  $possibledescription = array('name',
		'title',
		'description',
		'subject',
		'keywords',
		'id');


	public function __construct(){
		$rootdir = dirname(dirname(__FILE__));
		$rootdir = dirname($rootdir);
		$xml = new \DOMDocument;
		$xml->load($rootdir.'/Config/db.xml');
		$config= $xml->getElementsByTagName('conf');
		foreach ($config as $conf) { }
		if(isset( Model::$connexion[$this->defaut])){
			$this->dbh = Model::$connexion[$this->defaut];

			return true;
		}
		try{
			$pdo = new PDO(
				'mysql:host='.$conf->getAttribute('host').';dbname='.$conf->getAttribute('database').';',
				$conf->getAttribute('login'),
				$conf->getAttribute('password'),
				array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
			Model::$connexion[$this->defaut] = $pdo;
			$this->dbh = $pdo;


		}

		catch(PDOException $e){
			if(Conf::$debug >= 1){
				die($e->getMessage());
			}else{
				die('Impossible de se connecter à la base de donnée');
			}
		}

	}




	public function query($sql){
		$pre = $this->dbh->prepare($sql);
		return $pre;

	}



	public function exec($pre){
		$this->request = $pre->execute();
		return $pre->fetchAll(PDO::FETCH_OBJ);

	}


	public function findAll(){

		$sql = 'SELECT * 
			FROM '.$this->tablename.' ';

		$pre = $this->dbh->prepare($sql);
		return $pre;

	}



	public function select($where ='', $field ='*', $order='', $limit = null, $offset=''){
		$sql ="SELECT $field  FROM  $this->tablename "
			.($where ? " WHERE $where " : '')
			.($limit ? "LIMIT $limit " : '')
			.(($offset && $limit ? " OFFSET $offset " : ''))
			.($order ? "ORDER BY $order " : '');
		$pre = $this->dbh->prepare($sql);
		return $pre;

	}

	public function findByID($id){
		$sql = 'SELECT * 
			FROM '.$this->tablename.' 
			WHERE id='.$id.' ';

		$pre = $this->dbh->prepare($sql);

		return $pre;


	}

	public function findBy($record, $field){
		$sql = 'SELECT * 
			FROM '.$this->tablename.' 
			WHERE '.$field.'='.$record.' ';

		$pre = $this->dbh->prepare($sql);

		return $pre;


	}


	public function insert($data){
		ksort($data);
		$fields = NULL;
		$values = NULL;
		$insert = array();
		foreach ($data as $key => $value) {
			$fields .=''.$key.',';
			if(is_string($value)){
				$values .='\''.$value.'\',';
			}
			else {
				$values .=''.$value.',';
			}
		}
		$fields = rtrim($fields, ',');
		$values = rtrim($values, ',');
		$sql = 'INSERT INTO '.$this->tablename.' ('.$fields.') VALUES ('.$values.')';
		$this->request = $this->dbh->prepare($sql);
		$this->request->execute($data);

	}



	public function save(array $data){
		ksort($data);
		$fields = NULL;
		$insert = array();
		foreach ($data as $key => $value) {
			$fields .=''.$key.' = :'.$key.',';

		}
		$fields = rtrim($fields, ',');
		$sql = 'UPDATE '.$this->tablename.' SET '.$fields.' WHERE id ='.$data['id'].'';
		$this->request = $this->dbh->prepare($sql);
		$this->request->execute($data);



	}


	public function delete($id){
		$sql = 'DELETE FROM '.$this->tablename.'  WHERE id='.$id.' ';

		$this->request = $this->dbh->prepare($sql);
		$this->request->execute();



	}


	public function rowCount(){
		return $this->request->rowCount();
	}


	public function LastInsert(){

		return $this->dbh->lastInsertId();
	}


	public function __toString()
	{

		foreach ($this->possibledescritopn as $columnname)
		{
			try
			{
				return (string) $this->request($columnname);
			} catch (Exception $e) {}
		}

		return sprintf('No description for object of class "%s"');
	}


}
?>

