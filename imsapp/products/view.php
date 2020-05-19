<?php

require_once("../init/init.php");

if(isset($_POST['viewid'])){
	$pid = $_POST['viewid'];
}

$datas = $product->fetch_single_product($pid);
echo json_encode($datas);
