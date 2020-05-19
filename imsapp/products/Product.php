<?php

class Product{
	use Exists;
	    private $dbcon;
		private $b_table="brands";
		private $p_table="products";

		public function __construct(){

			$this->dbcon = new Database;
		}
		
		public function fetch_all_brands(){
			$brand = new Brand();
			$brands = $brand->get_all_brands();		
			if(!empty($brands)){
			  	return $brands;
			}else{
				return false;
			}
		}

		public function add_product($product){
			//debug($product);
			if(empty($product['product_name']) || empty($product['stock']) || empty($product['price']) || empty($product['description'])){
				return "Required";

			}else if(!preg_match("/^[A-Za-z-0-9 ]{3,50}$/", $product['product_name'])){
            	return "Invalid_Name";

        	}else if($this->product_check($product['product_name'])){
				return "Product_Exists";

			}else{
				$sql="INSERT INTO `products`(`cat_id`,`brand_id`,`product_name`,`stock`,`price`,`description`) VALUES(?,?,?,?,?,?)";
				$stmt = $this->dbcon->connect()->prepare($sql);
				if(is_object($stmt)){
					$stmt->bindParam(1, $product['category_id'], PDO::PARAM_INT);
					$stmt->bindParam(2, $product['brand_id'], PDO::PARAM_INT);
					$stmt->bindParam(3, $product['product_name'], PDO::PARAM_STR);
					$stmt->bindParam(4, $product['stock'], PDO::PARAM_INT);
					$stmt->bindParam(5, $product['price'], PDO::PARAM_STR);
					$stmt->bindParam(6, $product['description'], PDO::PARAM_STR);
					$data = $stmt->execute() OR die($this->dbcon->connect()->error);
					// debug($data);
					if($data){
						return "Product_Added";
					}else{
						return "Not_Added";
					}
				}
				return false;
			}
		}

		public function fetch_all_products($starting_point,$record_per_page){
			$sql="SELECT * FROM products p, brands b, categories c WHERE p.brand_id=b.brand_id AND p.cat_id=c.cat_id LIMIT $starting_point,$record_per_page ";
			$stmt = $this->dbcon->connect()->prepare($sql);
			if(is_object($stmt)){
				$stmt->execute() OR die($this->dbcon->connect());
				if($stmt->rowCount()>0){
					$data = $stmt->fetchAll(PDO::FETCH_OBJ);
					// debug($data);
					if(!empty($data)){
						return $data;
					}else{
						return false;
					}	
				}
				return false;
			}
		}
		public function pagination_link(){
			$sql ="SELECT * FROM products";
			$stmt = $this->dbcon->connect()->prepare($sql);
			if(is_object($stmt)){
				$stmt->execute() OR die($this->dbcon->connect());
				if($stmt->rowCount()>0){
					$total_records = $stmt->rowCount();
					//debug($total_records);
					return $total_records;

				}
				return false;
			}

		}
		public function fetch_single_product($pid){
			// debug($pid);
			//$sql = "SELECT * FROM products,categories,brands WHERE products.brand_id=brands.bid, products.cat_id=categories.cat_id AND pid=?";
			$sql="SELECT * FROM `products`,`brands`, `categories`  WHERE `products`.`brand_id`=`brands`.`brand_id` AND `products`.`cat_id`=`categories`.`cat_id` AND `products`.`pid`=?";

			//$sql = "SELECT * FROM products,categories,brands WHERE  pid=?";
			$stmt = $this->dbcon->connect()->prepare($sql);
			if(is_object($stmt)){
				$stmt->bindParam(1, $pid, PDO::PARAM_INT);
				$stmt->execute() OR die($this->dbcon->connect());
				if($stmt->rowCount()>0){
					$data = $stmt->fetch(PDO::FETCH_OBJ);
					if(!empty($data)){
						// debug($data);
						return $data;
					}else{
						return false;
					}

				}
				return false;
			}
		}
		public function update_product($product){
			// debug($product);
			// exit;
			if(empty($product['update_product_name']) || empty($product['update_stock']) || empty($product['update_price']) || empty($product['update_desc'])){
				return "Required";

			}else if(!preg_match("/^[A-Za-z-0-9 ]{3,50}$/", $product['update_product_name'])){
            	return "Invalid_Name";

        	}else{
        		$sql="UPDATE products SET cat_id=?, brand_id=?, product_name=?, stock=?, price=?, description=?, p_status=? WHERE pid=? ";
				$stmt = $this->dbcon->connect()->prepare($sql);
				if(is_object($stmt)){
					$stmt->bindParam(1, $product['update_category_id'], PDO::PARAM_INT);
					$stmt->bindParam(2, $product['update_brand_id'], PDO::PARAM_INT);
					$stmt->bindParam(3, $product['update_product_name'], PDO::PARAM_STR);
					$stmt->bindParam(4, $product['update_stock'], PDO::PARAM_INT);
					$stmt->bindParam(5, $product['update_price'], PDO::PARAM_INT);
					$stmt->bindParam(6, $product['update_desc'], PDO::PARAM_STR);
					$stmt->bindParam(7, $product['update_status'], PDO::PARAM_INT);
					$stmt->bindParam(8, $product['upid'], PDO::PARAM_INT);
					$data=$stmt->execute() OR die($this->dbcon->connect());
					// debug($data);
					// exit;
					if($data){
						return "Product_Updated";
					}else{
						return "Not_Updated";
					}
					return false;
				}
        	}

		}
		public function delete_product($data){
			$sql = "DELETE FROM products WHERE pid=?";
			$stmt = $this->dbcon->connect()->prepare($sql);
			if(is_object($stmt)){
				$stmt->bindParam(1, $data['pid'], PDO::PARAM_INT);
				$data=$stmt->execute() OR die($this->dbcon->connect());
				if($data){
					return "Deleted_Product";
				}else{
					return "Not_Deleted";
				}
				
        	}
        	return false;
		}
		public function add_stock($stock){
			// debug($stock);
			// exit;
			if(empty($stock['sub-stock'])){
				return "Required";

			}else{
        		$sql="UPDATE products SET stock=? WHERE pid=? ";
				$stmt = $this->dbcon->connect()->prepare($sql);
				if(is_object($stmt)){
					$stmt->bindParam(1, $stock['sub-stock'], PDO::PARAM_INT);
					$stmt->bindParam(2, $stock['sid'], PDO::PARAM_INT);
					$data=$stmt->execute() OR die($this->dbcon->connect());

					if($data){
						return "Stock_Added";
					}else{
						return "Not_Added";
					}
					return false;
				}
        	}

		}


}

$product =  new Product();

