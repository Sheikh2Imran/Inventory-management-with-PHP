<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
 
    if(!isset($_GET['deli_id'])){
        echo "<script>location.href = 'date_wise_delivery_search.php';</script>";
    }else{
        $deli_id=$_GET['deli_id'];
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Viewing delivery details</title>
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
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');
      include('../dist/includes/dbcon.php');
      ?>
      <!-- Full Width Column -->
      <div class="content-wrapper" style="min-height: 560px">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              <a class="btn btn-lg btn-warning" href="date_wise_delivery_search.php">Back</a>
            </h1>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Viewing Delivery Details</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
            <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Product list of Delivery no - <?php echo $deli_id;?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sl</th>
                        <th>Product name</th>
                        <th>Unit Price</th>
                        <th>Delivered Qty</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>VAT</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
    <?php
        $query1=mysqli_query($con,"select * from delivery_details_view where deli_id='$deli_id'");
            while($row=mysqli_fetch_array($query1)){
    ?>
                  <tr>
                    <td><?php echo $row['dd_id'];?></td>
                    <td><?php 
                    $prod_id = $row['prod_id'];
                    $query=mysqli_query($con,"select prod_name from product where  
                            prod_id='$prod_id'")or die(mysqli_error());
                    $row1=mysqli_fetch_array($query);
                    echo $row1['prod_name'];
                    ?></td>
                    <td><?php echo $row['prod_price'];?></td>
                    <td><?php echo $row['dd_qty'];?></td>
                    <td><?php echo $row['total'];?></td>
                    <td><?php echo $row['dd_discount'];?></td>
                    <td><?php echo number_format((float)$row['VAT'], 2, '.', '');?></td>
                    <td><?php echo number_format((float)$row['FTotal'], 2, '.', '');?></td>
                  </tr>        
    <?php } ?>                    
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div class="col-md-1"></div>
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
   