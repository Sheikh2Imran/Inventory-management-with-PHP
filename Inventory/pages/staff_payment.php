<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');

if (isset($_POST['submit'])) {
    $staff_id = mysqli_real_escape_string($con, $_POST['staff_id']);
    $pay_date = mysqli_real_escape_string($con, $_POST['pay_date']);
    $payment = mysqli_real_escape_string($con, $_POST['payment']);
    $pay_type = mysqli_real_escape_string($con, $_POST['pay_type']);
    $rm_id = mysqli_real_escape_string($con, $_POST['rm_id']);
    $p_year = mysqli_real_escape_string($con, $_POST['p_year']);

    if ($pay_type == "salary") {
        mysqli_query($con,"CALL insert_staff_payment_salary('$staff_id','$pay_date','$rm_id','$p_year',@msg)");
    }elseif ($pay_type == "bonus") {
        mysqli_query($con,"CALL insert_staff_bonus('$staff_id','$pay_date','$rm_id','$p_year','$payment',@msg)");
    }
    $query = mysqli_query($con,"select @msg");
    $result = mysqli_fetch_assoc($query);
    $msg = $result['@msg'];
    echo '<script type="text/javascript">alert("'.$msg.'");</script>'; 
    echo "<script>document.location='staff_payment.php'</script>";    
} 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Staff payment</title>
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
            <center><b><h3 style="margin-top: -40px;">Staff Payment</h3></center></b>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Staff's Payment</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content" style="min-height: 460px">
            <div class="row">
            <div class="col-md-9">
<?php 
    if(isset($_GET['del_id'])){
        $del_id = $_GET['del_id'];
        $qry=mysqli_query($con,"CALL delete_staff_payment('$del_id',@msg)");
          echo "<script>window.location = 'staff_payment.php';</script>";
        }
?>
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">The Total Staff's Payment List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Pay ID</th>
                        <th>Name</th>
						<th>Date</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                		$query=mysqli_query($con,"select * from staff_payment");
                		while($row=mysqli_fetch_array($query)){
                    ?>
                      <tr>
                        <td><?php echo $row['pay_id'];?></td>
                        <td>
                            <?php $staff_id = $row['staff_id'];
                            $qry=mysqli_query($con,"select name from staff where staff_id='$staff_id'");
                            $staff_name=mysqli_fetch_array($qry);
                            echo $staff_name['name']; ?>
                        </td>
                        <td><?php echo $row['pay_date'];?></td>
                        <td><?php echo $row['pay_type'];?></td>
                        <td><?php echo $row['payment'];?></td>
                        <td>
                        <?php
                            $rm_id = $row['rm_id'];
                           $q=mysqli_query($con,"select rm_month from rent_month where rm_id='$rm_id'");
                            $data=mysqli_fetch_array($q);
                            echo $data['rm_month'];
                        ?>  
                        </td>
                        <td><?php echo $row['p_year'];?></td>
                        <td>
				        <a href="#updateordinance<?php echo $row['pay_id'];?>" data-target="#updateordinance<?php echo $row['pay_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue">Edit</i></a>
                        ||
                        <a onclick="return confirm('Are you sure to remove this staff ?');" href="?del_id=<?php echo $row['pay_id']; ?>">Remove</a>
						</td>
                      </tr>
	<div id="updateordinance<?php echo $row['pay_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Staff Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="POST" action="payment_update.php">
                <div class="form-group">
                  <label for="name">Payment ID</label>
                  <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="pay_id" value="<?php echo $row['pay_id'];?>" required>  
                    <input type="text" class="form-control" id="name" name="pay_id" value="<?php echo $row['pay_id'];?>" readonly="">  
                  </div>
                </div> 
                <div class="form-group">
                <label for="exampleFormControlSelect1">Payment Type</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="pay_type">
                    <option value="salary">Salary</option>
                    <option value="bonus">Bonus</option>
                  </select>
                </div>
                <div class="form-group">
                    <label for="name">Payment Amount</label>
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="payment" value="<?php echo $row['payment'];?>"> 
                      <input type="text" class="form-control" id="name" name="payment" value="<?php echo $row['payment'];?>">  
                    </div>
                </div>    
              </div>
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
                  <h3 class="box-title">Add New Payment</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
          <form method="POST" action="">
                <div class="form-group">
                    <label for="date">Payment Date</label>
                    <div class="input-group col-md-12">
                      <input type="date" class="form-control pull-right" id="date" name="pay_date" value="<?php echo date('Y-m-d')?>">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                <label for="exampleFormControlSelect1">Staff's Name</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="staff_id">
                    <?php 
                        $query=mysqli_query($con,"select concat(name,'-',mob) as staff_data,staff_id from staff order by staff_id desc")or die(mysqli_error());
                        while($row=mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['staff_id'];?>"><?php echo $row['staff_data'];?></option>
                        <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                <label for="exampleFormControlSelect1">Payment Type</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="pay_type">
                    <option value="salary">Salary</option>
                    <option value="bonus">Bonus</option>
                  </select>
                </div>
                <div class="form-group">
                    <label for="date">Payment Amount</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="payment" placeholder="Amount to give the staff">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                <label for="exampleFormControlSelect1">Month</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="rm_id">
                    <?php 
                        $query=mysqli_query($con,"select * from rent_month");
                        while($row=mysqli_fetch_array($query)){
                    ?>
                    <option value="<?php echo $row['rm_id'];?>"><?php echo $row['rm_month'];?></option>
                        <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                <label for="exampleFormControlSelect1">year</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="p_year">
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                  </select>
                </div>
				  <div class="form-group">
					<div class="input-group">
					  <button class="btn btn-primary" name="submit">
						Payment
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
