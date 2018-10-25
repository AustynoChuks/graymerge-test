<?php
session_start();
include("__class.php");
//session_destroy();
$cart = new Cart;

$product = new Products;

if(isset($_POST["add"])){
	$cart->add($_POST["add"]);
}elseif(isset($_REQUEST["get_price"])){
	$p = $cart->get_total_price();
	echo json_encode($p);
}elseif (isset($_REQUEST["product_id"])) {
	$p = $product->getProductById($_REQUEST["product_id"]);
	echo json_encode($p);
}


if (isset($_POST["product-name"])) {
	$pname = addslashes($_POST["product-name"]);
	$pprice = (isset($_POST["product-price"])) ? $_POST["product-price"] : "";
	$pcat = (isset($_POST["product-category"])) ? $_POST["product-category"] : "";
	$pdesc = (isset($_POST["product-desc"])) ? $_POST["product-desc"] : "";
	$pcolor = (isset($_POST["product-color"])) ? $_POST["product-color"] : "";
	$pimg = (isset($_FILES["product-image"])) ? $_FILES["product-image"] : "";
	if($pname != "" && $pprice != "" && $pcat != "" && $pdesc != "" && $pcolor != "" && $pimg != ""){
		try{
			echo "I don";
			$add = $product->addProduct($pname, $pprice, $pcat, $pdesc, $pcolor, $pimg);
			header("Location:product-single.html?id=".$add);
		}catch(Exception $e){
			echo json_encode(array("status"=>"failed", "message"=>$e->getMessage()));
		}
	}else{
		echo "sometin happen";
	}
}
?>