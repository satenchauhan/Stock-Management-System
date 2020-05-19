<?php
require_once("../init/init.php");


$status = $brand->update_brand($_POST);

if($status=="Updated"){
	echo json_encode([
	  	'success'=>'success',
	  	'message'=>'<div class="alert alert-success text-success text-center alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>The brand name '.$_POST['update_brand_name'].' has been updated</div>',
	  	// 'url'=>'category.php'
	]);
}else if($status=="Required"){
	echo json_encode([
		'error'=>'error',
		'message'=>'<div class="alert alert-danger text-danger text-center">All the fields are required</div>',
	]);

}else if($status=="Not_Updated"){
	echo json_encode([
		'error'=>'error',
		'message'=>'<div class="alert alert-danger text-dark text-center">This  brand name not updated</div>',
	]);

	exit();
}