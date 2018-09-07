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
    <title>Order Search</title>
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
        font-style: none;
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
            <center><b><h3 style="margin-top: -10px;">Order Search</h3></center>
            <div class="col-md-12">
			  <div class="box box-primary angel">
				<div class="box-header">
				  <h3 class="box-title"></h3>
				</div>
				<div class="box-body">
				  <!-- /.form group -->
                  <div class="col-md-12">
				  <form method="post" action="">
                    <div class="form-group col-md-3" style="margin-top: -5px;">
                        <label for="exampleFormControlSelect1">Member Status</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="status">
                            <option value="">Select Member Status</option>
                            <option value="buy">Supplier</option>
                            <option value="sell">Customer</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3" style="margin-top: -5px;">
                        <label for="exampleFormControlSelect1">Member ID</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="m_id">
                        <option value="">ALL</option>
                    <?php
                        $query=mysqli_query($con,"SELECT m_id FROM order_view GROUP BY m_id");
                            while($row=mysqli_fetch_array($query)){
                    ?>
                            <option value="<?php echo $row['m_id'];?>"><?php echo $row['m_id'];?></option>
                    <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3" style="margin-top: -5px;">
                        <label>Select your Date range:</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                          </div>
                        <input type="text" name="order_date" class="form-control pull-right active" id="reservation" required="" placeholder="Click here to select date" />
                    </div>
                    </div>
                    <div class="form-group col-md-2" style="margin-top: -5px;">
                        <label for="exampleFormControlSelect1">Order Status</label>
                        <select required class="form-control" id="exampleFormControlSelect1" name="Process">
                            <option value="">Select Status</option>
                            <option value="ok">Ok</option>
                            <option value="Incomplete">Incomplete</option>
                            <option value="Empty">Empty</option>
                        </select>
                    </div>
					<button type="submit" name="display" style="margin-top: 20px;" class="btn btn-primary" >DISPLAY</button>
				</form>
				</div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->       
        </div>
		<div class="col-md-12">
			<table id="example1" class="table table-bordered table-striped" style="background-color: white;">
                    <thead>
                      <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Member ID</th>
                        <th>Company</th>
                        <th>Mobile</th>
                        <th>Description</th>
                        <th>Delivery</th>
                        <th>Process</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
    if (isset($_POST['display'])){
        $status=mysqli_real_escape_string($con, $_POST['status']);
        $m_id=mysqli_real_escape_string($con, $_POST['m_id']);
        $order_date=mysqli_real_escape_string($con, $_POST['order_date']);
        $order_date=explode('-',$order_date);       
            $start=date("Y/m/d",strtotime($order_date[0]));
            $end=date("Y/m/d",strtotime($order_date[1]));
        $Process=mysqli_real_escape_string($con, $_POST['Process']);
        if ($m_id == NULL){
            $query=mysqli_query($con,"SELECT * FROM order_view WHERE status='$status' AND Process='$Process' AND (order_date>='$start' AND order_date<='$end')");
        }elseif($m_id == NULL && $status == NULL) {
            $query=mysqli_query($con,"SELECT * FROM order_view WHERE Process='$Process' AND (order_date>='$start' AND order_date<='$end')");
        }else{
            $query=mysqli_query($con,"SELECT * FROM order_view WHERE status='$status' AND m_id='$m_id' AND Process='$Process' AND (order_date>='$start' AND order_date<='$end')");
        }
}else { 
    $query=mysqli_query($con,"select * from order_view order by order_id");
}
		while($row=mysqli_fetch_array($query)){
?>
        <tr>
            <td><?php echo $row['order_id'];?></td>
            <td><?php echo $row['order_date'];?></td>
            <td><?php echo $row['status'];?></td>
            <td><?php echo $row['m_id'];?></td>
            <td><?php echo $row['company'];?></td>
            <td><?php echo $row['Mobile'];?></td>
            <td><?php echo $row['Description'];?></td>
            <td><?php echo $row['Delivery'];?></td>
            <td><?php echo $row['Process'];?></td>
            <td>
                <?php $order_id= $row['order_id'];?>
                <?php $m_id= $row['m_id'];?>
                <?php $Process= $row['Process'];?>
                <?php if($Process == "ok"){ ?>
                <a href="productOrderView.php?order_id=<?php echo $order_id;?>&m_id=<?php echo $m_id;?>" target="_blank">View</a> 
                ||
                <?php } if($Process == "Incomplete"){ ?>
                <a href="productOrder.php?order_id=<?php echo $order_id;?>&m_id=<?php echo $m_id;?>" target="_blank">Edit</a> 
                <?php }else { ?>
                <a href="deli_order_page.php?order_id=<?php echo $order_id;?>&m_id=<?php echo $m_id;?>" target="_blank">D.Status</a> 
                <?php } if($Process == "ok"){ ?>
                ||
                <a onclick="return confirm('Are you sure to create delivery?');" href="create_delivery.php?order_id=<?php echo $order_id;?>&m_id=<?php echo $m_id;?>" target="_blank"> Delivery</a>
                ||
                <?php } if($Process == "ok"){ ?>
                <a href="form/productOrder_invoice.php?order_id=<?php echo $order_id;?>" target="_blank">PDF</a> 
                <?php } ?>
            </td>                          
        </tr>
 <?php } ?> 
        </tbody>
    </table>
</div>
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
   