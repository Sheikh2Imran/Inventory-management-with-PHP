<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');

if (isset($_POST['submit'])) {
    $exp_date = mysqli_real_escape_string($con, $_POST['exp_date']);
    $exp_amount = mysqli_real_escape_string($con, $_POST['exp_amount']);
    $pay_type = mysqli_real_escape_string($con, $_POST['pay_type']);

    mysqli_query($con,"CALL insert_expense('$exp_date','$exp_amount','$pay_type',@msg)")or die(mysqli_error($con));
    $query = mysqli_query($con,"select @msg")or die(mysqli_error($con));
    $result = mysqli_fetch_assoc($query);
    $msg = $result['@msg'];
    echo '<script type="text/javascript">alert("'.$msg.'");</script>'; 
    echo "<script>document.location='expense.php'</script>";    
} 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Expense</title>
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
              <li class="active">Expense</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content" style="min-height: 460px">
            <div class="row">
<?php 
    if(isset($_GET['del_id'])){
        $del_id = $_GET['del_id'];
        $qry=mysqli_query($con,"CALL delete_expense('$del_id',@msg)");
          echo "<script>window.location = 'expense.php';</script>";
    }
?>
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Total Expense List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Expense ID</th>
                        <th>Date</th>
						<th>Expense Amount</th>
                        <th>Expense Type</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
    <?php
		$query=mysqli_query($con,"select * from expense order by exp_date desc");
		while($row=mysqli_fetch_array($query)){
    ?>
                      <tr>
                        <td><?php echo $row['exp_id'];?></td>
                        <td><?php echo $row['exp_date'];?></td>
                        <td><?php echo $row['payment'];?></td>
                        <td><?php echo $row['pay_type'];?></td>
                        <td>
				        <a href="#updateordinance<?php echo $row['exp_id'];?>" data-target="#updateordinance<?php echo $row['exp_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue">Edit</i></a>
                        ||
                        <a onclick="return confirm('Are you sure to remove this staff ?');" href="?del_id=<?php echo $row['exp_id']; ?>">Remove</a>
						</td>
                      </tr>
				<div id="updateordinance<?php echo $row['exp_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Expense Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="POST" action="expense_update.php">
                <div class="form-group">
                    <label for="name">Expense Serial</label>
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="exp_id" value="<?php echo $row['exp_id'];?>">  
                      <input type="text" class="form-control" id="name" name="exp_id" value="<?php echo $row['exp_id'];?>" readonly="">  
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Expense Type</label>
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="pay_type" value="<?php echo $row['pay_type'];?>"> 
                      <input type="text" class="form-control" id="name" name="pay_type" value="<?php echo $row['pay_type'];?>">  
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Expense Amount</label>
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="pay_date" value="<?php echo $row['pay_date'];?>">  
                      <input type="text" class="form-control" id="name" name="payment" value="<?php echo $row['payment'];?>">  
                    </div>
                </div> 
                <div class="form-group">
                  <label for="name">Date</label>
                  <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="pay_id" value="<?php echo $row['pay_id'];?>">  
                    <input type="date" class="form-control" id="name" name="exp_date" value="<?php echo $row['exp_date'];?>">  
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
                  <h3 class="box-title">Add New Expense</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
          <form method="POST" action="">
                <div class="form-group">
                    <label for="date">Expense Type</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="pay_type" placeholder="Write Type Of Expense">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->                
                <div class="form-group">
                    <label for="date">Amount</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="exp_amount" placeholder="Amout to give the staff">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                    <label for="date">Date</label>
                    <div class="input-group col-md-12">
                      <input type="date" class="form-control pull-right" id="date" name="exp_date" value="<?php echo date('Y-m-d')?>">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
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
