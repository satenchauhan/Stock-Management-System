<?php

require_once('../init/init.php');


$status = $brand->delete_brand($_POST);

if($status=="Deleted_Brand"){
	echo json_encode([
		"success"=>'success',
		'message'=>'<div class="alert alert-success text-success text-center alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>The brand ID : '.$_POST['del_id'].' has been deleted</div>',

	]);
}else if($status==="Not_Deleted"){
	echo json_encode([
		"error"=>"error",
		"message"=>'<div class="alert alert-warning text-success text-center alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Sorry !!The brand has not been deleted</div>',

	]);
}
exit();
