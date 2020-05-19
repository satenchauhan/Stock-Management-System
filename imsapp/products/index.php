<?php

require_once("../init/init.php");

if(isset($_POST['page'])){
	$page = $_POST['page'];
}else{
	$page =1;
}
$record_per_page = 3;
$starting_point= ($page-1)*$record_per_page;

$table = '';
$rows = $product->fetch_all_products($starting_point,$record_per_page);
// debug($rows);
// echo json_encode($rows);
if(!empty($rows)){
$table  .='<table id="product_data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Brand Name</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="text-center" colspan="3" width="20%">Action</th> 
                    </tr>
               </thead>
               <tbody>';
foreach($rows as $row){
$table             .='<tr>
                        <td>'.$row->pid.'</td>
                        <td>'.ucwords($row->category_name).'</td>
                        <td>'.ucwords($row->brand_name).'</td>
                        <td>'.ucwords($row->product_name).'</td>
                        <td>'.$row->stock.'</td>
                        <td>'.$row->price.'</td>
                        <td>';
                        if($row->p_status==1){
$table              .=  '<span style="color:darkgreen;">Active</span>';
                    	}else{
$table              .=  '<span style="color:red;">Inactive</span>';              	
                    	}
$table              .=  '</td>
                        <td>
                        <button stock-id="'.$row->pid.'" class="btn btn-success btn-sm stock-btn" id="stock" data-toggle="modal" data-target="#Stock-Modal">+Add Stock</button>
                        </td>
                        <td>
						<button view-id="'.$row->pid.'" class="btn btn-primary btn-sm view-btn" id="view" data-toggle="modal" data-target="#Product-View-Modal">View</button>
						</td>
                        <td><button edit-id="'.$row->pid.'" class="btn btn-info btn-sm edit-btn" id="edit" data-toggle="modal" data-target="#UpdateProductModal">Edit</button>
                        </td>
                        <td>
                        	<button del-id="'.$row->pid.'" class="btn btn-danger btn-sm del-btn" id="del">Delete</button>
                        </td>
                    </tr>';
}
$table      .='</tbody>
            </table>';

$total_records = $product->pagination_link();
$total_pages = ceil($total_records/$record_per_page);


    $table      .='<ul class="pagination pull-right" style="margin-top:-15px;">';

                    if($page > 1){
                        $previous = ($page -1);
    $table      .=    '<li class="page-item prev" prev-id="'.$previous.'"><a class="page-link btn-info" style="cursor:pointer; color:white;">Previous</a></li>';

                    }


                for($x=1; $x<=$total_pages; $x++){
                    if($x==$page){

    $table      .=   '<li class="page-item " ><a class="page-link" style="background:darkgray; color:white;">'.$x.'</a></li>';

                    }else{
    $table      .=   '<li class="page-item page_no" id='.$x.'><a class="page-link" href="#">'.$x.'</a></li>';

                    }
                }
                    if($total_pages > $page){
                        $next = ($page +1);
    $table      .='<li class="page-item next" next-id="'.$next.'"><a class="page-link btn-info" style="cursor:pointer; color:white;">Next</a></li>';
                    }

    $table      .='</ul>
                </div>';

    echo $table;

}else{

    echo '<table id="product" class="table table-bordered table-striped"><td>No Data Found</td></table>';
      exit();
}