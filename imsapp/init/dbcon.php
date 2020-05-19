<?php

require_once __DIR__.'/../config/config.php';


class Database extends Config{

	public function connect(){
		
		try {
			$connect_obj = new Config();
			//$dbcon = new PDO("mysql:host=".DBHOST."; dbname=".DBNAME.";",DBUSER,DBPASS);
			$dbcon = new PDO("mysql:host=".$connect_obj->host_connect() . ";dbname=" .$connect_obj->dbname_connect(),$connect_obj->user_connect(),$connect_obj->pass_connect());
			$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connected..................!!!";
			return $dbcon;
		}catch(PDOException $e) {

			die("Connection failed...?");
			exit();
			
		}

	}

}

// $dbcon = new Database();




