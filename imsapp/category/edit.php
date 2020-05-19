<?php
require_once("../init/init.php");

if(isset($_POST['edit_id'])){
	$cat_id = $_POST['edit_id'];
	//debug($cat_id);
	$data = $data->fetch_single_category($cat_id);
	echo  json_encode($data);
	exit;
}


