<?php
require_once('../model/product.php');

class productsManager {
	// public function get($id){
	// 	$req = "SELECT * FROM former WHERE id=$id";
	// 	$row = $this->executerRequete($req, array($id))->fetch();
	// 	return new product($row);
	// }
	//get Products
	public function getList(){
		$dbh = new PDO("mysql:host=localhost;dbname=formers","root","12345");
		$stack = array();
		$req = "SELECT * FROM former";
		$result = $dbh->query($req)->fetchAll();
		foreach ($result as $row){
			$item = new Product();
			$item->setFirst($row["Firstname"]);
			$item->setLast($row["Lastname"]);
			$item->setMatricule($row["Matricule"]);
			$item->setEmail($row["Email"]);
			array_push($stack, $item);
		}
		return $stack;

	}
//Add Product
		public function add($product){
			$dbh = new PDO("mysql:host=localhost;dbname=formers","root","12345");
			$req = "INSERT INTO `former`(`id`,`Firstname`, `Lastname`,`Matricule`,`Email`) VALUES (:id,:Firstname,:Lastname,:Matricule,:Email)";

			$addProductQuery = $dbh ->prepare($req);
			$addProductQuery -> bindParam(":id",$product->id(),PDO::PARAM_STR);	
			$addProductQuery -> bindParam(":Firstname",$product->getName(),PDO::PARAM_STR);
            $addProductQuery -> bindParam(":Lastname",$product->getLast(),PDO::PARAM_STR);
            $addProductQuery -> bindParam(":Matricule",$product->getMatricule(),PDO::PARAM_STR);
            $addProductQuery -> bindParam(":Email",$product->getEmail(),PDO::PARAM_STR);
			$addProductQuery->execute();
        }
		
}
?>