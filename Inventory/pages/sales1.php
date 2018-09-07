<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
if(empty($_SESSION['branch'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sales Report | <?php include('../dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
      <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <script type="text/javascript" src="../dist/js/jquery.min.js"></script>
<script type="text/javascript" src="../dist/js/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css" />
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="../plugins/daterangepicker/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../plugins/daterangepicker/daterangepicker.css" />
    <style type="text/css">
      h5,h6{
        text-align:center;
      }
		

      @media print {
          .btn-print {
            display:none !important;
		  }
		  .main-footer	{
			display:none !important;
		  }
		  .box.box-primary {
			  border-top:none !important;
		  }
		  .angel{
			  display:none !important;
		  }
          
      }
    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          

          <!-- Main content -->
          <section class="content">
            <div class="col-md-12">
			  <div class="box box-primary angel">
				<div class="box-header">
				  <h3 class="box-title">Select Customer</h3>
				</div>
				<div class="box-body">
				
				  <!-- /.form group -->
				  <form method="post">
					<div class="form-group">

						<div class="input-group">
              <select class="form-control select2" name="cust_id" tabindex="1" autofocus required>
                  <?php
                    $branch=$_SESSION['branch'];
                    include('../dist/includes/dbcon.php');
                     $query2=mysqli_query($con,"select * from customer where branch_id='$branch' order by cust_first")or die(mysqli_error());
                        while($row=mysqli_fetch_array($query2)){
                  ?>
                      <option value="<?php echo $row['cust_id'];?>"><?php echo $row['cust_first']." ".$row['cust_last']; ?></option>
                    <?php }?>
              </select>
					 </div>
                <!-- /.input group -->
					</div>
              <!-- /.form group --><br>
					<button type="submit" class="btn btn-primary" name="display">Display</button>
				</form>
				
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->       
        </div>
<?php
		if (isset($_POST['display'])){
		$cust_id=$_POST['cust_id'];
		$branch=$_SESSION['branch'];
		
?>
		<div class="col-md-12">
		<?php
include('../dist/includes/dbcon.php');

$branch=$_SESSION['branch'];
    $query=mysqli_query($con,"select * from branch where branch_id='$branch'")or die(mysqli_error());
  
        $row=mysqli_fetch_array($query);
        
?>      
                  <h5><b><?php echo $row['branch_name'];?></b> </h5>  
                  <h6>Address: <?php echo $row['branch_address'];?></h6>
                  <h6>Contact #: <?php echo $row['branch_contact'];?></h6>
                  
				  <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
							<a class = "btn btn-primary btn-print" href = "home.php"><i class ="glyphicon glyphicon-arrow-left"></i> Back to Homepage</a>   
						
		
			<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Date Paid</th>
                        <th>Product Code</th>
                        <th>Product</th>
                        <th>Qty</th>
            		        <th>Price</th>
                        <th>Discount</th>
                        <th>Subtotal</th>
                        <th>Cash Payment</th>
                        <th>Due</th>
                        <th>Balance</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
	$query=mysqli_query($con,"select * from sales natural join sales_details natural join product natural join customer where cust_id='$cust_id' and branch_id='$branch' and modeofpayment='cash'")or die(mysqli_error($con));
		$qty=0;$grand=0;$discount=0;$sum=0;$total_qty=0;
								while($row=mysqli_fetch_array($query)){
                $qty=$row['qty'];
                $total=$row['qty']*$row['price'];
								$grand=$grand+$total-$row['discount'];
                $discount=$discount+$row['discount'];
                $balance=$row['cash_tendered']-$row['amount_due'];
                $sum=$balance+$sum;
                $total_qty=$total_qty+$qty;
?>
            <tr>
              <td><?php echo date("M d, Y h:i a",strtotime($row['date_added']));?></td>
              <td><?php echo $row['serial'];?></td>
              <td><?php echo $row['prod_name'];?></td>
              <td><?php echo $row['qty'];?></td>
  						<td><?php echo $row['price'];?></td>
              <td><?php echo $row['discount'];?></td>
              <td><?php echo number_format($row['total'],2); ?></td>
              <td><?php echo $row['cash_tendered'];?></td>
              <td><?php echo $row['amount_due'];?></td> 
              <td><?php echo $sum; ?></td>        
           </tr>
     <?php } ?>
		
                    </tbody>
                    <tfoot>
          <tr>
            <th colspan="8">Total Quantity</th>
            <th style="text-align:right;"><h4><b><?php echo $total_qty." "; ?></b></h4></th>
          </tr> 
          <tr>
            <th colspan="8">Total</th>
            <th style="text-align:right;"><h4><b><?php echo  number_format($grand,2);?></b></h4></th>
          </tr>             
					<tr>
            <th colspan="8">Less: Total Discount</th>
            <th style="text-align:right;"><h4><b><?php echo  number_format($discount,2);?></b></h4></th>
          </tr>   
          
          <tr>
            <th colspan="8">Total Cash Sales</th>
            <th style="text-align:right;"><h4><b><?php echo  number_format(($grand-$discount),2);}?></b></h4></th>
			    </tr>		
          <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr> 
                      <tr>
                        <th>Prepared by:</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr> 
<?php
    $id=$_SESSION['id'];
    $query=mysqli_query($con,"select * from user where user_id='$id'")or die(mysqli_error($con));
    $row=mysqli_fetch_array($query);
 
?>                      
                      <tr>
                        <th><?php echo $row['name'];?></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>  			  
        </tfoot>
       </table>
		</div>
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

    <script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<!-- Select2 -->
	<script src="../plugins/select2/select2.full.min.js"></script>
	<!-- InputMask -->
	<script src="../plugins/input-mask/jquery.inputmask.js"></script>
	<script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<!-- date-range-picker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
	<script src="../plugins/daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap datepicker -->
	<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- bootstrap color picker -->
	<script src="../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
	<!-- bootstrap time picker -->
	<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<!-- SlimScroll 1.3.0 -->
	<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- iCheck 1.0.1 -->
	<script src="../plugins/iCheck/icheck.min.js"></script>
	<!-- FastClick -->
	<script src="../plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="../dist/js/app.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="../dist/js/demo.js"></script>

  </body>
</html>
