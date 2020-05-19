<?php

require_once("../init/init.php");
if(isset($_POST['view_id'])){
	$id = $_POST['view_id'];
}
$rows = $order->fetch_all_orders_with_invoice($id);

echo json_encode($rows);

// foreach($rows as $row){
//      echo json_encode($row);

// }


// foreach ($rows as $row) {
	
// 	// echo $row->customer_name;
// 	echo $row->product_name;
	
// }

