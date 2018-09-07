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
    <title>Memberwise Delivery Search</title>
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
          <section class="content" style="min-height: 530px;">
            <center><b><h3 style="margin-top: 10px;">Memberwise delivery search</h3></center></b>
            <div class="col-md-12">
              <div class="box box-primary angel">
                <div class="box-header">
                  <h3 class="box-title"></h3>
                </div>
                <div class="box-body" style="margin-left: 300px;">
                  <!-- /.form group -->
                  <form method="post" action="">
                    <div class="form-group col-md-6" style="margin-top: -5px;">
                        <label for="exampleFormControlSelect1">Select member from the box : </label>
                        <select class="form-control" id="exampleFormControlSelect1" name="m_id">
                            <option value="">Please select any member</option>
                <?php
                    $query=mysqli_query($con,"SELECT DISTINCT * FROM member");
                        while($row=mysqli_fetch_array($query)){
                ?>
                        <option value="<?php echo $row['m_id'];?>"><?php echo $row['m_company']."-".$row['m_name'];?></option>
                    <?php } ?>
                        </select>
                    </div>
                    <br/>
                    <button type="submit" class="btn btn-primary" name="display">Display</button>
                </form>
            </div>
          </div>     
        </div>
<?php
if (isset($_POST['display'])){
?>
		<div class="col-md-12">
			<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Delivery ID</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th style="text-align: right;">Grand Total</th>
                        <th style="text-align: right;">Paid Amount</th>
                        <th style="text-align: right;">DUE</th>
                        <th style="text-align: right;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php 
    $m_id=mysqli_real_escape_string($con, $_POST['m_id']);
    $query=mysqli_query($con,"select * from delivery_view where m_id='$m_id'");
        $total_bill=0;
        $total_paid=0;
        $total_due=0;
        while($row=mysqli_fetch_array($query)){
            $total_bill = $total_bill+$row['Grand'];
            $total_paid = $total_paid+$row['paid'];
            $total_due  = $total_due+$row['DUE'];
?>
        <tr>
            <td><?php echo $row['deli_id'];?></td>
            <td><?php echo $row['deli_date'];?></td>
            <td><?php echo $row['status'];?></td>
            <td><?php echo $row['Description'];?></td>
            <td style="text-align: right;"><?php echo $row['Grand'];?></td>
            <td style="text-align: right;"><?php echo $row['paid'];?></td>
            <td style="text-align: right;"><?php echo $row['DUE'];?></td>
            <td style="text-align: right;"><a href="memberwise_delivery_view.php?deli_id=<?php echo $row['deli_id'];?>">View details</a></td>
    <?php } ?>                         
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: right;"><b>TOTAL : </b></td>
            <td style="text-align: right;"><b><?php echo $total_bill;?></b></td>
            <td style="text-align: right;"><b><?php echo $total_paid;?></b></td>
            <td style="text-align: right;"><b><?php echo $total_due;?></b></td>
            <td></td>  
            <td></td>                     
        </tr>
    </tbody>
    <?php }else{ ?>
    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Delivery ID</th>
                        <th>Date</th>
                        <th>Member Name</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th style="text-align: right;">Grand Total</th>
                        <th style="text-align: right;">Paid Amount</th>
                        <th style="text-align: right;">DUE</th>
                        <th style="text-align: right;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
    <?php 
        $query=mysqli_query($con,"select * from delivery_view");
        $total_bill=0;
        $total_paid=0;
        $total_due=0;
        while($row=mysqli_fetch_array($query)){
            $total_bill = $total_bill+$row['Grand'];
            $total_paid = $total_paid+$row['paid'];
            $total_due  = $total_due+$row['DUE'];
    ?>
        <tr>
            <td><?php echo $row['deli_id'];?></td>
            <td><?php echo $row['deli_date'];?></td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['status'];?></td>
            <td><?php echo $row['Description'];?></td>
            <td style="text-align: right;"><?php echo $row['Grand'];?></td>
            <td style="text-align: right;"><?php echo $row['paid'];?></td>
            <td style="text-align: right;"><?php echo $row['DUE'];?></td>
            <td style="text-align: right;"><a href="memberwise_delivery_view.php?deli_id=<?php echo $row['deli_id'];?>">View details</a></td>
    <?php } ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: right;"><b>TOTAL : </b></td>
            <td style="text-align: right;"><b><?php echo $total_bill;?></b></td>
            <td style="text-align: right;"><b><?php echo $total_paid;?></b></td>
            <td style="text-align: right;"><b><?php echo $total_due;?></b></td>
            <td></td>  
            <td></td>                       
        </tr>
    </tbody>  
 <?php } ?>
    </table>
	</div>
   </section><!-- /.content -->
  </div><!-- /.container -->
</div><!-- /.content-wrapper -->
<?php include('../dist/includes/footer.php');?>