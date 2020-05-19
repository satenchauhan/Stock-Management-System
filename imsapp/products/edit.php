<?php

require_once("../init/init.php");

if(isset($_POST['pid'])){
	$pid =$_POST['pid'];
}
$product = $product->fetch_single_product($pid);

echo json_encode($product);


