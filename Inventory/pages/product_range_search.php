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
    <title>Product Range Search</title>
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
          <section class="content" style="min-height: 520px;">
            <center><b><h3 style="margin-top: -10px;">Product stock search bellow certain number</h3></center></b>
            <div class="col-md-12">
              <div class="box box-primary angel">
                <div class="box-header" style="margin-left: 400px;">
                  <h3 class="box-title">Give the certain amount of product</h3>
                </div>
                <div class="box-body" style="margin-left: 400px;">
                  <!-- /.form group -->
                  <form method="post" action="">
                    <div class="form-group col-md-3">
                        <div class="input-group">
                          <input type="text" name="prod_stock" class="form-control pull-right active" placeholder="Give stock range" required>
                       </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="display">Display</button>
                </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->       
        </div>
<?php if(isset($_POST['display'])){ ?>
		<div class="col-md-12">
			<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Selling Price</th>
                        <th>Buying Price</th>
                        <th>Product Stock</th>
                      </tr>
                    </thead>
                    <tbody>

<?php
    $prod_stock = $_POST['prod_stock'];
	$query=mysqli_query($con,"select * from product_stock_view where prod_stock>='$prod_stock'");
		while ($row=mysqli_fetch_array($query)) {
?>
        <tr>
            <td><?php echo $row['product_name'];?></td>
            <td><?php echo $row['product_code'];?></td>
            <td><?php echo $row['selling_price'];?></td>
            <td><?php echo $row['buying_price'];?></td>
            <td style="color: red;"><?php echo $row['prod_stock'];?></td>                       
        </tr>
<?php } } ?>  
    </tbody>
    <tfoot>  			  
        </tfoot>
       </table>
		</div>
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
<?php include('../dist/includes/footer.php');?>
    