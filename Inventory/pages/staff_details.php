<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

include('../dist/includes/dbcon.php');
if(!isset($_GET['staff_id'])){
        echo "<script>location.href = '../pages/home.php';</script>";
    }else{
        $staff_id=$_GET['staff_id'];
    }
    if (isset($_POST['submit'])) {
        echo "<script>document.location='staff.php'</script>";    
    } 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Staff Details| <?php include('../dist/includes/title.php');?></title>
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
          <section class="content-header">
            <h1>
              <a class="btn btn-lg btn-warning" href="staff.php">Back</a>
            </h1>
            <?php 
                $query1=mysqli_query($con,"SELECT name FROM staff WHERE staff_id=$staff_id")or die(mysqli_error());
                $row1=mysqli_fetch_array($query1);
            ?>
            <center><b><h3 style="margin-top: -40px;">Staff Details Of <?php echo $row1['name'];?></h3></center></b>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Staff</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
            <div class="row">
            <div class="col-md-3"></div>
    <?php 
        $query=mysqli_query($con,"SELECT * FROM staff WHERE staff_id=$staff_id")or die(mysqli_error());
        $row=mysqli_fetch_array($query);
    ?>
	  <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-body">
                  <!-- Date range -->
          <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group" align="center">
                    <label for="date">Photo </label>
                    <div class="input-group col-md-12">
                      <img src="../uploads/<?php echo $row['photo']; ?>" height="150px" width="150px"/>
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                    <label for="date">Date of joining</label>
                    <div class="input-group col-md-12">
                      <input type="date" class="form-control pull-right" id="date" value="<?php echo $row['doj'];?>" readonly="">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <label for="date">Designation </label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" value="<?php echo $row['designation'];?>" readonly="" />
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <label for="date">Salary </label>
                    <div class="input-group col-md-12">
                      <input type="number" class="form-control pull-right" id="date" value="<?php echo $row['salary'];?>" readonly="">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
				  <div class="form-group">
					<label for="date">Name</label>
					<div class="input-group col-md-12">
					  <input type="text" class="form-control pull-right" id="date" value="<?php echo $row['name']; ?>" readonly="">
					</div><!-- /.input group -->
				  </div><!-- /.form group -->
                  <div class="form-group">
                    <label for="date">Father's Name</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" value="<?php echo $row['f_name']; ?>" readonly="">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <label for="date">Mother's Name</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" value="<?php echo $row['m_name']; ?>" readonly="">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                <div class="form-group">
                    <label for="date">Date of birth</label>
                    <div class="input-group col-md-12">
                      <input type="date" class="form-control pull-right" id="date" value="<?php echo $row['dob']; ?>" readonly="">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                    <label for="date">Education</label>
                    <div class="input-group col-md-12">
                      <textarea class="form-control pull-right" id="date"><?php echo $row['education']; ?></textarea>
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
		         <div class="form-group">
                    <label for="date">Address</label>
                    <div class="input-group col-md-12">
                      <textarea class="form-control pull-right" id="date"><?php echo $row['addr']; ?></textarea>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                <div class="form-group">
                    <label for="date">Mobile</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" value="<?php echo $row['mob']; ?>" readonly="">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
				  <div class="form-group">
					<div class="input-group">
					  <button class="btn btn-primary" name="submit">
						Ok!
					  </button>
					</div>
				  </div><!-- /.form group -->
				  </form>	
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
            <div class="col-md-3"></div>
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
