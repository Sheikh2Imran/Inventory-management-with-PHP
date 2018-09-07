<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
?>
<!DOCTYPE html>
<html>
  <head>
	 <meta charset="utf-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <title>Home | <?php include('../dist/includes/title.php');?></title>
	 <!-- Tell the browser to be responsive to screen width -->
	 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	 <!-- Bootstrap 3.3.5 -->
	 <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	 <!-- Font Awesome -->
	 <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
	 <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
	 <link rel="stylesheet" href="../plugins/select2/select2.min.css">
	 <!-- AdminLTE Skins. Choose a skin from the css/skins
			folder instead of downloading all of them to reduce the load. -->
	 <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
	 <style>
	 .col-lg-3{
		  margin:50px 0px;
	 }
	 a{
		  text-decoration: none;
		  color: black;
	 }
	 .width-200px{
		  width: 200px;
		  display: inline-block;
	 }
	 .width-150px{
		  width: 150px;
		  display: inline-block;
	 }
	 </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav" onload="myFunction()">
	 <div class="wrapper">
		<?php include('../dist/includes/header.php');?>
		<!-- Full Width Column -->
		<div class="content-wrapper">
		  <div class="container" style="min-height: 550px">
			 <!-- Content Header (Page header) -->
			 <!-- Main content -->
			 <section class="content" style="min-height: 520px;">
				<div class="row">
			<div class="col-md-3">
				  <div class="box box-primary">
					 <div class="box-header with-border">
						<center><h3 class="box-title">Shortcut Buttons Here</h3></center>
					 </div><!-- /.box-header -->
					 <div class="box-body">
						<div class="row" style="margin-left: 20px;">
								<p>
								  <a class="btn btn-primary btn-lg width-200px" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">
									 SELL
								  </a>
								</p>
								<div class="collapse" id="collapse1">
								  <div class="card card-body">
									 <a class="btn btn-info width-150px" href="quick_sell.php" target="_blank">Sell</a></br>
									 <a style="margin-top: 5px;margin-bottom: 5px;" class="btn btn-success width-150px" href="search_member_buyer.php" target="_blank">Sell Using Member</a>
								  </div>
								</div>
								<p>
								  <a class="btn btn-primary btn-lg width-200px" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">
									 BUY
								  </a>
								</p>
								<div class="collapse" id="collapse2">
								  <div class="card card-body">
									 <a class="btn btn-info width-150px" href="quick_buy.php" target="_blank">Buy</a></br>
									 <a style="margin-top: 5px;margin-bottom: 5px;" class="btn btn-success width-150px" href="search_member_seller.php" target="_blank">Buy Using Member</a>
								  </div>
								</div>
								<p>
								  <a class="btn btn-primary btn-lg width-200px" data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapse3">
									 ORDER
								  </a>
								</p>
								<div class="collapse" id="collapse3">
								  <div class="card card-body">
									 <a class="btn btn-info width-150px" href="search_Order_seller.php" target="_blank">Buy</a></br>
									 <a style="margin-top: 5px;margin-bottom: 5px;" class="btn btn-success width-150px" href="search_Order_buyer.php" target="_blank">Sell</a>
								  </div>
								</div>
								<p>
								  <a class="btn btn-primary btn-lg width-200px" data-toggle="collapse" href="#collapse4" role="button" aria-expanded="false" aria-controls="collapse4">DELIVERY</a>
								</p>
								<div class="collapse" id="collapse4">
								  <div class="card card-body">
									 <a style="margin-top: 5px;margin-bottom: 5px;" class="btn btn-success width-150px" href="member_delivery_buy.php" target="_blank">Supplier</a></br>
									 <a class="btn btn-info width-150px" href="member_delivery_sell.php" target="_blank">Customer</a>
								  </div>
								</div>
								<p>
								  <a class="btn btn-primary btn-lg width-200px" data-toggle="collapse" href="#collapse5" role="button" aria-expanded="false" aria-controls="collapse4">LEDGER</a>
								</p>
								<div class="collapse" id="collapse5">
								  <div class="card card-body">
									 <a style="margin-top: 5px;margin-bottom: 5px;" class="btn btn-success width-150px" href="first_ledger_supplier.php">Supplier</a></br>
									 <a class="btn btn-info width-150px" href="first_ledger_customer.php">Customer</a>
								  </div>
								</div>
								<p>
								  <a class="btn btn-primary btn-lg width-200px" data-toggle="collapse" href="#collapse6" role="button" aria-expanded="false" aria-controls="collapse4">INCOMPLETE</a>
								</p>
								<div class="collapse" id="collapse6">
								  <div class="card card-body">
									 <a class="btn btn-info width-150px" href="incomplete_order.php"> Order</a></br>
									 <a style="margin-top: 5px;margin-bottom: 5px;" class="btn btn-success width-150px" href="incomplete_delivery.php">Delivery</a>
								  </div>
								</div>
								<p>
								  <a class="btn btn-primary btn-lg width-200px" data-toggle="collapse" href="#collapse7" role="button" aria-expanded="false" aria-controls="collapse5">PRODUCT</a>
								</p>
								<div class="collapse" id="collapse7">
								  <div class="card card-body">
									 <a class="btn btn-info width-150px" href="product.php">Info</a></br>
									 <a style="margin-top: 5px;margin-bottom: 5px;" class="btn btn-success width-150px" href="stock.php">Stock</a>
								  </div>
								</div>
								<p>
								  <a class="btn btn-primary btn-lg width-200px" data-toggle="collapse" href="#collapse8" role="button" aria-expanded="false" aria-controls="collapse6">EXTRA</a>
								</p>
								<div class="collapse" id="collapse8">
								  <div class="card card-body">
									 <a class="btn btn-info width-150px" href="refund.php">Refund</a></br>
									 <a style="margin-top: 5px;margin-bottom: 5px;" class="btn btn-success width-150px" href="borrow.php">Borrow</a>
								  </div>
								</div>
						</div>
					 </div>
				  </div>
				</div>
		  <div class="col-md-6">
		  	<?php
    $query=mysqli_query($con,"select sum(daily_sell_taka) as daily_sell_taka,sum(daily_buy_taka) as 'daily_buy_taka',sum(monthly_sell_taka) as 'monthly_sell_taka',sum(monthly_buy_taka) as 'monthly_buy_taka',sum(yearly_sell_taka) as 'yearly_sell_taka',sum(yearly_buy_taka) as 'yearly_buy_taka' from product_stock_view");
        $result = mysqli_fetch_assoc($query);
?>
			<div class="row">
		  		<div class="box box-primary">
		  		<div class="col-md-4">
		  			<div class="card text-white bg-danger mb-3" style="max-width: 150px;padding:10px;margin: 5px;">
					  <div class="card-header"></div>
					  <div class="card-body">
					    <h5 class="card-title">
					    	Today Sell : <?php 
					    	$daily_sell_taka = $result['daily_sell_taka'];
					    	if ($daily_sell_taka == NULL) {
					    		echo "0.00";
					    	}else{
					    		echo $daily_sell_taka;
					    	}
					    	?>
					    </h5>
					    <h5 class="card-title">Today Buy : <?php 
					     $daily_buy_taka = $result['daily_buy_taka'];
					     	if ($daily_buy_taka == NULL) {
					    		echo "0.00";
					    	}else{
					    		echo $daily_buy_taka;
					    	}
					    	?>
					     </h5>
					  </div>
					</div>
				</div>
				<div class="col-md-4">
		  			<div class="card text-white bg-success mb-3" style="max-width: 150px;padding:10px;margin: 5px;">
					  <div class="card-header"></div>
					  <div class="card-body">
					    <h5 class="card-title">Monthly Sell : 
					    	<?php $monthly_sell_taka = $result['monthly_sell_taka'];
					    	if ($monthly_sell_taka == NULL) {
					    		echo "0.00";
					    	}else{
					    		echo $monthly_sell_taka;
					    	}
					    	?>
					    </h5>
					    <h5 class="card-title">Monthly Buy : 
					    	<?php $monthly_buy_taka = $result['monthly_buy_taka'];
					    	if ($monthly_buy_taka == NULL) {
					    		echo "0.00";
					    	}else{
					    		echo $monthly_buy_taka;
					    	}
					    	?>	
					    </h5>
					  </div>
					</div>
				</div>
				<div class="col-md-4">
		  			<div class="card text-white bg-danger mb-3" style="max-width: 150px;padding:10px;margin: 5px;">
					  <div class="card-header"></div>
					  <div class="card-body">
					    <h5 class="card-title">Yearly Sell : 
					    	<?php $yearly_sell_taka = $result['yearly_sell_taka'];
					    	if ($yearly_sell_taka == NULL) {
					    		echo "0.00";
					    	}else{
					    		echo $yearly_sell_taka;
					    	}
					    	?>	
					    </h5>
					    <h5 class="card-title">Yearly Buy : 
					    	<?php $yearly_buy_taka = $result['yearly_buy_taka'];
					    	if ($yearly_buy_taka == NULL) {
					    		echo "0.00";
					    	}else{
					    		echo $yearly_buy_taka;
					    	}
					    	?>
					    </h5>
					  </div>
					</div>
				</div>
			  </div>
			</div>
			</br>
			<table class="table table-hover table-dark" style="background-color: #95a5a6;">
				  <thead>
				    <tr>
				      <th scope="row">Dashboard</th>
				      <th></th>
				      <th></th>
				      <th></th>
				    </tr>
				  </thead>
				  <tbody>
<?php
   $query1=mysqli_query($con,"select count(status) as 'customer' from order_view where status='sell'");
    $result1 = mysqli_fetch_assoc($query1);
?>
				    <tr>
				      <th scope="row">#</th>
				      <td>Total Customer</td>
				      <td>=</td>
				      <td style="color: red"><?php echo $result1['customer'];?></td>
				    </tr>
<?php
    $query2=mysqli_query($con,"select count(status) as 'supplier' from order_view where status='buy'");
    $result2 = mysqli_fetch_assoc($query2);
?>
				    <tr>
				      <th scope="row">#</th>
				      <td>Total Supplier</td>
				      <td>=</td>
				      <td style="color: red"><?php echo $result2['supplier'];?></td>
				    </tr>
<?php
    $query3=mysqli_query($con,"select count(Delivery) as 'pending' from order_view where Delivery='Pending'");
    $result3 = mysqli_fetch_assoc($query3);
?>
				    <tr>
				      <th scope="row">#</th>
				      <td>Pending Order</td>
				      <td>=</td>
				      <td style="color: red"><?php echo $result3['pending'];?></td>
				    </tr>
<?php
    $query4=mysqli_query($con,"select count(Process) as 'Incomplete' from order_view where Process='Incomplete'");
    $result4 = mysqli_fetch_assoc($query4);
?>
				    <tr>
				      <th scope="row">#</th>
				      <td>Incomplete Order</td>
				      <td>=</td>
				      <td style="color: red"><?php echo $result4['Incomplete'];?></td>
				    </tr>
				  </tbody>
				</table>
		  </div>
		  <div class="col-md-3">
				  <!-- About Me Box -->
				  <div class="box box-primary">
					 <div class="box-header with-border">
						<h3 class="box-title">About Us</h3>
					 </div><!-- /.box-header -->
<?php
	 $branch=$_SESSION['branch'];
	 $query=mysqli_query($con,"select * from branch where branch_id='$branch'");
		$row=mysqli_fetch_array($query);	
?>
					 <div class="box-body">
						<strong><i class="glyphicon glyphicon-map-marker margin-r-5"></i> Company Address</strong>
						<p class="text-muted">
						  <?php echo $row['branch_address'];?>
						</p>
						<hr>
						<strong><i class="glyphicon glyphicon-phone-alt margin-r-5"></i> Contact Number/s</strong>
						<p class="text-muted"><?php echo $row['branch_contact'];?></p>
						<hr>
					 </div><!-- /.box-body -->
				  </div><!-- /.box -->
				</div>  
			 </div><!-- /.row -->
			 </section><!-- /.content -->
		  </div><!-- /.container -->
		</div><!-- /.content-wrapper -->
<?php include('../dist/includes/footer.php');?>
