<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
if(empty($_SESSION['branch'])):
echo "<script>document.location='../index.php'</script>";
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
  <body class="hold-transition layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <!-- Main content -->
          <section class="content" style="min-height: 560px;">
            <div class="col-md-12">
			  <div class="box box-primary angel">
				<div class="box-header">
				  <h3 class="box-title">Select Date</h3>
				</div>
				<div class="box-body">
				  <!-- /.form group -->
				  <form method="post">
					<div class="form-group col-md-6" style="margin-top: -5px;">
						<label>Date range:</label>
						<div class="input-group">
						  <div class="input-group-addon">
							
						  </div>
						<input type="text" name="date" class="form-control pull-right active" id="reservation" placeholder="Click here to get the calanders" required>
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
		$date=$_POST['date'];
		$date=explode('-',$date);
		$branch=$_SESSION['branch'];		
			$start=date("Y/m/d",strtotime($date[0]));
			$end=date("Y/m/d",strtotime($date[1]));
?>
		<div class="col-md-12">
			<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Order NO.</th>
                        <th>Order Date</th>
                        <th>Trans. ID</th>
                        <th>Order Discount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

<?php
	$query=mysqli_query($con,"select * from tbl_order where date_order>='$start' and date_order<='$end'")or die(mysqli_error($con));
		while($row=mysqli_fetch_array($query)){
?>
        <tr>
            <td><?php echo $row['id_order'];?></td>
            <td><?php echo $row['date_order'];?></td>
            <td><?php echo $row['trans_id'];?></td>
            <td><?php echo $row['order_discount'];?></td>
            <td><a href="date_wise_order_view.php?id_order=<?php echo $row['id_order'];?>">View</a></td>   
 <?php } ?>                       
        </tr>
    </tbody>
    <tfoot>          
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
    <?php } ?>
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
   