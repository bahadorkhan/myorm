<?php 
namespace models;
require_once("vandor/activerecord.php");

class Test extends \db\ActiveRecord{
	
	 public function tablename(){
		return ' test ';
	}
	
}
?>