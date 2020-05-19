<?php
require_once('../init/init.php');

$record_per_page = 5;
$starting_point = 0;
$pagination='';
//$page = '';
if(isset($_POST['page'])){
  $page = $_POST['page'];
}else{
  $page = 1;
}
$starting_point = ($page -1) * $record_per_page;
$result = $data->fetch_category_with_pagination($_POST,$starting_point,$record_per_page);


if($result!=''){
  $pagination .='<table id="category_data" class="table table-bordered table-striped">
                      <thead>
                            <tr>
                                <th>ID</th>
                                <th>Main Category</th>
                                <th>Category Name</th>
                                <th width="8%" class="text-center">Status</th>
                                <th width="16%" class="text-center" colspan="2">Action</th>
                            </tr>
                      </thead>
                      <tbody>';
  foreach ($result as $row) {
        $pagination.=         '<tr>
                                <td>'.$row['cat_id'].'</td>
                                <td>'.$row['category'].'</td>
                                <td>'.$row['maincategory'].'</td>
                                <td>';
                                if($row['status']==1){
        $pagination.='          <span style="color:darkgreen;">Active</span>';
                                }else{
        $pagination.='          <span style="color:red;">Inactive</span>';  
                                }
         $pagination.='         </td>
                                <td>
                                  <button view-id='.$row['cat_id'].' id="view" class="btn btn-primary btn-sm v-id">View</button>
                                  <button edit-id='.$row['cat_id'].' id="edit" class="btn btn-info btn-sm edit-btn">Edit</button>
                                  <button del-id='.$row['cat_id'].' id="del" class="btn btn-danger btn-sm del-id">Delete</button>
                                </td>      
                              </tr>';
                             }
        $pagination.='</tbody>
                      </table>
                  </div>';

      $total_records = $data->pagination_link($_POST);
      $total_pages = ceil($total_records/$record_per_page);
      //debug($total_pages);
      $pagination .='<ul class="pagination pull-right" style="margin-top:-15px;">';

      if($page > 1){
        $previous = $page-1;
        $pagination .='<li class="page-item previous" prev-id="'.$previous.'"><a class="page-link btn-info" style="cursor:pointer;color:white;">Previous</a></li>';
      }
      
      for($x=1; $x<=$total_pages; $x++){
          if($x==$page){

            $pagination .='<li class="page-item"><a class="page-link" style="background:darkgray; color:white;">'.$x.'</a></li>';
          }else{

            $pagination .='<li class="page-item paging" id="'.$x.'"><a class="page-link" style="cursor:pointer;">'.$x.'</a></li>';

          }

      }
      if($total_pages > $page){
        $next = $page+1;
        $pagination .='<li class="page-item next" nxt-id="'.$next.'"><a class="page-link btn-info" style="cursor:pointer;color:white;">Next</a></li>';
      }
$pagination .='</ul>';

      echo $pagination;
}else{




      echo '<table id="category_data" class="table table-bordered table-striped"><td>No Data Found</td></table>';
}
exit();