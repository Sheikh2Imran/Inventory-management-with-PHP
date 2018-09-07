<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

include('../dist/includes/dbcon.php');
if(!isset($_GET['m_id']) || $_GET['m_id']==NULL){
    echo "<script> location.href='home.php'; </script>";
}else{
    $m_id = $_GET['m_id'];
    $query = mysqli_query($con,"select * from member where m_id='$m_id'");
    $row=mysqli_fetch_array($query);
    $m_name = $row['m_name'];
    $m_company = $row['m_company'];
    $m_status = $row['m_status'];
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sell To Customer</title>
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
            <h1></h1>
            <center><b><h4>Order List For Sell To <?php echo $m_company."(".$m_name.")"; ?></h4></center></b>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Sell to customer</li>
            </ol>
          </section>
          <section class="content" style="min-height: 500px">
            <div class="row">
            <div class="col-md-10">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Order List</h3>
                </div>
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Order Id</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Company</th>
                        <th>Delivery</th>
                        <th>Process</th>
                        <th>Grand price</th>
                        <th style="text-align: center;">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
    <?php
        $query=mysqli_query($con,"select * from order_view where m_id='$m_id'");
            $i=0;
            while($row=mysqli_fetch_array($query)){
            $i++;
    ?>
            <tr>
                <td><?php echo $row['order_id'];?></td>   
                <td><?php echo $row['order_date'];?></td>
                <td><?php echo $row['status'];?></td>
                <td><?php echo $row['Description'];?></td>
                <td><?php echo $row['company'];?></td>
                <td><?php echo $row['Delivery'];?></td>
                <td><?php echo $row['Process'];?></td>
                <td><?php echo $row['Grand'];?></td>
                <td>
                <?php $order_id= $row['order_id'];?>
                <?php $Process= $row['Process'];?>
                <?php if($Process == "ok"){ ?>
                <a href="seeproduct_deli.php?order_id=<?php echo $order_id;?>&m_id=<?php echo $m_id;?>">View</a> 
                |
                <?php } if($Process == "Incomplete"){ ?>
                <a href="productOrder.php?order_id=<?php echo $order_id;?>&m_id=<?php echo $m_id;?>">Edit</a> 
                <?php } elseif($Process == "ok") { ?>
                <a href="deli_order_page.php?order_id=<?php echo $order_id;?>&m_id=<?php echo $m_id;?>">D.Status</a> 
                <?php } if($Process == "ok"){ ?>
                |
                <a onclick="return confirm('Are you sure to create delivery?');" href="create_delivery.php?order_id=<?php echo $order_id;?>&m_id=<?php echo $m_id;?>"> Delivery</a>
                <?php } if($Process == "ok"){ ?>
                |
                <?php $order_id= $row['order_id'];?>
                <a href="form/productOrder_invoice.php?order_id=<?php echo $order_id;?>">PDF</a> 
                <?php echo "|"; } ?>
                <a onclick="return confirm('Are you sure to delete this order ?');" href="delete_order_buyer.php?order_id=<?php echo $order_id;?>&m_id=<?php echo $m_id;?>">X</a> 
                </td>
            </tr>
    <?php } ?>
                    </tbody>
                  </table> 
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->
            <div class="col-md-2">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title" style="text-align: center;">Create New Order</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
            <form method="POST" action="order_add.php">
                <div class="form-group">
                    <label for="date">Date</label>
                    <div class="input-group col-md-12">
                    <input type="date" name="order_date" value="<?php echo date('Y-m-d'); ?>">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                    <div class="input-group col-md-12">
                    <input type="hidden" name="m_id" value="<?php echo $m_id; ?>">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                    <div class="input-group col-md-12">
                    <input type="hidden" name="buy_sell_status" value="<?php echo $m_status; ?>">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                    <div class="input-group">
                      <button class="btn btn-primary" name="" onclick="return confirm('Are you sure to Crete Order ?');">
                        Create Order
                      </button>
                    </div>
                  </div><!-- /.form group -->
            </form> 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
<?php include('../dist/includes/footer.php');?>