<?php
	$db=mysqli_connect('localhost','root','','inventory');
	if(!isset($_GET['deli_id'])){
        echo "<script>location.href = '../home.php';</script>";
    }else{
        $deli_id=$_GET['deli_id'];
    }
    mysqli_query($db,"CALL confirm_delivery('$deli_id',@msg)"); 
	 	
	 require("fpdf/fpdf.php");
	 $pdf = new FPDF('P','mm','A4');
	 $pdf->AliasNbPages();

     $pdf->SetTopMargin(30);
     $pdf->SetLeftMargin(5);
     $pdf->SetRightMargin(30);
     $pdf->AddPage();

     $pdf->SetFont('Times','B',10);
     $date = date('d/m/Y');
     $pdf->Image('logo.jpg',150,10,50);
     $pdf->Cell(0,8,'Today Date : '.$date,0,0,'');
     $pdf->Ln();

     $query3=mysqli_query($db,"select * from create_delivery where deli_id='$deli_id'")or die(mysqli_error());
     $row3=mysqli_fetch_array($query3);

     $pdf->SetTextColor(0, 102, 255);
     $pdf->SetFont('Times','B',10);
     $pdf->Cell(0,8,'Billing TO: ',0,0,'');
     $pdf->Ln(10);

     $pdf->SetFont('Times','',10);
     $pdf->SetTextColor(0,0,0);
     $pdf->Cell(20,8,'Order ID : '.$row3['order_id'],0,0,'');
     $pdf->Cell(180,8,'Order Date : '.$row3['deli_date'],0,0,'R');
     $pdf->Ln();
     $pdf->Cell(20,8,'Status : '.$row3['buy_sell_status'],0,0,'');
     $pdf->Cell(180,8,'Member ID : '.$row3['m_id'],0,0,'R');
     $pdf->Ln(15);

     $pdf->SetFont('Times','B',10);
     $pdf->SetTextColor(0,0,0);
     $pdf->Cell(5,8,"SL",0,0,'C');
     $pdf->Cell(90,8,"Product Name",0,0,'C');
     $pdf->Cell(15,8,"Unit Price",0,0,'L');
     $pdf->Cell(15,8,"Qty",0,0,'C');
     $pdf->Cell(15,8,"Total",0,0,'C');
     $pdf->Cell(15,8,"Discount",0,0,'L');
     $pdf->Cell(15,8,"VAT",0,0,'C');
     $pdf->Cell(30,8,"Price",0,0,'C');
     $pdf->Ln();
		
 	$query=mysqli_query($db,"select * from delivery_details_view where deli_id='$deli_id'");
    $i=0;
 	while($row=mysqli_fetch_array($query)){
        $i++;
 		 $fontSize = 10;
         $pdf->SetFont('Times','',$fontSize);
         $pdf->SetTextColor(0, 0, 0);
         $pdf->Cell(10,8,$i,0,0,'C');

         $cellWidth = 90;
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

         $pdf->Cell(15,($line*$cellHeight),$row['prod_price'],0,0,'L');
         $pdf->Cell(15,($line*$cellHeight),$row['dd_qty'],0,0,'L');
         $pdf->Cell(15,($line*$cellHeight),$row['total'],0,0,'L');
         $pdf->Cell(15,($line*$cellHeight),$row['dd_discount'],0,0,'L');
         $pdf->Cell(15,($line*$cellHeight),$row['VAT'],0,0,'L');
         $pdf->Cell(30,($line*$cellHeight),$row['FTotal'],0,0,'L');
         $pdf->Ln();
    }

    $query2=mysqli_query($db,"select * from delivery_view where deli_id='$deli_id'");
	     $row=mysqli_fetch_array($query2);

         $pdf->SetFont('Times','',8);
         $pdf->Cell(150,8,"",0,0,'C');
         $pdf->Cell(45,8,'Total Price : '.$row['total'],0,0,'R');
         $pdf->Ln();

         $pdf->SetFont('Times','',8);
         $pdf->Cell(150,8,"",0,0,'C');
         $pdf->Cell(45,8,'- Discount ('.$row['p_disc'].' %) : '.$row['per_disc'],0,0,'R');
         $pdf->Ln();

     	 $pdf->SetFont('Times','',8);
     	 $pdf->Cell(150,8,"",0,0,'C');
     	 $pdf->Cell(45,8,'Overall Discount : '.$row['o_disc'],0,0,'R');
     	 $pdf->Ln();

         $pdf->SetFont('Times','',8);
         $pdf->Cell(150,8,"",0,0,'C');
         $pdf->Cell(45,8,'Subtotal : '.$row['subtotal'],0,0,'R');
         $pdf->Ln();

         $pdf->SetFont('Times','',8);
         $pdf->Cell(150,8,"",0,0,'C');
         $pdf->Cell(45,8,'- Vat ('.$row['per_vat'].' %) : '.$row['vat'],0,0,'R');
         $pdf->Ln();

         $pdf->SetFont('Times','',8);
         $pdf->Cell(150,8,"",0,0,'C');
         $pdf->Cell(45,8,'Grand Total : '.$row['Grand'],0,0,'R');
         $pdf->Ln();

         $pdf->SetFont('Times','',8);
         $pdf->Cell(150,8,"",0,0,'C');
         $pdf->Cell(45,8,'Paid Amount : '.$row['paid'],0,0,'R');
         $pdf->Ln();

         $pdf->SetFont('Times','B',8);
         $DUE = $row['Grand']-$row['paid'];
         if ($DUE >=0 ) {
             $pdf->Cell(150,8,"",0,0,'C');
             $pdf->Cell(45,8,'DUE: '.$DUE,0,0,'R');
         }else{
             $pdf->Cell(150,8,"",0,0,'C');
             $pdf->Cell(45,8,'CASH BACK: '.-$DUE,0,0,'R');
         }
         
         $pdf->Ln();

    $pdf->SetFont('Arial','I',10);
    $pdf->Cell(0,10,'Company name, Company address, Phone number, Email address',0,0,'C');

    $pdf->output();
    $print = $pdf->output();
?>

