<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');

if (isset($_POST['submit'])) {
    $doj = mysqli_real_escape_string($con, $_POST['doj']);
    $designation = mysqli_real_escape_string($con, $_POST['designation']);
    $salary = mysqli_real_escape_string($con, $_POST['salary']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $f_name = mysqli_real_escape_string($con, $_POST['f_name']);
    $m_name = mysqli_real_escape_string($con, $_POST['m_name']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $education = mysqli_real_escape_string($con, $_POST['education']);
    $addr = mysqli_real_escape_string($con, $_POST['addr']);
    $mob = mysqli_real_escape_string($con, $_POST['mob']);

    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['photo']['name'];
    $file_size = $_FILES['photo']['size'];
    $file_temp = $_FILES['photo']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "../uploads/".$unique_image;

    move_uploaded_file($file_temp, $uploaded_image);
    mysqli_query($con,"CALL insert_staff('$doj','$designation','$salary','$uploaded_image','$name','$f_name','$m_name','$dob','$education','$addr','$mob',@msg)");
    $query = mysqli_query($con,"select @msg");
    $result = mysqli_fetch_assoc($query);
    $msg = $result['@msg'];
    echo '<script type="text/javascript">alert("'.$msg.'");</script>'; 
    echo "<script>document.location='staff.php'</script>";    
} 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Staff | <?php include('../dist/includes/title.php');?></title>
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
            <center><b><h3 style="margin-top: -40px;">Staff Registration And List</h3></center></b>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Staff</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
            <div class="row">
            <div class="col-md-9">
<?php 
    if(isset($_GET['del_id'])){
        $del_id = $_GET['del_id'];
        $qry=mysqli_query($con,"CALL delete_staff('$del_id',@msg)");
          echo "<script>window.location = 'staff.php';</script>";
        }
?>
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">The Total Staff List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Photo</th>
                        <th>Name</th>
						<th>Designation</th>
                        <th>Contact</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                		$query=mysqli_query($con,"select * from staff order by staff_id desc");
                		while($row=mysqli_fetch_array($query)){
                    ?>
                      <tr>
                        <td><?php echo $row['staff_id'];?></td>
                        <td><img src="../uploads/<?php echo $row['photo']; ?>" height="50px" width="50px"/></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['designation'];?></td>
                        <td><?php echo $row['mob'];?></td>
                        <td>
				        <a href="#updateordinance<?php echo $row['staff_id'];?>" data-target="#updateordinance<?php echo $row['staff_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue">Edit</i></a>
                        ||
                        <a href="staff_details.php?staff_id=<?php echo $row['staff_id']; ?>">View</a>
                        ||
                        <a onclick="return confirm('Are you sure to remove this staff ?');" href="?del_id=<?php echo $row['staff_id']; ?>">Remove</a>
						</td>
                      </tr>
	<div id="updateordinance<?php echo $row['staff_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Staff Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="POST" action="staff_update.php?staff_id=<?php echo $row['staff_id'];?>">
          <div class="form-group">
          <label for="name">ID</label>
          <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="staff_id" value="<?php echo $row['staff_id'];?>" required>  
            <input type="text" class="form-control" id="name" name="staff_id" value="<?php echo $row['staff_id'];?>" readonly="">  
          </div>
        </div>
				<div class="form-group">
					<label for="name">Date Of Joining</label>
					<div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="doj" value="<?php echo $row['doj'];?>">  
					  <input type="date" class="form-control" id="name" name="doj" value="<?php echo $row['doj'];?>">  
					</div>
				</div>
                <div class="form-group">
                    <label for="name">Designation</label>
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="designation" value="<?php echo $row['designation'];?>">  
                      <input type="text" class="form-control" id="name" name="designation" value="<?php echo $row['designation'];?>">  
                    </div>
                </div> 
                <div class="form-group">
                    <label for="name">Salary</label>
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="salary" value="<?php echo $row['salary'];?>"> 
                      <input type="number" class="form-control" id="name" name="salary" value="<?php echo $row['salary'];?>">  
                    </div>
                </div> 
                 <div class="form-group">
                        <label for="name">Photo</label>
                        <div class="input-group col-md-12">
                            <img src="../uploads/<?php echo $row['photo']; ?>" width="100px" height="80px" />
                            <input type="file" name="photo"/>
                        </div>
                    </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="name" value="<?php echo $row['name'];?>">  
                      <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name'];?>">  
                    </div>
                </div> 
                <div class="form-group">
                    <label for="name">Father's Name</label>
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="f_name" value="<?php echo $row['f_name'];?>"> 
                      <input type="text" class="form-control" id="name" name="f_name" value="<?php echo $row['f_name'];?>">  
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Mother's Name</label>
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="m_name" value="<?php echo $row['m_name'];?>"> 
                      <input type="text" class="form-control" id="name" name="m_name" value="<?php echo $row['m_name'];?>">  
                    </div>
                </div> 
                <div class="form-group">
                    <label for="name">Date of birth</label>
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="dob" value="<?php echo $row['dob'];?>">  
                      <input type="date" class="form-control" id="name" name="dob" value="<?php echo $row['dob'];?>">  
                    </div>
                </div>
                <div class="form-group">
                    <label for="date">Education</label>
                    <div class="input-group col-md-12">
                      <textarea class="form-control pull-right" id="address" name="education"><?php echo $row['education'];?></textarea>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                <div class="form-group">
                    <label for="date">Address</label>
                    <div class="input-group col-md-12">
                      <textarea class="form-control pull-right" id="address" name="addr"><?php echo $row['addr'];?></textarea>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
               <div class="form-group">
                    <label for="date">Contact</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="mob"  value="<?php echo $row['mob'];?>">
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
                  <h3 class="box-title">Add New Staff</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
          <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="date">Date of joining</label>
                    <div class="input-group col-md-12">
                      <input type="date" class="form-control pull-right" id="date" value="<?php echo date('Y-m-d'); ?>" name="doj">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <label for="date">Designation </label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="designation" placeholder="Designation of the staff">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <label for="date">Salary </label>
                    <div class="input-group col-md-12">
                      <input type="number" class="form-control pull-right" id="date" name="salary" placeholder="Staff's Salary">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <label for="date">Photo </label>
                    <div class="input-group col-md-12">
                      <input type="file" required="" class="form-control pull-right" accept="image/*" name="photo">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
				  <div class="form-group">
					<label for="date">Name</label>
					<div class="input-group col-md-12">
					  <input type="text" class="form-control pull-right" id="date" name="name" placeholder="Staff's Name" required>
					</div><!-- /.input group -->
				  </div><!-- /.form group -->
                  <div class="form-group">
                    <label for="date">Father's Name</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="f_name" placeholder="Staff Father's Name">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <label for="date">Mother's Name</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="m_name" placeholder="Staff Mother's Name" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                <div class="form-group">
                    <label for="date">Date of birth</label>
                    <div class="input-group col-md-12">
                      <input type="date" class="form-control pull-right" id="date" name="dob">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                    <label for="date">Education</label>
                    <div class="input-group col-md-12">
                      <textarea class="form-control pull-right" id="date" name="education" placeholder="Staff Education Details"></textarea>
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
		         <div class="form-group">
                    <label for="date">Address</label>
                    <div class="input-group col-md-12">
                      <textarea class="form-control pull-right" id="date" name="addr" placeholder="Staff Complete Address"></textarea>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                <div class="form-group">
                    <label for="date">Mobile</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="mob" placeholder="Contact # of Staff">
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
