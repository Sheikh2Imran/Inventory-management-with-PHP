<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
if(empty($_SESSION['branch'])):
echo "<script>document.location='../index.php'</script>";
endif;
?>

<?php 
    if(!isset($_GET['deli_order_id'])){
        echo "<script>location.href = 'deli_order_page.php';</script>";
    }else{
        $deli_order_id=$_GET['deli_order_id'];
        $id_order=$_GET['id_order'];
        $trans_id=$_GET['trans_id'];
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
      <div class="content-wrapper" style="min-height: 540px;">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
                <a class="btn btn-lg btn-warning" href="deli_order_page.php?id_order=<?php echo $id_order;?>&trans_id=<?php echo $trans_id;?>">Back</a>
            </h1>  
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Viewing delivery details</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
            <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Delivery List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Product name</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
    <?php
        $query1=mysqli_query($con,"select * from deli_purchase where deli_order_id='$deli_order_id'")or die(mysqli_error());
        $i=0;
        while($row1=mysqli_fetch_array($query1)){
            $i++;
    ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php $prod_id = $row1['prod_id'];
                    $query = mysqli_query($con,"select prod_name from product where prod_id='$prod_id'")or die(mysqli_error());
                    $row=mysqli_fetch_array($query);
                    echo $row['prod_name'];
                    ?></td>
                    <td><?php echo $row1['unit_price'];?></td>
                    <td><?php echo $row1['curr_deli_qty'];?></td>
                    <td><?php echo $row1['curr_deli_qty']*$row1['unit_price']; ?></td>
                  </tr>        
    <?php } ?>        
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Grand Total</b></td>
                    <td><?php 
                    $query = mysqli_query($con,"select total_price_view from deli_order_view where deli_order_id='$deli_order_id'")or die(mysqli_error());
                    $row2=mysqli_fetch_array($query);
                    echo $row2['total_price_view'];
                    ?></td>
                </tr>            
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div class="col-md-2"></div>
            <button type="button" class="btn btn-default btn-lg"><a href="form/deli_order_purchase_invoice.php?deli_order_id=<?php echo $deli_order_id;?>&id_order=<?php echo $id_order;?>">Print Bill</a></button>
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
