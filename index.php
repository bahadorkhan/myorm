<?php 
namespace Bahador;
require_once("models\Test.php");

use \models\Test;
$test = new Test;
/*	
print_r($test
		->order("id asc")
		->limit(10)
		//->where("content like :Content",array(":Content"=>"%Na%"),"AND")
		->where("id BETWEEN :ID1 and :ID2",array(":ID1"=>0,"ID2"=>10))
		->findAll(Test::$JSON)
		);
	*/
	/*print_r($test->findById(2))*/

		/*$d = $test
		->where("id  = :ID",array(":ID"=>5))
		->deleteAll();
		if($d)
			echo "Dlete Success";
		else 
			echo "faild";
		*/
		/*$test->deleteById(9);*/
		
?>