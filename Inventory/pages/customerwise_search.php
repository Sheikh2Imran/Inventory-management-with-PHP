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
    <title>Order Search | <?php include('../dist/includes/title.php');?></title>
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
				  <h3 class="box-title">Select Order ID</h3>
				</div>
				<div class="box-body">
				  <!-- /.form group -->
				  <form method="post" action="">
					<div class="form-group col-md-3">
						<div class="input-group">
						  <input type="text" name="mem_id" class="form-control pull-right active" required>
					   </div>
                <!-- /.input group -->
					</div>
					<button type="submit" class="btn btn-primary" name="display">Display</button>
				</form>
				
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->       
        </div>
<?php
	if (isset($_POST['display'])){
        $mem_id = $_POST['mem_id'];
?>
		<div class="col-md-12">
			<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Transection No.</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Balance</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

<?php
	$query=mysqli_query($con,"select * from member where mem_id='$mem_id'")or die(mysqli_error($con));
        $i=0;
		while($row=mysqli_fetch_array($query)){
            $i++;
?>
        <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row['mem_name'];?></td>
            <td><?php
            $mem_id=$row['mem_id'];
            $query1=mysqli_query($con,"select * from member_status_view where  member_id='$mem_id'")or die(mysqli_error($con));
            $row1=mysqli_fetch_array($query1);
            echo $row1['member_status'];
            ?></td>
            <td><?php echo $row1['trans_id'];?></td>  
			<td><?php 
            $trans_id = $row1['trans_id'];
            $query2=mysqli_query($con,"select credit from credit_view where     credit_view_id='$trans_id'")or die(mysqli_error($con));
            $row2=mysqli_fetch_array($query2);
            echo $row2['credit'];
            ?></td> 
            <td><?php 
            $trans_id = $row1['trans_id'];
            $query3=mysqli_query($con,"select debit from debit_view where debit_view_id='$trans_id'")or die(mysqli_error($con));
            $row3=mysqli_fetch_array($query3);
            echo $row3['debit'];
            ?></td> 
            <td><?php
            $Balance = $row3['debit']-$row2['credit'];
            echo $Balance.".00";
            ?></td> 
            <td><?php 
            $trans_id = $row1['trans_id'];
            if ($row1['member_status'] == "customer") { ?>
                <a href="addOrder_buyer.php?trans_id=<?php echo $trans_id;?>">View</a>
            <?php }else { ?>
            <a href="addOrder_buyer.php?trans_id=<?php echo $trans_id;?>">View</a>
            <?php } ?>
            </td>  
 <?php } ?>                       
        </tr>
    </tbody>
    </table>
</div>
<?php } ?>
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
