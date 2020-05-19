<?php

require_once("../init/init.php");
include("../fpdf/fpdf.php");

// debug($_POST);
if(isset($_POST['pdf_id'])){
	$id = $_POST['pdf_id'];
}

$row = $order->generate_invoice($id);

if(isset($_POST['pdf_id'])){
	    
		$pdf = new FPDF();

		for($x=0; $x<count($row[$x]); $x++){

		$pdf->AddPage();	
		$pdf->Rect(5, 5, 200, 287, 'D'); //For A4

		$pdf->SetFont("Arial","B", 16);
		$pdf->Cell(65,15,"SMART INFOTECHSYS",1,1,"C");

		$pdf->SetFont("Arial",null,12);
		$pdf->SetFont("Arial","B", 12);
		$pdf->Cell(35,8,"Customer Name: ",0,0);
		$pdf->SetFont("Arial","", 12);
		$pdf->Cell(53,8,ucwords($row[$x]['customer_name']),0,1);
		$pdf->Cell(35,8,"Address: ".ucwords($row[$x]['address']),0,1);
		$pdf->Cell(35,8,"GST No: ____________________",0,0);
		$pdf->SetY(25);
		$pdf->Cell(168,9,"Order Date  :",0,0,"R");
		$pdf->Cell(23,9,$row[$x]['order_date'],0,1,"R");
		// $pdf->Cell(140);
		$pdf->Cell(168,9,"Invoice No. :",0,0,"R");

		$pdf->Cell(12,9,"SIN/".$row[$x]['invoice_no'],0,1,"R");

		$pdf->SetY(49);
		$pdf->SetFont("Arial","B", 12);
		$pdf->Cell(50,8,"",0,1);
		$pdf->Cell(10,8," S.N. ",1,0,"C");
		$pdf->Cell(100,8,"Services/Product Name",1,0,"C");
		$pdf->Cell(25,8,"Quantity",1,0,"C");
		$pdf->Cell(25,8,"Price",1,0,"C");
		$pdf->Cell(30,8,"Total (Rs)",1,1,"C");

		$pdf->SetFont("Arial","", 12);
		for($i=0; $i < count($row); $i++){ 
		  	$pdf->Cell(10,7,($i+1),1,0,"C");
		  	$pdf->Cell(100,7,$row[$i]['product_name'],1,0,"L");
		  	$pdf->Cell(25,7, $row[$i]['order_qty'],1,0,"C");
		  	$pdf->Cell(25,7, $row[$i]['price_per_item'].".00",1,0,"R");
		  	$pdf->Cell(30,7, $row[$i]['order_qty'] * $row[$i]['price_per_item'].".00",1,1,"R");
		  	
		}
		$pdf->SetY(65);  //box
		$pdf->Cell(160,145," ",1,0);
		$pdf->Cell(30,145," ",1,0);
		$pdf->SetY(202);
		$pdf->SetFont("Arial","B", 12);
		$pdf->Cell(160,8,"Sub Total",1,0,"R");
		$pdf->Cell(30,8,$row[$x]['subtotal'].".00",1,0,"R");
		
		$pdf->SetY(210);
		$pdf->Cell(110);

		$pdf->SetFont("Arial","", 12);
		$pdf->Cell(50,8,"GST Tax ",1,0,"R");
		$pdf->SetFont("Arial","B", 12);
		$pdf->Cell(30,8,$row[$x]['gst'].".00",1,1,"R");
		$pdf->Cell(110);
		$pdf->SetFont("Arial","", 12);
		$pdf->Cell(50,8,"Discount ",1,0,"R");
		$pdf->SetFont("Arial","B", 12);
		$pdf->Cell(30,8,$row[$x]['discount'].".00",1,1,"R");
		$pdf->Cell(110);
		$pdf->SetFont("Arial","", 12);
		$pdf->Cell(50,8,"Net Total ",1,0,"R");
		$pdf->SetFont("Arial","B", 12);
		$pdf->Cell(30,8,$row[$x]['net_total'].".00",1,1,"R");
		$pdf->Cell(110);
		$pdf->SetFont("Arial","", 12);
		$pdf->Cell(50,8,"Paid Amount ",1,0,"R");
		$pdf->SetFont("Arial","B", 12);
		$pdf->Cell(30,8,$row[$x]['paid'].".00",1,1,"R");
	  	$pdf->Cell(110);
	  	$pdf->SetFont("Arial","", 12);
		$pdf->Cell(50,8,"Due Amount ",1,0,"R");
		$pdf->SetFont("Arial","B", 12);
		$pdf->Cell(30,8,$row[$x]['due'].".00",1,1,"R");
		$pdf->Cell(110);
		$pdf->SetFont("Arial","", 12);
		$pdf->Cell(50,8,"Payment Method ",1,0,"R");
		$pdf->SetFont("Arial","B", 12);
		$pdf->Cell(30,8,$row[$x]['payment_method'],1,1,"R");

		$pdf->SetY(255);
		$pdf->Cell(175,15,"for SMART INFOTECHSYS",0,1,"R");
		$pdf->SetFont("Arial","", 12);
		$pdf->SetY(270);
		$pdf->Cell(180,5,"------------------------------------------",0,1,"R");
		$pdf->Cell(175,1,"Authorized Signature",0,1,"R");

		$pdf->Output("../Invoices/invoice_".$row[$x]['customer_name'].".pdf","F");

		$bill =$pdf->Output();

		if($bill){
			header("location: Invoices/invoice_".$row[0]['customer_name'].".pdf");
		}
	}

}