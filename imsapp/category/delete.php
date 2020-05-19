<?php

require_once('../init/init.php');

if(isset($_POST['del_id'])){
	$del_id = $_POST['del_id'];
	$status = $data->deleteUser($del_id);

	if($status=="Deleted_User"){
		echo json_encode([
			"success"=>'success',
			'message'=>'<div class="alert alert-success text-success text-center alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>The category '.$_POST['del_id'].' has been deleted</div>',

		]);
	}else if($status==="Dependent_Category"){
		echo json_encode([
			"error"=>"error",
			"message"=>'<div class="alert alert-warning text-success text-center alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Sorry !! It is dependent category ! It can not delete</div>',

		]);
	}
	exit();
}