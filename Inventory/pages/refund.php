<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');

if (isset($_POST['submit'])) {
    $deli_id = mysqli_real_escape_string($con, $_POST['deli_id']);
    $prod_id = mysqli_real_escape_string($con, $_POST['prod_id']);
    $prod_qty = mysqli_real_escape_string($con, $_POST['prod_qty']);

    mysqli_query($con,"CALL refund_product('$prod_id','$deli_id','$prod_qty',@msg)");
    $query = mysqli_query($con,"select @msg");
    $result = mysqli_fetch_assoc($query);
    $msg = $result['@msg'];
    echo '<script type="text/javascript">alert("'.$msg.'");</script>'; 
    echo "<script>document.location='refund.php'</script>";    
} 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Refund product</title>
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
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');
      include('../dist/includes/dbcon.php');
      ?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header" style="text-transform: uppercase;font-weight: bold;line-height: 20px;">
            <h1>
              <a class="btn btn-lg btn-warning" href="home.php">Back</a>
            </h1>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Refund Product</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content" style="min-height: 460px">
            <div class="row">
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Total Refund List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>M. ID</th>
                        <th>Company</th>
                        <th>Invoice</th>
						<th>Date</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Type</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                		$query=mysqli_query($con,"select * from refund_view");
                		while($row=mysqli_fetch_array($query)){
                    ?>
                      <tr>
                        <td><?php echo $row['m_id'];?></td>
                        <td><?php echo $row['company_name'];?></td>
                        <td><?php echo $row['deli_id'];?></td>
                        <td><?php echo $row['refund_date'];?></td>
                        <td><?php echo $row['prod_name'];?></td>
                        <td><?php echo $row['prod_qty'];?></td>
                        <td><?php echo $row['total_price'];?></td>
                        <td><?php echo $row['refund_type'];?></td>
                        <td>
				        <a href="#updateordinance<?php echo $row['deli_id'];?>" data-target="#updateordinance<?php echo $row['deli_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue">Edit</i></a>
                        ||
                        <a onclick="return confirm('Are you sure to remove this Refund ?');" href="refund_delete.php?deli_id=<?php echo $row['deli_id'];?>&prod_id=<?php echo $row['prod_id'];?>">Remove</a>
						</td>
                      </tr>
				<div id="updateordinance<?php echo $row['deli_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Refund Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="POST" action="refund_update.php">
                <div class="form-group">
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="prod_id" value="<?php echo $row['prod_id'];?>"> 
                      <input type="hidden" class="form-control" id="name" name="prod_id" value="<?php echo $row['prod_id'];?>" readonly="">  
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Delivery ID</label>
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="deli_id" value="<?php echo $row['deli_id'];?>">  
                      <input type="text" class="form-control" id="name" name="deli_id" value="<?php echo $row['deli_id'];?>" readonly="">  
                    </div>
                </div> 
                <div class="form-group">
                  <label for="name">Quantity</label>
                  <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="prod_qty" value="<?php echo $row['prod_qty'];?>">  
                    <input type="text" class="form-control" id="name" name="prod_qty" value="<?php echo $row['prod_qty'];?>">  
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
                 
<?php } ?>					  
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->

	  <div class="col-md-3">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Add New Refund</h3>
                </div>
                <div class="box-body">
        <?php if (!isset($_POST['submit_hide'])) { ?>
            <form method="POST" action="">                
                <div class="form-group">
                    <label for="date">Delivery ID</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="deli_id" placeholder="Give the delivery ID">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                  <div class="form-group">
                    <div class="input-group">
                      <button class="btn btn-primary" name="submit_hide">
                        View
                      </button>
                      <button class="btn">
                        Clear
                      </button>
                    </div>
                  </div><!-- /.form group -->
            </form>
        <?php } ?>
        <?php if (isset($_POST['submit_hide'])) { 
            $deli_id = $_POST['deli_id'];
        ?>
          <form method="POST" action=""> 
                <div class="form-group">
                    <label for="date">Delivery ID</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="deli_id" value="<?php echo $deli_id;?>" placeholder="Give the delivery ID">
                    </div><!-- /.input group -->
                </div><!-- /.form group --> 
                <div class="form-group">
                    <label for="name">Product Name</label>
                      <div class="col-md-12">
                      <select class="form-control select" name="prod_id">
                        <?php
                          $queryc=mysqli_query($con,"select prod_id,prod_name from delivery_details_view where deli_id='$deli_id'");
                            while($rowc=mysqli_fetch_array($queryc)){
                        ?>
                          <option value="<?php echo $rowc['prod_id'];?>"><?php echo $rowc['prod_name'];?></option>
                        <?php }?>
                      </select>
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                    <label for="date">Product Quantity</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="prod_qty" placeholder="Give quantity">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
				  <div class="form-group">
					<div class="input-group">
					  <button class="btn btn-primary" name="submit">
						Refund
					  </button>
					  <button class="btn">
						Clear
					  </button>
					</div>
				  </div><!-- /.form group -->
			</form>	
        <?php } ?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
