<?php
require_once("../init/init.php");


$status = $data->addCategory($_POST);

if($status=="MainCategory"){
	echo json_encode([
	  	'success'=>'success',
	  	'message'=>'<div class="alert alert-success text-success text-center alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>The main category has been added</div>',
	  	// 'url'=>'category.php'
	]);
}else if($status=="Subcategory"){
	echo json_encode([
	  	'success'=>'success',
	  	'message'=>'<div class="alert alert-success text-success text-center alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>The subcategory has been added</div>',
	]);

}else if($status=="Required"){
	echo json_encode([
		'error'=>'error',
		'message'=>'<div class="alert alert-danger text-danger text-center">All the fields are required</div>',
	]);

}else if($status=="Invalid_Name"){
	echo json_encode([
		'error'=>'error',
		'message'=>'<div class="alert alert-danger text-danger text-center">The name of category is not valid minimum 3 characters</div>',
	]);

}else if($status=="Cat_Exists"){
	echo json_encode([
		'error'=>'error',
		'exists'=>'exists',
		'message'=>'<div class="alert alert-danger text-dark text-center">This category name '.$_POST['category_name'].' is already exists</div>',

	]);
}
exit();
?>