<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

include('../dist/includes/dbcon.php');
if (isset($_POST['submit'])) {
    $cat_id = mysqli_real_escape_string($con, $_POST['cat_id']);
    $prod_name = mysqli_real_escape_string($con, $_POST['prod_name']);
    $prod_desc = mysqli_real_escape_string($con, $_POST['prod_desc']);
    $prod_desc1 = mysqli_real_escape_string($con, $_POST['prod_desc1']);
    $prod_desc2 = mysqli_real_escape_string($con, $_POST['prod_desc2']);
    $prod_desc3 = mysqli_real_escape_string($con, $_POST['prod_desc3']);
    $prod_desc_short = mysqli_real_escape_string($con, $_POST['prod_desc_short']);
    $unit_price_buy = mysqli_real_escape_string($con, $_POST['unit_price_buy']);
    $unit_price_sell = mysqli_real_escape_string($con, $_POST['unit_price_sell']);

    mysqli_query($con,"CALL insert_product('$prod_name','$prod_desc','$prod_desc1','$prod_desc2','$prod_desc3','$prod_desc_short','$unit_price_buy','$unit_price_sell','$cat_id',@msg)");
    echo "<script>document.location='product.php'</script>";  
} 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product</title>
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
              <a class="btn btn-lg btn-primary" href="#add" data-target="#add" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-plus text-blue"></i> Add Product</a>
            </h1>
            <center><b><h3 style="margin-top: -40px;">Product Info</h3></center></b>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i>Home</a></li>
              <li class="active">Product</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
            <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">

<?php 
    if(isset($_GET['delid'])){
        $delid = $_GET['delid'];
        $query=mysqli_query($con,"CALL delete_product('$delid',@msg)");
          echo "<script>window.location = 'product.php';</script>";
        }
?>
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
                        <th>Buying Price</th>
                        <th>Selling Price</th>
                        <th>Category</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

<?php
	$query=mysqli_query($con,"select * from product natural join category order by prod_name");
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
        <td><?php echo $row['unit_price_buy'];?></td>
        <td><?php echo $row['unit_price_sell'];?></td>
        <td><?php echo $row['cat_name'];?></td>
        <td>
			<a href="#updateordinance<?php echo $row['prod_id'];?>" data-target="#updateordinance<?php echo $row['prod_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
			||
            <a onclick="return confirm('Are you sure to delete?'); " href="?delid=<?php echo $row['prod_id']; ?>"><i class="glyphicon glyphicon-remove text-red"></i></a>
       </td>
      </tr>
<div id="updateordinance<?php echo $row['prod_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Product Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="post" action="product_update.php">
        <div class="form-group">
            <label class="control-label col-md-3" >Category</label>
                <div class="col-md-9">
                    <select class="form-control select" style="width: 100%;" name="cat_id">
                        <?php
                        $queryc=mysqli_query($con,"select * from category");
                        while($rowc=mysqli_fetch_array($queryc)){
                        ?>
                          <option value="<?php echo $rowc['cat_id'];?>"><?php echo $rowc['cat_name'];?></option>
                        <?php }?>
                    </select>
            </div><!-- /.input group -->
        </div><!-- /.form group -->  
		<div class="form-group">
			<label class="control-label col-md-3" for="name">Product Name</label>
			<div class="col-md-9"><input type="hidden" class="form-control" id="id" name="prod_id" value="<?php echo $row['prod_id'];?>" required>  
			  <input type="text" class="form-control" id="name" name="prod_name" value="<?php echo $row['prod_name'];?>" required>  
			</div>
		</div>
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Product Desc.</label>
          <div class="col-md-9">
            <input type="text" class="form-control" id="name" name="prod_desc" value="<?php echo $row['prod_desc'];?>">  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Product Desc1.</label>
          <div class="col-md-9">
            <input type="text" class="form-control" id="name" name="prod_desc1" value="<?php echo $row['prod_desc1'];?>">  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Product Desc2.</label>
          <div class="col-md-9">
            <input type="text" class="form-control" id="name" name="prod_desc2" value="<?php echo $row['prod_desc2'];?>">  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Product Desc3.</label>
          <div class="col-md-9">
            <input type="text" class="form-control" id="name" name="prod_desc3" value="<?php echo $row['prod_desc3'];?>">  
          </div>
        </div> 
        <div class="form-group">
            <label class="control-label col-md-3" for="name">Short Desc.</label>
            <div class="col-md-9"><input type="hidden" class="form-control" id="id" name="  prod_desc_short" value="<?php echo $row['prod_desc_short'];?>" required>  
              <input type="text" class="form-control" id="name" name="prod_desc_short" value="<?php echo $row['prod_desc_short'];?>" required>  
            </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Buying Price</label>
          <div class="col-md-9">
            <input type="text" class="form-control" id="name" name="unit_price_buy" value="<?php echo $row['unit_price_buy'];?>">  
          </div>
        </div> 
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Selling Price</label>
          <div class="col-md-9">
            <input type="text" class="form-control" id="name" name="unit_price_sell" value="<?php echo $row['unit_price_sell'];?>">  
          </div>
        </div> 
    </div>
        <div class="modal-footer">
		<button type="submit" class="btn btn-primary" name="">Save changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
			  </form>
            </div>
			
        </div><!--end of modal-dialog-->
 </div>
 <!--end of modal-->                    
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
<div id="add" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add New Product</h4>
              </div>
              <div class="modal-body">
        <form class="form-horizontal" method="POST" action="">
        <div class="form-group">
        <label class="control-label col-md-3">Category</label>
          <div class="col-md-9">
            <select class="form-control select" style="width: 100%;" name="cat_id">
            <?php
              $queryc=mysqli_query($con,"select * from category");
                while($rowc=mysqli_fetch_array($queryc)){
            ?>
              <option value="<?php echo $rowc['cat_id'];?>"><?php echo $rowc['cat_name'];?></option>
            <?php }?>
          </select>
          </div><!-- /.input group -->
        </div><!-- /.form group --> 
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Product Name</label>
          <div class="col-md-9"><input type="hidden" class="form-control" id="id" name="prod_name">  
            <input type="text" class="form-control" id="name" name="prod_name" placeholder="Product Name">  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Product Desc.</label>
          <div class="col-md-9"><input type="hidden" class="form-control" id="id" name="prod_desc">  
            <input type="text" class="form-control" id="name" name="prod_desc" placeholder="Product description">  
          </div>
        </div> 
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Product Desc1.</label>
          <div class="col-md-9"><input type="hidden" class="form-control" id="id" name="prod_desc1">  
            <input type="text" class="form-control" id="name" name="prod_desc1" placeholder="Product description1">  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Product Desc2.</label>
          <div class="col-md-9"><input type="hidden" class="form-control" id="id" name="prod_desc2" required>  
            <input type="text" class="form-control" id="name" name="prod_desc2" placeholder="Product description2">  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Product Desc3.</label>
          <div class="col-md-9"><input type="hidden" class="form-control" id="id" name="prod_desc3">  
            <input type="text" class="form-control" id="name" name="prod_desc3" placeholder="Product description3">  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Product Short Desc.</label>
          <div class="col-md-9"><input type="hidden" class="form-control" id="id" name="prod_desc_short">  
            <input type="text" class="form-control" id="name" name="prod_desc_short" placeholder="Product short description">  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Buying Price</label>
          <div class="col-md-9"><input type="hidden" class="form-control" id="id" name="unit_price_buy" required>  
            <input type="text" class="form-control" id="name" name="unit_price_buy" placeholder="Buying price">  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Selling Price</label>
          <div class="col-md-9"><input type="hidden" class="form-control" id="id" name="unit_price_sell">  
            <input type="text" class="form-control" id="name" name="unit_price_sell" placeholder="Selling price">  
          </div>
        </div> 
        <div class="form-group">
          <label class="control-label col-md-3" for="name"></label>
          <div class="col-md-9"><input type="hidden" class="form-control" id="id" name="prod_stock" value="0">  
            <input type="hidden" class="form-control" id="name" name="prod_stock" value="0">  
          </div>
        </div>
    </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div><!--end of modal-dialog-->
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