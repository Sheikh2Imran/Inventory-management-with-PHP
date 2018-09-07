<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
 
    if(!isset($_GET['transpay_id_view'])){
        echo "<script>location.href = 'home.php';</script>";
    }else{
        $trans_id=$_GET['trans_id'];
        $transpay_id_view=$_GET['transpay_id_view'];
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Viewing payment details</title>
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
      <div class="content-wrapper">
        <div class="container" style="min-height: 560px;">
          <!-- Content Header (Page header) -->
          <section class="content-header">
        <?php 
            $query20=mysqli_query($con,"SELECT * FROM member_status_view WHERE trans_id=$trans_id")or die(mysqli_error());
            $row20=mysqli_fetch_array($query20);
            $member_status = $row20['member_status'];

            if ($member_status == 'supplier') { ?>
            <h1>
            <a class="btn btn-lg btn-warning" href="addOrder_seller.php?trans_id=<?php echo $trans_id;?>">Back</a>
            </h1>  
        <?php } //elseif ($member_status == 'customer') { ?>
            <h1>
            <a class="btn btn-lg btn-warning" href="addOrder_buyer.php?trans_id=<?php echo $trans_id;?>">Back</a>
            </h1> 
        <?php //} ?>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Viewing payment details</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
            <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Payment Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Payment Date</th>
                        <th>Payment Amount</th>
                        <th>Transection ID</th>
                      </tr>
                    </thead>
                    <tbody>
    <?php
        $query1=mysqli_query($con,"select * from transaction_payment where transpay_id='$transpay_id_view'")or die(mysqli_error());
        $i=0;
        while($row1=mysqli_fetch_array($query1)){
            $i++;
    ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row1['pay_date'];?></td>
                    <td><?php echo $row1['payment'];?></td>
                    <td><?php echo $row1['trans_id']; ?></td>
                  </tr>        
    <?php } ?>              
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div class="col-md-2"></div>
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
