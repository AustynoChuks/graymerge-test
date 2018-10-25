<?php

/**
 *  CART
 */
class Cart
{
	function add($product_id){
		if(!isset($_SESSION["cart"]))
			$_SESSION["cart"] = array($product_id);
		else
			$_SESSION["cart"][] = $product_id;
	}

	function remove($product_id){
		foreach ($_SESSION["cart"] as $key => $value) {
			if($value == $product_id){
				$_SESSION["cart"][$key] = NULL;
				break;
			}
		}
	}

	function get_total_price(){
		$db = file_get_contents("products.json");
		$object = json_decode($db);
		$total_price = 0;
		$total_items = count($_SESSION["cart"]);
		foreach ($_SESSION["cart"] as $key => $value) {
			//if(in_array())
		}
		return array("total_price"=>$total_price, "total_price_string"=>number_format($total_price, 2), "total_items"=>$total_items);
	}
	
	function __construct()
	{
		
	}
}

/**
 * P R O D U C T S
 */
class Products
{
	function uploadImage($file){
		$rand = rand(10000, 99999);
		if(is_dir("images/$rand") && file_exists("images/$rand/".$file["name"]))
			return $this->uploadImage($file);
		if(move_uploaded_file($file["tmp_name"], "images/$rand".$file["name"])) {
			return "images/$rand".$file["name"];
		}else{
			return false;
		}
	}
	
	function addProduct($pname, $pprice, $pcat, $pdesc, $pcolor, $pimg){
		$u = $this->uploadImage($pimg);
		if($u){
			$json = file_get_contents("products.json");
			$obj = json_decode($json);
			$data = array("product_name"=>$pname, "price"=>$pprice, "image"=>$u, "category"=>$pcat, "attr"=>array("color"=>$pcolor, "description"=>$pdesc));
			$obj[] = $data;
			$jsondb = json_encode($obj);
			$fh = fopen("products.json", 'w');
			fwrite($fh, $jsondb);
			return count($obj)-1;
		}else{
			throw new Exception("Cannot Upload image", 1);
		}
	}

	function getProductById($id){
		$db = file_get_contents("products.json");
		$obj = json_decode($db);
		if(array_key_exists($id, $obj)){
			return $obj[$id];
		}else{
			return array();
		}
	}
}
?>