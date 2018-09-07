<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

include('../dist/includes/dbcon.php');
if (isset($_POST['submit'])) {
    $cat = mysqli_real_escape_string($con, $_POST['cat_name']); 
    mysqli_query($con,"CALL insert_category('$cat',@msg)");
    $query = mysqli_query($con,"select @msg");
    $result = mysqli_fetch_assoc($query);
    $msg = $result['@msg'];
    echo '<script type="text/javascript">alert("'.$msg.'");</script>'; 
    echo "<script>document.location='category.php'</script>";
} 
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Category</title>
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
      <?php include('../dist/includes/header.php');
      ?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container" style="min-height: 550px;">
          <!-- Content Header (Page header) -->
          <section class="content-header" style="text-transform: uppercase;font-weight: bold;line-height: 20px;">
            <h1>
              <a class="btn btn-lg btn-warning" href="home.php">Back</a>
            </h1>
            <center><b><h3 style="margin-top: -40px;">Category Info</h3></center></b>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Category</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
            <div class="row">
	      <div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Add New Category</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="">
                  <div class="form-group">
                    <label for="date">Category</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="cat_name" placeholder="Category" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
		  
                  <div class="form-group">
                    <div class="input-group">
                      <button class="btn btn-primary" name="submit">
                        Save
                      </button>
					  <button class="btn">
                        Clear
                      </button>
                    </div>
                  </div><!-- /.form group -->
				</form>	
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
            <div class="col-md-8">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Category List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
			             <th>Unit</th>
			             <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php
        		    $query=mysqli_query($con,"select * from category order by cat_name")or die(mysqli_error());
        		    while($row=mysqli_fetch_array($query)){
        		?>
                      <tr>
                        <td><?php echo $row['cat_name'];?></td>
                        <td>
				<a href="#updateordinance<?php echo $row['cat_id'];?>" data-target="#updateordinance<?php echo $row['cat_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
                 || 
                <a onclick="return confirm('Are you sure to delete this category?');" href="cat_delete.php?cat_id=<?php echo $row['cat_id'];?>"><i class="glyphicon glyphicon-remove-circle text-red"></i></a>
						</td>
                      </tr>
<div id="updateordinance<?php echo $row['cat_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Category Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="post" action="cat_update.php">
				<div class="form-group">
					<label class="control-label col-md-3" for="name">Category</label>
					<div class="col-md-9"><input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['cat_id'];?>" required>  
					  <input type="text" class="form-control" id="name" name="category" value="<?php echo $row['cat_name'];?>" required>  
					</div>
				</div> 
              </div><hr>
              <div class="modal-footer">
		<button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
			  </form>
            </div>
        </div><!--end of modal-dialog-->
 </div>
 <!--end of modal-->                    
<?php }?>					  
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    