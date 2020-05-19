<?php

require_once("../init/init.php");


if(isset($_POST['viewid'])){
	$cat_id = $_POST['viewid'];
	$data = $data->fetch_single_category($cat_id);
	echo  json_encode($data);
	
}


