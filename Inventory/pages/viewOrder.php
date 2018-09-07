<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
if(empty($_SESSION['branch'])):
echo "<script>document.location='../index.php'</script>";
endif;
?>

<?php 
    if(!isset($_GET['memberid']) && $_GET['id_order'] == NULL){
        echo "<script>location.href = 'listbill.php';</script>";
    }else{
        $memberid = $_GET['memberid'];
        $id_order = $_GET['id_order'];
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product | <?php include('../dist/includes/title.php');?></title>
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
    <style>
      
    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              <a class="btn btn-lg btn-warning" href="home.php">Back</a>
              
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Search order</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
            
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Product List of order id - <?php echo $id_order;?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Serial</th>
                        <th>Product Id</th>
                        <th>Selling Price</th>
				        <th>Quantity</th>
                        <th>Total price</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
        <?php
            $branch=$_SESSION['branch'];
            $query=mysqli_query($con,"select * from order_purchase where id_order='$id_order'")or die(mysqli_error());
            $i=1;
            $total = 0;
            while($row=mysqli_fetch_array($query)){
                $total = $total+($row['unit_price']*$row['prod_qty']);
        ?>
              <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $row['prod_id'];?></td>
                <td><?php echo $row['unit_price'];?></td>
                <td><?php echo $row['prod_qty'];?></td>
                <td><?php echo $row['unit_price']*$row['prod_qty'];?></td>
              </tr>  
        <?php $i++; } ?>					  
                    </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Total Price : <?php echo $total; ?> /=</th>
                      </tr>					  
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
