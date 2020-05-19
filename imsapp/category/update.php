<?php

require_once('../init/init.php');

// debug($_POST);
$status = $data->updateCategory($_POST);

if($status=="Updated"){
	echo json_encode([
	  	'success'=>'success',
	  	'message'=>'<div class="alert alert-success text-success text-center alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>The category has been updated</div>',
	  	// 'url'=>'category.php'
	]);
}else if($status=="Required"){
	echo json_encode([
		'error'=>'error',
		'message'=>'<div class="alert alert-danger text-danger text-center">All the fields are required</div>',
	]);

}else if($status=="Cat_Exists"){
	echo json_encode([
		'error'=>'error',
		'message'=>'<div class="alert alert-danger text-dark text-center">This category name '.$_POST['update-category-name'].' is already exists</div>',
	]);
}
