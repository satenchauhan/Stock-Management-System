<?php

require_once("../init/init.php");


if(isset($_POST['sid'])){
	$pid = $_POST['sid'];
}

$datas = $product->fetch_single_product($pid);
echo json_encode($datas);