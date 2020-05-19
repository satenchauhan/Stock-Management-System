<?php

class Order{
	private $dbcon;
	// private $invoice_no;

	public function __construct(){
		$conn = new Database();
		$this->dbcon = $conn;
	}

	public function index(){

		return "Index";
	}

	public function fetch_all_products(){
		$sql="SELECT * FROM products";
		$stmt = $this->dbcon->connect()->prepare($sql);
		if(is_object($stmt)){
			$stmt->execute() OR die($this->dbcon->connect()->error);
			if($stmt->rowCount() >0){
				$data =$stmt->fetchAll(PDO::FETCH_OBJ);
				if(!empty($data)){
					return $data; 
				}else{
					return false;
				}
			}
		}
	}

	public function fetch_single_product($data){
		$sql="SELECT * FROM products WHERE pid=?";
		$stmt = $this->dbcon->connect()->prepare($sql);
		if(is_object($stmt)){
			$stmt->bindParam(1, $data['pid'], PDO::PARAM_INT);
			$stmt->execute() OR die($this->dbcon->connect()->error);
			if($stmt->rowCount() >0){
				$data =$stmt->fetch(PDO::FETCH_OBJ);
				if(!empty($data)){
					return $data; 
				}else{
					return false;
				}
			}
		}
	}

	public function create_customer_order($order){
		// debug($order);
		if($order['order_qty'] > $order['stock']){
			
			return 'Out_of_Stock';
		}else{
			$sql ="INSERT INTO orders(`customer_name`,`address`,`subtotal`,`gst`,`discount`,`net_total`,`paid`,`due`,`payment_method`,`order_date`) VALUES(?,?,?,?,?,?,?,?,?,?)";
			$stmt = $this->dbcon->connect()->prepare($sql);
			$stmt->bindParam(1, $order['customer_name'], PDO::PARAM_STR);
			$stmt->bindParam(2, $order['address'], PDO::PARAM_STR);
			$stmt->bindParam(3, $order['subtotal'], PDO::PARAM_INT);
			$stmt->bindParam(4, $order['gst'], PDO::PARAM_INT);
			$stmt->bindParam(5, $order['discount'], PDO::PARAM_INT);
			$stmt->bindParam(6, $order['net_total'], PDO::PARAM_INT);
			$stmt->bindParam(7, $order['paid'], PDO::PARAM_INT);
			$stmt->bindParam(8, $order['due'], PDO::PARAM_INT);
			$stmt->bindParam(9, $order['payment_method'], PDO::PARAM_STR);
			$stmt->bindParam(10,$order['order_date'], PDO::PARAM_STR);
			$stmt->execute() OR die($this->dbcon->connect()->error);

			// $invoice_id = $this->dbcon->connect()->lastInsertId();
			$sql="SELECT * FROM orders WHERE customer_name=?";
			$stmt = $this->dbcon->connect()->prepare($sql);
			$stmt->bindParam(1, $order['customer_name'], PDO::PARAM_STR);
			$stmt->execute() OR die($this->dbcon->connect()->error);
			
			$last_id = $stmt->fetch(PDO::FETCH_OBJ);
			$invoice_id = $last_id->invoice_no;
			$name = $last_id->customer_name;
			// debug($invoice_no);
			if($invoice_id!= null){
				for($x=0; $x < count($order['price']); $x++) { 
					// debug($order['price'][$x]);

					$remaining_stock = $order['stock'][$x] - $order['order_qty'][$x];

					if($remaining_stock < 0){
                        
					   return 'Out_of_Stock';
                   
					}else{

						$sql ="UPDATE products SET stock=? WHERE product_name=?";
						$stmt = $this->dbcon->connect()->prepare($sql);
						$stmt->bindParam(1, $remaining_stock, PDO::PARAM_INT);
						$stmt->bindParam(2, $order['product_name'][$x], PDO::PARAM_STR);
						$stmt->execute() OR die($this->dbcon->connect()->error);
					}

					$sql ="INSERT INTO `invoices`(`invoice_no`,`product_name`,`order_qty`,`price_per_item`) VALUES(?,?,?,?)";
					$stmt = $this->dbcon->connect()->prepare($sql);
					$stmt->bindParam(1, $invoice_id, PDO::PARAM_INT);
					$stmt->bindParam(2, $order['product_name'][$x], PDO::PARAM_STR);
					$stmt->bindParam(3, $order['order_qty'][$x], PDO::PARAM_INT);
					$stmt->bindParam(4, $order['price'][$x], PDO::PARAM_INT);
					$stmt->execute()  OR die($this->dbcon->connect()->error);

				}
				return ['Added'=>'Order_Added','id'=>$invoice_id,'name'=>$name];
			}

		}	
	}

	public function fetch_all_the_orders($starting_point,$record_per_page){
		$sql = "SELECT * FROM orders LIMIT $starting_point,$record_per_page"; 
		$stmt = $this->dbcon->connect()->prepare($sql);
		if(is_object($stmt)){
			$stmt->execute();
			if($stmt->rowCount()>0){
				$data = $stmt->fetchAll(PDO::FETCH_OBJ);
				// debug($data);
				if(!empty($data)){
					return $data;
				}else{
					return false;
				}
			}
		}
	}
	public function pagination_link(){
		$sql = "SELECT * FROM orders"; 
		$stmt = $this->dbcon->connect()->prepare($sql);
		if(is_object($stmt)){
			$stmt->execute();
			if($stmt->rowCount()>0){
				$total_records = $stmt->rowCount();
				// debug($total_records);
				if(!empty($total_records)){
					return $total_records;
				}else{
					return false;
				}
			}
		}
	}
	public function fetch_all_orders_with_invoice($id){
		// debug($id);
		$sql = "SELECT * FROM orders OD LEFT JOIN invoices IC  ON `OD`.`invoice_no`=`IC`.`invoice_no` WHERE `IC`.invoice_no=? "; 
		$stmt = $this->dbcon->connect()->prepare($sql);
		if(is_object($stmt)){
			$stmt->bindParam(1, $id, PDO::PARAM_INT);
			$stmt->execute();
			if($stmt->rowCount()>0){
				$data = $stmt->fetchAll(PDO::FETCH_BOTH);
				// debug($data);
				if(!empty($data)){
					return $data;
				}else{
					return false;
				}
			}
		}
	}

	public function generate_invoice($id){
		// debug($id);
		$sql = "SELECT * FROM orders RIGHT JOIN invoices ON orders.invoice_no=invoices.invoice_no WHERE orders.invoice_no=? "; 
		$stmt = $this->dbcon->connect()->prepare($sql);
		if(is_object($stmt)){
			$stmt->bindParam(1, $id, PDO::PARAM_INT);
			$stmt->execute();
			if($stmt->rowCount()>0){
				$data = $stmt->fetchALL(PDO::FETCH_ASSOC);
				// debug($data);
				if(!empty($data)){
					return $data;
				}else{
					return false;
				}
			}
		}
	}

	

}

$order = new Order();


?>