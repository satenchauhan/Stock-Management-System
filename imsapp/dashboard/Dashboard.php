<?php

class Dashboard{

	private $dbcon; 

	public function __construct(){

		$this->dbcon = new Database();

	}

	public function count_users(){

		$sql ="SELECT COUNT(*) AS total_users FROM users";
		$stmt = $this->dbcon->connect()->prepare($sql);
		$stmt->execute() OR die($this->dbcon->connect()->error);
		$data = $stmt->fetch(PDO::FETCH_BOTH);
		$total_users = $data['total_users'];
		if($total_users){
			return ['total_user'=>$total_users];
		}
		return false;
	}
	public function count_category(){
		$sql ="SELECT COUNT(*) AS total FROM categories";
		$stmt = $this->dbcon->connect()->prepare($sql);
		$stmt->execute() OR die($this->dbcon->connect()->error);
		$data = $stmt->fetch(PDO::FETCH_BOTH);
		$total_cat = $data['total'];
		if($total_cat){
			return ['cat'=>$total_cat];
		}
		return false;
		
	}
	public function count_brands(){
		$sql ="SELECT COUNT(*) AS total FROM brands";
		$stmt = $this->dbcon->connect()->prepare($sql);
		$stmt->execute() OR die($this->dbcon->connect()->error);
		$data = $stmt->fetch(PDO::FETCH_BOTH);
		$total_brands = $data['total'];
		if($total_brands){
			return ['brands'=>$total_brands];
		}
		return false;
		
	}
	public function count_products(){
		$sql ="SELECT COUNT(*) AS total FROM products";
		$stmt = $this->dbcon->connect()->prepare($sql);
		$stmt->execute() OR die($this->dbcon->connect()->error);
		$data = $stmt->fetch(PDO::FETCH_BOTH);
		$products = $data['total'];
		
		if($products){
			return ['products'=>$products];
		}
		return false;
		
	}
	public function total_order_value(){
		$sql ="SELECT SUM(net_total) AS order_value FROM orders";
		$stmt = $this->dbcon->connect()->prepare($sql);
		$stmt->execute() OR die($this->dbcon->connect()->error);
		$data = $stmt->fetch(PDO::FETCH_BOTH);
		$value = $data['order_value'];
		// debug($value);
		if($value){
			return ['value'=>$value];
		}
		return false;
		
		
	}
	public function cash_order_value(){
		$sql ="SELECT SUM(net_total) AS cash_order_value FROM orders WHERE payment_method='Cash'";
		$stmt = $this->dbcon->connect()->prepare($sql);
		$stmt->execute() OR die($this->dbcon->connect()->error);
		$data = $stmt->fetch(PDO::FETCH_BOTH);
		$cash_value = $data['cash_order_value'];
		if($cash_value){
			return ['cash_value'=>$cash_value];
		}
		return false;
		
	}
	public function credit_order_value(){
		$sql ="SELECT SUM(net_total) AS credit_order_value FROM orders WHERE payment_method='Credit Card'";
		$stmt = $this->dbcon->connect()->prepare($sql);
		$stmt->execute() OR die($this->dbcon->connect()->error);
		$data = $stmt->fetch(PDO::FETCH_BOTH);
		$credit_value = $data['credit_order_value'];
		// debug($credit_value);
		if($credit_value){
			return ['credit_value'=>$credit_value];
		}
		return false;
	}


}

$dashboard = new Dashboard();