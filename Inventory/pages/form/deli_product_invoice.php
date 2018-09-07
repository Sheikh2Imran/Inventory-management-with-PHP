<?php
	 $db=mysqli_connect('localhost','root','','inventory');

	if(!isset($_GET['deli_id'])){
        echo "<script>location.href = '../home.php';</script>";
    }else{
        $deli_id=$_GET['deli_id'];
        $order_id=$_GET['order_id'];
        mysqli_query($db,"CALL confirm_delivery('$deli_id',@msg)");
    }

     require("fpdf/fpdf.php");
     $pdf = new FPDF('P','mm','A4');
     $pdf->AliasNbPages();

     $pdf->SetTopMargin(30);
     $pdf->SetRightMargin(20);
     $pdf->AddPage();

     $pdf->SetFont('Times','B',10);
     $date = date('d/m/Y');
     $pdf->Image('logo.jpg',145,10,50);
     $pdf->Cell(20,8,'Today Date : '.$date,0,0,'');
     $pdf->Ln();

     $query3=mysqli_query($db,"select * from delivery_details_view where order_id='$order_id'");
     $row3=mysqli_fetch_array($query3);
     $m_id = $row3['m_id'];
     $status = $row3['status'];

     $query4=mysqli_query($db,"select m_name from member where m_id='$m_id'");
     $row4=mysqli_fetch_array($query4);
     $m_name = $row4['m_name'];

     $pdf->SetTextColor(0, 102, 255);
     $pdf->SetFont('Times','B',12);
     $pdf->Cell(20,8,'Billing TO : ',0,0,'');
     $pdf->Ln(10);

     $pdf->SetFont('Times','',10);
     $pdf->SetTextColor(0,0,0);
     $pdf->Cell(20,8,'Name : '.$m_name,0,0,'');
     $pdf->Cell(170,8,'Member ID : '.$m_id,0,0,'R');
     $pdf->Ln();
     $pdf->Cell(20,8,'Status : '.$status,0,0,'');
     $pdf->Cell(170,8,'Order ID : '.$order_id,0,0,'R');
     $pdf->Ln(15);

	 $pdf->SetFont('Times','B',10);
	 $pdf->Cell(10,8,"SL",0,0,'C');
	 $pdf->Cell(85,8,"Product Name",0,0,'C');
	 $pdf->Cell(15,8,"Unit Price",0,0,'C');
     $pdf->Cell(15,8,"QTY",0,0,'C');
     $pdf->Cell(15,8,"Price",0,0,'C');
     $pdf->Cell(15,8,"Discount",0,0,'C');
     $pdf->Cell(15,8,"VAT",0,0,'C');
	 $pdf->Cell(15,8,"Total",0,0,'C');
	 $pdf->Ln();
		
        $query=mysqli_query($db,"select * from delivery_details_view where deli_id='$deli_id' and order_id='$order_id'");
            $i = 0;
            while($row=mysqli_fetch_array($query)){
                $i++;

 		 $fontSize = 10;
         $pdf->SetFont('Times','',$fontSize);
         $pdf->SetTextColor(0, 0, 0);
         $pdf->Cell(10,8,$i,0,0,'C');
         
         $cellWidth = 85;
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

         $pdf->Cell(15,($line*$cellHeight),$row['prod_price'],0,0,'C');
         $pdf->Cell(15,($line*$cellHeight),$row['dd_qty'],0,0,'C');
         $pdf->Cell(15,($line*$cellHeight),$row['total'],0,0,'C');
         $pdf->Cell(15,($line*$cellHeight),$row['dd_discount'],0,0,'C');
         $pdf->Cell(15,($line*$cellHeight),$row['VAT'],0,0,'C');
         $pdf->Cell(15,($line*$cellHeight),$row['FTotal'],0,0,'C');
         $pdf->Ln();
         }

        $query4=mysqli_query($db,"select * from delivery_view where order_id='$order_id' and deli_id='$deli_id'");
        $row5=mysqli_fetch_array($query4);

         $pdf->SetFont('Times','',8);
         $pdf->Cell(150,8,"",0,0,'C');
         $pdf->Cell(40,8,'Total Price : '.$row5['total'],0,0,'R');
         $pdf->Ln();

         $pdf->SetFont('Times','',8);
         $pdf->Cell(150,8,"",0,0,'C');
         $pdf->Cell(40,8,'- Discount ('.$row5['p_disc'].' %) : '.$row5['per_disc'],0,0,'R');
         $pdf->Ln();

         $pdf->SetFont('Times','',8);
         $pdf->Cell(150,8,"",0,0,'C');
         $pdf->Cell(40,8,'- Overall Discount : '.$row5['o_disc'],0,0,'R');
         $pdf->Ln();

         $pdf->SetFont('Times','',8);
         $pdf->Cell(150,8,"",0,0,'C');
         $pdf->Cell(40,8,'Subtotal : '.$row5['subtotal'],0,0,'R');
         $pdf->Ln();

         $pdf->SetFont('Times','',8);
         $pdf->Cell(150,8,"",0,0,'C');
         $pdf->Cell(40,8,'- Overall VAT ('.$row5['per_vat'].' %) : '.$row5['vat'],0,0,'R');
         $pdf->Ln();

         $pdf->SetFont('Times','',8);
         $pdf->Cell(150,8,"",0,0,'C');
         $pdf->Cell(40,8,'Paid Amount : '.$row5['paid'],0,0,'R');
         $pdf->Ln();

         $pdf->SetFont('Times','',8);
         $pdf->Cell(150,8,"",0,0,'C');
         $pdf->Cell(40,8,'Grand Total : '.$row5['Grand'],0,0,'R');
         $pdf->Ln();

         $DUE = $row5['Grand']-$row5['paid'];
         if ($DUE >=0 ) {
             $pdf->SetFont('Times','B',8);
             $pdf->Cell(150,8,"",0,0,'C');
             $pdf->Cell(40,8,'DUE: '.$DUE,0,0,'R');
         }else{
             $pdf->SetFont('Times','B',8);
             $pdf->Cell(150,8,"",0,0,'C');
             $pdf->Cell(40,8,'CASH BACK: '.-$DUE,0,0,'R');
         }
         $pdf->Ln();

    $pdf->SetFont('Arial','I',10);
    $pdf->Cell(0,10,'Company name, Company address, Phone number, Email address',0,0,'C');

    $pdf->output();
    $print = $pdf->output();
?>

