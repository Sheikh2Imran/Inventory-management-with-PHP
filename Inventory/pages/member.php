<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');

if (isset($_POST['submit'])) {
    $name    = mysqli_real_escape_string($con, $_POST['m_name']);
    $company = mysqli_real_escape_string($con, $_POST['m_company']);
    $address = mysqli_real_escape_string($con, $_POST['m_addr']);
    $contact = mysqli_real_escape_string($con, $_POST['m_mob']);
    $email   = mysqli_real_escape_string($con, $_POST['m_email']);
    $status  = mysqli_real_escape_string($con, $_POST['m_status']);
    $dor     = mysqli_real_escape_string($con, $_POST['m_dor']); 
            
    mysqli_query($con,"CALL insert_member('$status','$dor','$name','$company','$address','$contact','$email',@msg)")or die(mysqli_error($con));
    echo "<script>document.location='member.php'</script>";     
}   
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Member</title>
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
            <center><b><h3 style="margin-top: -40px;">Supplier And Customer Registration</h3></center></b>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Member</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
            <div class="row">
            <div class="col-md-9">
              <div class="box box-primary">
<?php 
    if(isset($_GET['delid'])){
        $delid = $_GET['delid'];
        $query=mysqli_query($con,"CALL delete_member('$delid',@msg)")or die(mysqli_error());
          echo "<script>window.location = 'member.php';</script>";
        }
?>
                <div class="box-header">
                  <h3 class="box-title">Total Member List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Company</th>
						<th>Address</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
    <?php
		$query=mysqli_query($con,"select * from member")or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
    ?>
                      <tr>
                        <td><?php echo $row['m_id'];?></td>
                        <td><?php echo $row['m_name'];?></td>
                        <td><?php echo $row['m_company'];?></td>
                        <td><?php echo $row['m_addr'];?></td>
                        <td><?php echo $row['m_mob'];?></td>
                        <td><?php echo $row['m_email'];?></td>
                        <td><?php echo $row['m_status'];?></td>
                        <td><?php echo $row['m_dor'];?></td>
                        <td>
				            <a href="#updateordinance<?php echo $row['m_id'];?>" data-target="#updateordinance<?php echo $row['m_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
                         ||
                            <a onclick="return confirm('Are you sure to delete?'); " href="?delid=<?php echo $row['m_id']; ?>"><i class="glyphicon glyphicon-remove text-red"></i></a>
						</td>
                      </tr>
				<div id="updateordinance<?php echo $row['m_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Member Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="POST" action="member_update.php">
          <div class="form-group">
          <label for="name">ID</label>
          <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="m_id" value="<?php echo $row['m_id'];?>" required>  
            <input type="text" class="form-control" id="name" name="m_id" value="<?php echo $row['m_id'];?>" readonly="">  
          </div>
        </div>
				<div class="form-group">
					<label for="name">Name</label>
					<div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="m_name" value="<?php echo $row['m_name'];?>" required>  
					  <input type="text" class="form-control" id="name" name="m_name" value="<?php echo $row['m_name'];?>" required>  
					</div>
				</div> 
                <div class="form-group">
                    <label for="name">Company</label>
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="m_company" value="<?php echo $row['m_company'];?>" required>  
                      <input type="text" class="form-control" id="name" name="m_company" value="<?php echo $row['m_company'];?>" required>  
                    </div>
                </div>
                <div class="form-group">
                    <label for="date">Address</label>
                    <div class="input-group col-md-12">
                      <textarea class="form-control pull-right" id="address" name="m_addr" placeholder="Member Complete Address" required><?php echo $row['m_addr'];?></textarea>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
               <div class="form-group">
                    <label for="date">Contact</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="m_mob" placeholder="Contact of member" value="<?php echo $row['m_mob'];?>" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->  
                  <div class="form-group">
                    <label for="date">Email</label>
                    <div class="input-group col-md-12">
                      <input type="email" class="form-control pull-right" id="date" name="m_email" placeholder="Email of member" value="<?php echo $row['m_email'];?>" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group --> 
                <div class="form-group">
                <label for="exampleFormControlSelect1">Status</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="m_status" required="">
                    <option value=""><?php echo $row['m_status'];?></option>
                    <option value="supplier">Supplier</option>
                    <option value="customer">Customer</option>
                  </select>
              </div> 
                <div class="form-group">
                    <label for="date">Registration Date</label>
                    <div class="input-group col-md-12">
                      <input type="date" class="form-control pull-right" id="date" name="m_dor" value="<?php echo $row['m_dor'];?>" required>
                    </div><!-- /.input group -->
                </div><!-- /.form group -->  
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
                  <h3 class="box-title">Add New Member</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
          <form method="POST" action="">
				  <div class="form-group">
					<label for="date">Name</label>
					<div class="input-group col-md-12">
					  <input type="text" class="form-control pull-right" id="date" name="m_name" placeholder="Member Name" required>
					</div><!-- /.input group -->
				  </div><!-- /.form group -->
                  <div class="form-group">
                    <label for="date">Company</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="m_company" placeholder="Company Name" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
		         <div class="form-group">
                    <label for="date">Address</label>
                    <div class="input-group col-md-12">
                      <textarea class="form-control pull-right" id="date" name="m_addr" placeholder="Member Complete Address" required></textarea>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
               <div class="form-group">
                    <label for="date">Contact</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="m_mob" placeholder="Contact # of Member" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->  
                <div class="form-group">
                    <label for="date">Email</label>
                    <div class="input-group col-md-12">
                      <input type="email" class="form-control pull-right" id="date" name="m_email" placeholder="Email # of Member" required>
                    </div><!-- /.input group -->
                </div><!-- /.form group --> 
              <div class="form-group">
                <label for="exampleFormControlSelect1">Status</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="m_status">
                    <option value="supplier">supplier</option>
                    <option value="customer">customer</option>
                  </select>
              </div>
              <div class="form-group">
                    <label for="date">Registration Date</label>
                    <div class="input-group col-md-12">
                      <input type="date" class="form-control pull-right" id="date" name="m_dor" value="<?php echo date('Y-m-d');?>" required>
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
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
