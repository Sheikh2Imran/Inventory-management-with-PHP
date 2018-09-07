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
    <title>Profit Report</title>
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
            <center><b><h3 style="margin-top: -5px;">Datewise profit report within a date range</h3></center></b>
            <div class="col-md-12">
              <div class="box box-primary angel">
                <div class="box-header">
                  <h3 class="box-title"></h3>
                </div>
                <div class="box-body">
                  <!-- /.form group -->
                  <div class="col-md-3"></div>
                  <div class="col-md-9">
                  <form method="post">
                    <div class="form-group col-md-6" style="margin-top: -25px;">
                        <label>Please selece date range:</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                          </div>
                        <input type="text" name="date" class="form-control pull-right active" id="reservation" placeholder="Click here to get the calanders" required>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="display">Display</button>
                </form>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->       
        </div>
<?php
	if (isset($_POST['display'])){
		$date=mysqli_real_escape_string($con, $_POST['date']);
		$date=explode('-',$date);
		$branch=$_SESSION['branch'];		
			$start=date("Y/m/d",strtotime($date[0]));
			$end=date("Y/m/d",strtotime($date[1]));
?>
		<div class="col-md-12">
			<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Total Sell</th>
                        <th>Total Buy</th>
                        <th>Given Expense</th>
                        <th>Given Salary</th>
                        <th>Total Income</th>
                        <th>Total Expense</th>
                        <th>YOUR PROFIT</th>
                      </tr>
                    </thead>
                    <tbody>

<?php
	$query=mysqli_query($con,"select * from daily_profit_view where daily_date>='$start' and daily_date<='$end'");
        $expense=0;
        $salary=0;
        $total_income=0;
        $total_expense=0;
        $profit=0;
		while($row=mysqli_fetch_array($query)){
            $expense=$expense+$row['expense'];
            $salary=$salary+$row['salary'];
            $total_income=$total_income+$row['total_income'];
            $total_expense=$total_expense+$row['total_expense'];
            $profit=$profit+$row['profit'];
?>
        <tr>
            <td><?php echo $row['daily_date'];?></td>
            <td><?php echo $row['sell'];?></td>
            <td><?php echo $row['buy'];?></td>
            <td><?php echo $row['expense'];?></td>
            <td><?php echo $row['salary'];?></td>
            <td><?php echo $row['total_income'];?></td>
            <td><?php echo $row['total_expense'];?></td>
            <td><?php echo $row['profit'];?></td>                         
        </tr>
 <?php } ?> 
        <tr>
            <td></td>
            <td></td>
            <td><b>TOTAL : </b></td>
            <td><b><?php echo $expense;?></b></td>
            <td><b><?php echo $salary;?></b></td>
            <td><b><?php echo $total_income;?></b></td>
            <td><b><?php echo $total_expense;?></b></td>
            <td><b><?php echo $profit;?></b></td>
        </tr>
    </tbody>
    <tfoot> 
<?php
    $id=$_SESSION['id'];
    $query=mysqli_query($con,"select * from user where user_id='$id'")or die(mysqli_error($con));
    $row=mysqli_fetch_array($query);
 
?>                      
          <tr>
            <th>Prepared By :</th>
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
    