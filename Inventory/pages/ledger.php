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
    <title>Ledger View</title>
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
    td{
        font-size: 12px;
        font-style: normal;
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
            <center><b><h3 style="margin-top: -10px;">Ledger Search</h3></center>
            <div class="col-md-12">
			  <div class="box box-primary angel">
				<div class="box-body">
				  <!-- /.form group -->
                  <div class="col-md-1"></div>
                  <div class="col-md-10">
				  <form method="post" action="">
                    <div class="form-group col-md-4" style="margin-top: -5px;">
                        <label for="exampleFormControlSelect1">Please select status</label>
                        <select required class="form-control" id="exampleFormControlSelect1" name="status">
                            <option value="">Please select supplier/buyer</option>
                            <option value="buy">Supplier</option>
                            <option value="sell">Buyer</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6" style="margin-top: -5px;">
                        <label for="exampleFormControlSelect1">Please select order id</label>
                        <select required class="form-control" id="exampleFormControlSelect1" name="m_id">
                            <option value="">Please select any order id</option>
                <?php
                    $query=mysqli_query($con,"SELECT DISTINCT m_id,name,company FROM delivery_view order by name desc");
                        while($row=mysqli_fetch_array($query)){
                ?>
                        <option value="<?php echo $row['m_id'];?>"><?php echo $row['company']."-".$row['name'];?></option>
                    <?php } ?>
                        </select>
                    </div>
					<button type="submit" name="display" style="margin-top: 20px;" class="btn btn-primary" >SEARCH</button>
				</form>
				</div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->       
        </div>
<?php if (isset($_POST['display'])){ ?>
		<div class="col-md-12">
			<table id="example1" class="table table-bordered table-striped" style="background-color: white;">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Date</th>
                        <th>Details</th>
                        <th style="text-align: right">Debit</th>
                        <th style="text-align: right">Credit</th>
                        <th style="text-align: right">Balance</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
        $status=mysqli_real_escape_string($con, $_POST['status']);
        $m_id=mysqli_real_escape_string($con, $_POST['m_id']);
        if ($status == 'buy') {
        $query = mysqli_query($con,"select * from supplier_ladger_view where m_id='$m_id'");
        }elseif($status == 'sell'){
        $query = mysqli_query($con,"select * from customer_ladger_view where m_id='$m_id'");
        }
        $i=0;
        $total_debit = 0;
        $total_credit = 0;
        $total_balance = 0;
		while($row=mysqli_fetch_array($query)) {
            $i++;
            $total_debit = $total_debit+$row['Debit'];
            $total_credit = $total_credit+$row['Credit'];
            $total_balance = $total_balance+$row['Balance'];
            if ($row['Debit']!=NULL && $row['Credit']!=NULL) {
?>
        <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row['deli_date'];?></td>
            <td><?php echo $row['deli_id'];?></td>
            <td style="text-align: right;"><?php echo $row['Debit'];?></td>
            <td style="text-align: right;"><?php echo $row['Credit'];?></td>
            <td style="text-align: right;"><?php echo $row['Balance'];?></td>                         
        </tr>
 <?php } } ?> 
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-size: 14px;text-align: right"><b>Total Debit = <?php echo $total_debit;?>/-</b></td>
            <td style="font-size: 14px;text-align: right"><b>Total Credit = <?php echo $total_credit;?>/-</b></td>
            <td style="font-size: 14px;text-align: right"><b>Total Balance = <?php echo $total_balance;?>/-</b></td>
        </tr>
        </tbody>
    </table>
</div>
 <?php } ?> 
          </section>
        </div>
      </div>
<?php include('../dist/includes/footer.php');?>
   