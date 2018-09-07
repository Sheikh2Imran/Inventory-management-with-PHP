<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

include('../dist/includes/dbcon.php');
if (isset($_POST['submit'])) {
    $bank_name = mysqli_real_escape_string($con, $_POST['bank_name']); 
    $bank_branch = mysqli_real_escape_string($con, $_POST['bank_branch']); 
    $bank_district = mysqli_real_escape_string($con, $_POST['bank_district']); 
    $opening_date = mysqli_real_escape_string($con, $_POST['opening_date']); 
    mysqli_query($con,"CALL insert_bank_info('$bank_name','$bank_branch','$bank_district','$opening_date',@msg)");
    $query = mysqli_query($con,"select @msg");
    $result = mysqli_fetch_assoc($query);
    $msg = $result['@msg'];
    echo '<script type="text/javascript">alert("'.$msg.'");</script>'; 
    echo "<script>document.location='bank_info.php'</script>";
} 
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bank Info</title>
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
      include('../dist/includes/dbcon.php');
      ?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container" style="min-height: 550px;">
          <!-- Content Header (Page header) -->
          <section class="content-header" style="text-transform: uppercase;font-weight: bold;line-height: 20px;">
            <h1>
              <a class="btn btn-lg btn-warning" href="home.php">Back</a>
            </h1>
            <center><b><h3 style="margin-top: -40px;">Bank Info</h3></center></b>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Insert Bank Info</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
            <div class="row">
	      <div class="col-md-3">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Add New Bank Info</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="">
                  <div class="form-group">
                    <label for="date">Bank Name</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="bank_name" placeholder="Enter bank's name" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <label for="date">Bank Branch</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="bank_branch" placeholder="Enter bank's branch name" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <label for="date">Bank District</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="bank_district" placeholder="Enter bank's district name" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <label for="date">Opening Date</label>
                    <div class="input-group col-md-12">
                      <input type="date" class="form-control pull-right" id="date" name="opening_date" placeholder="opening date" required>
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
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Bank Info List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                         <th>Bank ID</th>
			             <th>Bank Name</th>
                         <th>Bank Branch</th>
                         <th>Bank District</th>
                         <th>Bank Balance</th>
                         <th>Opening Date</th>
			             <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php
        		    $query=mysqli_query($con,"select * from bank_info order by bank_name");
        		    while($row=mysqli_fetch_array($query)){
        		?>
                      <tr>
                        <td><?php echo $row['bank_id'];?></td>
                        <td><?php echo $row['bank_name'];?></td>
                        <td><?php echo $row['bank_branch'];?></td>
                        <td><?php echo $row['bank_district'];?></td>
                        <td><?php echo $row['bank_balance'];?></td>
                        <td><?php echo $row['openning_date'];?></td>
                        <td>
				<a href="#updateordinance<?php echo $row['bank_id'];?>" data-target="#updateordinance<?php echo $row['bank_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
                 || 
                <a onclick="return confirm('Are you sure to delete this category?');" href="bank_info_delete.php?bank_id=<?php echo $row['bank_id'];?>"><i class="glyphicon glyphicon-remove-circle text-red"></i></a>
						</td>
                      </tr>
<div id="updateordinance<?php echo $row['bank_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Bank Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="post" action="bank_info_update.php">
				<div class="form-group">
					<div class="col-md-9"><input type="hidden" class="form-control" id="id" name="bank_id" value="<?php echo $row['bank_id'];?>" required>  
					  <input type="hidden" class="form-control" id="name" name="bank_id" value="<?php echo $row['bank_id'];?>" required>  
					</div>
				</div> 
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Bank Name</label>
          <div class="col-md-9"><input type="hidden" class="form-control" id="id" name="bank_name" value="<?php echo $row['bank_name'];?>" required>  
            <input type="text" class="form-control" id="name" name="bank_name" value="<?php echo $row['bank_name'];?>" required>  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Bank Branch</label>
          <div class="col-md-9"><input type="hidden" class="form-control" id="id" name="bank_branch" value="<?php echo $row['bank_branch'];?>" required>  
            <input type="text" class="form-control" id="name" name="bank_branch" value="<?php echo $row['bank_branch'];?>" required>  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3" for="name"> Bank District</label>
          <div class="col-md-9"><input type="hidden" class="form-control" id="id" name="bank_district" value="<?php echo $row['bank_district'];?>" required>  
            <input type="text" class="form-control" id="name" name="bank_district" value="<?php echo $row['bank_district'];?>" required>  
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3" for="name">Opening Date</label>
          <div class="col-md-9"><input type="hidden" class="form-control" id="id" name="openning_date" value="<?php echo $row['openning_date'];?>" required>  
            <input type="date" class="form-control" id="name" name="openning_date" value="<?php echo $row['openning_date'];?>" required>  
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
    