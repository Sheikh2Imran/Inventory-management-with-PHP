<?php
	 $db=mysqli_connect('localhost','root','','inventory');

	if(!isset($_GET['deli_id'])){
        echo "<script>location.href = '../home.php';</script>";
    }else{
        $deli_id=$_GET['deli_id'];
        $m_id=$_GET['m_id'];
    }
	 	
     require("fpdf/fpdf.php");
     $pdf = new FPDF('P','mm','A4');
     $pdf->AliasNbPages();

     $pdf->SetTopMargin(30);
     $pdf->SetRightMargin(20);
     $pdf->AddPage();

     $pdf->SetFont('Times','B',12);
     $date = date('d/m/Y');
     $pdf->Image('logo.jpg',145,10,50);
     $pdf->Cell(20,8,'Today Date : '.$date,0,0,'');
     $pdf->Ln();

     $query3=mysqli_query($db,"select * from delivery_details_view where m_id='$m_id'")or die(mysqli_error());
     $row3=mysqli_fetch_array($query3);
     $m_id = $row3['m_id'];
     $status = $row3['status'];

     $query4=mysqli_query($db,"select m_name from member where m_id='$m_id'")or die(mysqli_error());
     $row4=mysqli_fetch_array($query4);
     $m_name = $row4['m_name'];


     $pdf->SetTextColor(0, 102, 255);
     $pdf->SetFont('Times','B',12);
     $pdf->Cell(20,8,'Billing TO : ',0,0,'');
     $pdf->Ln(10);

     $pdf->SetFont('Times','',12);
     $pdf->SetTextColor(0,0,0);
     $pdf->Cell(20,8,'Name : '.$m_name,0,0,'');
     $pdf->Cell(170,8,'Member ID : '.$m_id,0,0,'R');
     $pdf->Ln();
     $pdf->Cell(20,8,'Status : '.$status,0,0,'');
     $pdf->Cell(170,8,'Order ID : '.$m_id,0,0,'R');
     $pdf->Ln(15);

	 $pdf->SetFont('Times','B',12);
	 $pdf->Cell(5,8,"SL",0,0,'C');
	 $pdf->Cell(70,8,"Product Name",0,0,'C');
	 $pdf->Cell(20,8,"Unit Price",0,0,'C');
     $pdf->Cell(20,8,"Delivered",0,0,'C');
     $pdf->Cell(20,8,"Price",0,0,'C');
     $pdf->Cell(20,8,"Discount",0,0,'C');
     $pdf->Cell(20,8,"VAT",0,0,'C');
	 $pdf->Cell(20,8,"Total",0,0,'C');
	 $pdf->Ln();
		
        $query=mysqli_query($db,"select * from order_deli_view where m_id='$m_id'") or die(mysqli_error());
            $i = 0;
            while($row=mysqli_fetch_array($query)){
                $i++;

 		 $pdf->SetFont('Times','',12);
	     $pdf->Cell(5,8,$i,0,0,'C');

         $cellWidth = 70;
         $cellHeight = 8;
         if($pdf->getStringWidth($row['prod_name']) < $cellWidth) {
             $line = 1;
         }else {
            $textLength = strlen($row['prod_name']);
            $errMargin = 10;
            $startChar = 0;
            $maxChar = 0;
            $textArray = array();
            $tmpString = "";
            while ($startChar < $textLength) {
                while ($pdf->getStringWidth($tmpString) < ($cellWidth - $errMargin) && 
                    ($startChar+$maxChar) < $textLength ) {
                    $maxChar++;
                    $tmpString = substr($row['prod_name'], $startChar, $maxChar);
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
         $pdf->MultiCell($cellWidth,$cellHeight,$row['prod_name'],0,'C');
         $pdf->SetXY($xPos + $cellWidth, $yPos);

         $pdf->Cell(20,($line*$cellHeight),$row['prod_price'],0,0,'C');
         $pdf->Cell(20,($line*$cellHeight),$row['dd_qty'],0,0,'C');
         $pdf->Cell(20,($line*$cellHeight),$row['total'],0,0,'C');
         $pdf->Cell(20,($line*$cellHeight),$row['dd_discount'],0,0,'C');
         $pdf->Cell(20,($line*$cellHeight),$row['VAT'],0,0,'C');
         $pdf->Cell(20,($line*$cellHeight),$row['Ftotal'],0,0,'C');
         $pdf->Ln();
         }

        $query4=mysqli_query($db,"select FTotal from delivery_details_total_view where m_id='$m_id'")or die(mysqli_error());
        $row4=mysqli_fetch_array($query4);
        $FTotal = $row4['FTotal'];

        $query5=mysqli_query($db,"select * from deli_after_dis_view where m_id='$m_id' and deli_id='$deli_id'")or die(mysqli_error());
        $row5=mysqli_fetch_array($query5);

         $pdf->SetFont('Times','',12);
         $pdf->Cell(20,8,$row5['p_disc'].'% Disc = '.$row5['ptdisc'],0,0,'');
         $pdf->Cell(170,8,'Total : '.$FTotal,0,0,'R');
         $pdf->Ln();

         $pdf->SetFont('Times','',12);
         $pdf->Cell(20,8,'Discount = '.$row5['deli_discount'],0,0,'');
         $pdf->Cell(170,8,'Payable Amount : '.$row5['GRAND Total'],0,0,'R');
         $pdf->Ln();

         $pdf->SetFont('Times','',12);
         $pdf->Cell(20,8,$row5['pvat'].'% VAT = '.$row5['vat'],0,0,'');
         $pdf->Cell(170,8,'Paid : '.$row5['paid_amount'],0,0,'R');
         $pdf->Ln();

         $pdf->SetFont('Times','B',12);
         $pdf->Cell(155,10,"",0,0,'C');
         $pdf->Cell(35,8,'DUE : '.$row5['DUE'],0,0,'R');
         $pdf->Ln();

    $pdf->SetFont('Arial','I',10);
    $pdf->Cell(0,10,'Company name, Company address, Phone number, Email address',0,0,'C');

    $pdf->output();
    $print = $pdf->output();
?>

