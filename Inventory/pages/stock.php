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
    <title>Stock</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper" style="min-height: 520px;">
        <div class="container" >
          <!-- Content Header (Page header) -->
          <section class="content-header" style="text-transform: uppercase;font-weight: bold;line-height: 20px;">
            <h1>
              <a class="btn btn-lg btn-warning" href="home.php">Back</a>
            </h1>
            <center><b><h3 style="margin-top: -40px;">Product Stock</h3></center></b>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i>Home</a></li>
              <li class="active">Product Stock</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
            <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Total Product List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Short desc.</th>
                        <th>Short desc1.</th>
                        <th>Short desc2.</th>
                        <th>Short desc3.</th>
                        <th>Description</th>
                        <th style="color: red">Product Stock</th>
                        <th>Buying Price</th>
                        <th>Selling Price</th>
                        <th>Category</th>
                      </tr>
                    </thead>
                    <tbody>

<?php
	$query=mysqli_query($con,"select * from product natural join category order by prod_name")or die(mysqli_error());
	while($row=mysqli_fetch_array($query)){	
?>
      <tr>
        <td><?php echo $row['prod_id'];?></td>
        <td><?php echo $row['prod_name'];?></td>
        <td><?php echo $row['prod_desc_short'];?></td>
        <td><?php echo $row['prod_desc'];?></td>
        <td><?php echo $row['prod_desc1'];?></td>
        <td><?php echo $row['prod_desc2'];?></td>
        <td><?php echo $row['prod_desc3'];?></td>
        <td style="color: red;"><b><?php echo $row['prod_stock'];?></b></td>
        <td><?php echo $row['unit_price_buy'];?></td>
        <td><?php echo $row['unit_price_sell'];?></td>
        <td><?php echo $row['cat_name'];?></td>
      </tr>                  
<?php } ?>					  
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

                              </div>
                          </div>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</div>
</div>