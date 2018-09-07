<?php
	 $db=mysqli_connect('localhost','root','','inventory');

	if(!isset($_GET['deli_id'])){
        echo "<script>location.href = '../home.php';</script>";
    }else{
        $deli_id=$_GET['deli_id'];
        $order_id=$_GET['order_id'];
        $m_id=$_GET['m_id'];
    }
	 	
     require("fpdf/fpdf.php");
     $pdf = new FPDF('P','mm','A4');
     $pdf->AliasNbPages();

     $pdf->SetTopMargin(30);
     $pdf->SetRightMargin(30);
     $pdf->AddPage();

     $pdf->SetFont('Times','B',12);
     $date = date('d/m/Y');
     $pdf->Image('logo.jpg',150,10,50);
     $pdf->Cell(20,8,'Today Date : '.$date,0,0,'');
     $pdf->Ln();

     $query2=mysqli_query($db,"select status from delivery_details_view where order_id='$order_id'")or die(mysqli_error());
     $row2=mysqli_fetch_array($query2);
     $status = $row2['status'];

     $query1=mysqli_query($db,"select m_name from member where m_id='$m_id'")or die(mysqli_error());
     $row1=mysqli_fetch_array($query1);
     $m_name = $row1['m_name'];

     $pdf->SetTextColor(0, 102, 255);
     $pdf->SetFont('Times','B',12);
     $pdf->Cell(20,8,'Billing TO: ',0,0,'');
     $pdf->Ln(10);

     $pdf->SetFont('Times','',12);
     $pdf->SetTextColor(0,0,0);
     $pdf->Cell(20,8,'Name : '.$m_name,0,0,'');
     $pdf->Cell(170,8,'Member ID : '.$m_id,0,0,'R');
     $pdf->Ln();
     $pdf->Cell(20,8,'Status : '.$status,0,0,'');
     $pdf->Cell(170,8,'Order ID : '.$order_id,0,0,'R');
     $pdf->Ln(15);

	 $pdf->SetFont('Times','B',12);
	 $pdf->Cell(5,8,"SL",0,0,'C');
	 $pdf->Cell(75,8,"Product Name",0,0,'C');
	 $pdf->Cell(20,8,"Unit Price",0,0,'C');
	 $pdf->Cell(17,8,"Quantity",0,0,'C');
	 $pdf->Cell(20,8,"Price",0,0,'C');
     $pdf->Cell(20,8,"Discount",0,0,'C');
     $pdf->Cell(20,8,"VAT",0,0,'C');
     $pdf->Cell(20,8,"Total",0,0,'C');
	 $pdf->Ln();
		
    $query=mysqli_query($db,"select * from delivery_details_view where deli_id='$deli_id'");
        $i=0;
        while($row=mysqli_fetch_array($query)){
            $i++;

 		 $pdf->SetFont('Times','',12);
	     $pdf->Cell(5,8,$i,0,0,'C');
	     $prod_id = $row['prod_id'];
	     $query1=mysqli_query($db,"select prod_name from product where prod_id='$prod_id'")or die(mysqli_error());
	     $row1=mysqli_fetch_array($query1);
	     $prod_name = $row1['prod_name'];

         $cellWidth = 75;
         $cellHeight = 8;
         if($pdf->getStringWidth($prod_name) < $cellWidth) {
             $line = 1;
         }else {
            $textLength = strlen($prod_name);
            $errMargin = 10;
            $startChar = 0;
            $maxChar = 0;
            $textArray = array();
            $tmpString = "";
            while ($startChar < $textLength) {
                while ($pdf->getStringWidth($tmpString) < ($cellWidth - $errMargin) && 
                    ($startChar+$maxChar) < $textLength ) {
                    $maxChar++;
                    $tmpString = substr($prod_name, $startChar, $maxChar);
                }
                $startChar=$startChar+$maxChar;
                array_push($textArray, $tmpString);
                $maxChar = 0;
                $tmpString ='';
            }
            $line = count($textArray);
         }
         $xPos = $pdf->GetX();
         $yPos = $pdf->GetY();
         $pdf->MultiCell($cellWidth,$cellHeight,$prod_name,0,'C');
         $pdf->SetXY($xPos + $cellWidth, $yPos);

         $pdf->Cell(75,8,$prod_name,0,0,'C');
         $pdf->Cell(20,8,$row['prod_price'],0,0,'C');
        $query1=mysqli_query($db,"select dd_qty from deli_total_prod_view where order_id='$order_id'")or die(mysqli_error());
            $row1=mysqli_fetch_array($query1);
         $pdf->Cell(17,($line*$cellHeight),$row1['dd_qty'],0,0,'C');
         $pdf->Cell(20,($line*$cellHeight),$row['total'],0,0,'C');
         $pdf->Cell(20,($line*$cellHeight),$row['dd_discount'],0,0,'C');
         $pdf->Cell(20,($line*$cellHeight),number_format($row['VAT'],2),0,0,'C');
         $pdf->Cell(20,($line*$cellHeight),number_format($row['FTotal'],2),0,0,'C');
         $pdf->Ln();
        }

        $query3=mysqli_query($db,"select FTotal from delivery_details_total_view where deli_id='$deli_id'")or die(mysqli_error());
        $row3=mysqli_fetch_array($query3);
        $FTotal = number_format($row3['FTotal'],2);
         $pdf->Ln();
         $pdf->SetFont('Times','B',12);
     	 $pdf->Cell(20,10,"",0,0,'C');
     	 $pdf->Cell(170,8,'Total Price : '.$FTotal,0,0,'R');
     	 $pdf->Ln();

	
    $pdf->SetFont('Arial','I',10);
    $pdf->Cell(0,10,'Company name, Company address, Phone number, Email address',0,0,'C');


    $pdf->output();
    $print = $pdf->output();
?>

