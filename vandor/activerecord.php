<?php 
namespace db;
abstract class ActiveRecord{
	public static $JSON = "json";
	
	protected $connection;
	private $LastPart = array();
	private $limit= array();
	private $order= array();
	private $condition;
	private $params = array();
	public function __construct(){
		$this->connection = new \PDO('mysql:host=localhost;dbname=activerecord', "root", "");
	}
	
	abstract public function tablename();
	
	public function limit($limit = 100){
			if($limit && $limit > 0 )
				$this->limit = array('limit'=>$limit);
			return $this;
	}
	
	public function order($order){
			if($order != "")
				$this->order = array('order by'=>$order);
			return $this;
	}
	
	
		public function where($where,$params , $type = ""){
			if($where != ""):
				$this->condition = $this->condition.$where." ".$type." ";
				$this->params = array_merge($this->params,$params);
			endif;
			
			
			
					
			return $this;
	}
	

	
	protected function per(){

		$this->LastPart  = array_merge($this->LastPart,$this->order);
		$this->LastPart  = array_merge($this->LastPart,$this->limit);
			$this->LastPart = implode(' ', array_map(
        function ($v, $k) {
            return $k.' '.$v;
        },
        $this->LastPart,
        array_keys($this->LastPart)
    ));
	if($this->condition):
		$this->LastPart = "WHERE ".$this->condition.$this->LastPart;
	endif;
	return $this->LastPart;
	}
	
	public function findById($id,$out=""){
		$this->where("id = :ID",array(":ID"=>(int)$id));
		return $this->findAll($out,"single");
		
	}
	
	
	public function findAll($out = "",$type = "all"){
		$sql   = "select * from ".$this->tablename().$this->per();
		$stmt  =  $this->connection->prepare($sql);
		foreach ($this->params as $k => $id)
		$stmt->bindValue($k, $id);
		$result = $stmt->execute();
		if($type == "all")
		$user   = $stmt->fetchAll(\PDO::FETCH_ASSOC);//$stmt->fetch(PDO::FETCH_ASSOC);
		else
		$user   = $stmt->fetch(\PDO::FETCH_ASSOC);//$stmt->fetch(PDO::FETCH_ASSOC);
		switch($out){
			case self::$JSON:
			return json_encode($user);
			break;
			default:
			return $user;
			break;
		}
	
	}
	public function deleteById($id,$out=""){
		$this->where("id = :ID",array(":ID"=>(int)$id));
		return $this->deleteAll();
		
	}
	public function deleteAll(){
		$sql   = "DELETE FROM ".$this->tablename().$this->per();
		$stmt  =  $this->connection->prepare($sql);
		foreach ($this->params as $k => $id)
		$stmt->bindValue($k, $id);
		if($stmt->execute() === TRUE)
			return true;
		else return false;
		
	}
	
	
	
}
?>