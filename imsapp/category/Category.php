<?php

class Category{
	use Exists;
	private $dbcon;
	private $cat_table ='categories';
    private $_edit_id;
	
	public function __construct(){
      
      $this->dbcon  = new Database();

    }
	public function addCategory($data){
		// debug($data);
		if(empty($data['category_name'])){
			return "Required";
		}else if(!preg_match("/^[A-Za-z- ]{3,50}$/", $data['category_name'])){
            return "Invalid_Name";
        }else if($this->category_check($data['category_name'])){
			return "Cat_Exists";
		}else{
				
			$sql="INSERT INTO `".$this->cat_table."`(`main_cat`,`category_name`,`status`) VALUES(?,?,?)";
			$stmt = $this->dbcon->connect()->prepare($sql);
			$stmt->bindParam(1, $data['maincategory'], PDO::PARAM_INT);
			$stmt->bindParam(2, $data['category_name'], PDO::PARAM_STR);
			$stmt->bindParam(3, $data['status'], PDO::PARAM_INT);
			$data = $stmt->execute() OR die($this->dbcon->connect()->error);
			if($data){
				if($data['maincategory']==0){	
				 	return "MainCategory";
				}else{
					return "Subcategory";
				}
			}
			return "Not_Added";
		}	

	}

	public function fetch_all_category($data){
		$sql = "SELECT * FROM ".$this->cat_table;
		$stmt = $this->dbcon->connect()->prepare($sql);
		$stmt->execute() OR die($this->dbcon->connect()->error);
		if($stmt->rowCount()>0){
			$data = $stmt->fetchAll(PDO::FETCH_OBJ);
			if(!empty($data)){
				//debug($data);
			     return $data;
			}else{
				return false;
			}
			
		}
		return false;
	}
	public function fetch_category_with_pagination($data,$starting_point,$record_per_page){
		// $sql = "SELECT * FROM categories m INNER JOIN categories s ON m.main_cat = s.cat_id LIMIT $starting_point,$record_per_page";
		$sql ="SELECT p.`cat_id`,p.`main_cat`,p.`category_name` as category, s.`category_name` as maincategory, p.status FROM categories p LEFT JOIN categories s ON p.main_cat=s.cat_id LIMIT $starting_point,$record_per_page"; 
		$stmt = $this->dbcon->connect()->prepare($sql);
		$stmt->execute() OR die($this->dbcon->connect()->error);
		if($stmt->rowCount()>0){
			$data = $stmt->fetchAll();
			// debug($data);
			if(!empty($data)){
				//debug($data);
			  return $data;
			}else{
				return false;
			}	
		}
		return false;
	}
	public function pagination_link($data){
		$sql ="SELECT * FROM ".$this->cat_table;
		$stmt= $this->dbcon->connect()->prepare($sql);
		if(is_object($stmt)){
			$stmt->execute() OR die($this->dbcon->connect()->error);
				$total_records = $stmt->rowCount();
				//debug($total_records);
				return $total_records;
		}
		return false;
	}
	public function fetch_single_category($cat_id){
		//debug($cat_id);
		$sql ="SELECT * FROM ".$this->cat_table." WHERE cat_id=?";
		$stmt = $this->dbcon->connect()->prepare($sql);
		if(is_object($stmt)){
			$stmt->bindParam(1, $cat_id, PDO::PARAM_INT);
			$stmt->execute() OR die($this->dbcon->connect()->error);
			$rows = $stmt->fetch(PDO::FETCH_OBJ);
			if(!empty($rows))
			{
				//debug($row);
				return $rows;
			}else{
				return false;
			}
		}
		return false;
	}
	public function deleteUser($del_id){
		$sql ="SELECT cat_id FROM ".$this->cat_table." WHERE main_cat=? ";
		$stmt = $this->dbcon->connect()->prepare($sql);
		$stmt->bindParam(1, $del_id,PDO::PARAM_INT);
		$stmt->execute() OR die($this->dbcon->connect()->error);
		// $result = $stmt->get_result()  OR die($this->dbcon->connect()->error);
		if($stmt->rowCount() > 0){
			return "Dependent_Category";
		}else{
			$sql="DELETE FROM ".$this->cat_table." WHERE cat_id=?";
			$stmt =  $this->dbcon->connect()->prepare($sql);
			if(is_object($stmt)){
			   $stmt->bindParam(1, $del_id, PDO::PARAM_INT);
			   $data= $stmt->execute() OR die($this->dbcon->connect()->error);
			   if($data){
			   	 return "Deleted_User";
			   }else{
			   	 return false;
			   }
			}
			return false;	
		}	

	}
	
	public function updateCategory($user){
		//debug($user);
		if(empty($user['update-category-name'])){
			return "Required";
		}else{
			$sql="UPDATE ".$this->cat_table." SET category_name=?, status=? WHERE cat_id=?";
			$stmt =  $this->dbcon->connect()->prepare($sql);
			if(is_object($stmt)){
				$stmt->bindParam(1, $user['update-category-name'], PDO::PARAM_STR);
				$stmt->bindParam(2, $user['update-status'], PDO::PARAM_INT);
				$stmt->bindParam(3, $user['cat_id'], PDO::PARAM_INT);
				$data = $stmt->execute();
				if($data){
					return "Updated";
				}else{
					return "failed";
				}
			}
			return false;

		}
		
	}
	



}


$data = new Category();

