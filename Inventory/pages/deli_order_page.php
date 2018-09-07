<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

    if(!isset($_GET['order_id'])){
        echo "<script>location.href = 'home.php';</script>";
    }else{
        $order_id=$_GET['order_id'];
        $m_id=$_GET['m_id'];
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Delivery List</title>
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
      <div class="content-wrapper" style="min-height: 560px;">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header" style="text-transform: uppercase;font-weight: bold;line-height: 20px;">
        <?php 
            $query=mysqli_query($con,"SELECT * FROM member WHERE m_id='$m_id'");
            $row=mysqli_fetch_array($query);
            $member_status = $row['m_status'];
            if ($member_status == 'supplier') { ?>
            <h1>
            <a class="btn btn-lg btn-warning" href="addOrder_seller.php?m_id=<?php echo $m_id;?>">Back</a>
            </h1>  
        <?php }elseif ($member_status == 'customer') { ?>
            <h1>
            <a class="btn btn-lg btn-warning" href="addOrder_buyer.php?m_id=<?php echo $m_id;?>">Back</a>
            </h1> 
        <?php } ?>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Delivery List of Order No - <?php echo $order_id;?></li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
            <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Delivery List of Order No - <?php echo $order_id;?> & Member ID - <?php echo $m_id;?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Delivery ID</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Grand Total</th>
                        <th>Payment</th>
                        <th>Total DUE</th>
                      </tr>
                    </thead>
                    <tbody>
    <?php
        $query1=mysqli_query($con,"select * from delivery_view where order_id='$order_id' and m_id='$m_id'");
            while($row=mysqli_fetch_array($query1)){
    ?>
                  <tr>
                    <td><?php echo $row['deli_id'];?></td>
                    <td><?php echo $row['deli_date'];?></td>
                    <td><?php echo $row['Description'];?></td>
                    <td><?php echo $row['Grand'];?></td>
                    <td><?php echo $row['paid'];?></td>
                    <td><?php echo $row['DUE'];?></td>
                  </tr>        
    <?php } ?>                    
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
            <div class="col-md-2"></div>
          </div><!-- /.row -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
<?php include('../dist/includes/footer.php');?>
