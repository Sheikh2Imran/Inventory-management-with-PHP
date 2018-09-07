<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Incomplete Order</title>
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
    <style type="text/css">
        body { font-size: 120%; }
    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper" style="min-height: 60px">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header" style="text-transform: uppercase;font-weight: bold;line-height: 20px;">
            <h1>
              <a class="btn btn-lg btn-warning" href="home.php">Back</a>
            </h1>
            <center><b><h3 style="margin-top: -40px;">Incomplete Order List</h3></center></b>
            <ol class="breadcrumb">
              <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Incomplete Order</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content" style="min-height: 500px">
            <div class="row">
            <div class="col-md-2">
            </div><!-- /.col (right) -->
            <div class="col-md-8">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Incomplete Order List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Order ID</th>
                        <th>Member ID</th>
                        <th>Company</th>
                        <th>Mobile</th>
                        <th>Ordered Date</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
    <?php
        $query=mysqli_query($con,"select * from incomplete_order_view")or die(mysqli_error());
            while($row=mysqli_fetch_array($query)){
    ?>
            <tr> 
                <td><?php echo $row['order_id'];?></td>   
                <td><?php echo $row['m_id'];?></td>
                <td><?php echo $row['company'];?></td>
                <td><?php echo $row['Mobile'];?></td>
                <td><?php echo $row['order_date'];?></td>
                <td><?php echo $row['status'];?></td>
                <td><?php echo $row['Description'];?></td>
                <td>
                <?php $order_id= $row['order_id'];?>
                <a href="productOrder.php?order_id=<?php echo $row['order_id'];?>&m_id=<?php echo $row['m_id'];?>">Edit</a> 
                ||
                <?php $order_id= $row['order_id'];?>
                <a onclick="return confirm('Are you sure to Remove this order?');" href="cancel_incomplete_order.php?order_id=<?php echo $row['order_id'];?>">Remove</a> 
            </td>
            </tr>
    <?php } ?>
                    </tbody>
                  </table> 
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->
            <div class="col-md-2">
            </div><!-- /.col (right) -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>