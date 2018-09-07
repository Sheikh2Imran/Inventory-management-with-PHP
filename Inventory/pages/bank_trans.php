<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');

if (isset($_POST['submit'])) {
    $bank_id = mysqli_real_escape_string($con, $_POST['bank_id']);
    $bt_date = mysqli_real_escape_string($con, $_POST['bt_date']);
    $bt_amount = mysqli_real_escape_string($con, $_POST['bt_amount']);
    $bt_status = mysqli_real_escape_string($con, $_POST['bt_status']);
    $payment_type = mysqli_real_escape_string($con, $_POST['payment_type']);

    mysqli_query($con,"CALL insert_bank_trans('$bank_id','$bt_date','$bt_amount','$bt_status','$payment_type',@msg)");
    $query = mysqli_query($con,"select @msg");
    $result = mysqli_fetch_assoc($query);
    $msg = $result['@msg'];
    echo '<script type="text/javascript">alert("'.$msg.'");</script>'; 
    echo "<script>document.location='bank_trans.php'</script>";    
} 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bank Transactions</title>
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
            <center><b><h3 style="margin-top: -40px;">Bank Transactions</h3></center></b>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Bank Transactions</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content" style="min-height: 460px">
            <div class="row">
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">The Total Bank Transactions List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Transaction ID</th>
                        <th>Bank Name</th>
						<th>Transaction Date</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Status</th>
                        <th style="text-align: right;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                		$query=mysqli_query($con,"SELECT * FROM bank_transection_view");
                		while($row=mysqli_fetch_array($query)){
                    ?>
                      <tr>
                        <td><?php echo $row['bt_id'];?></td>
                        <td><?php echo $row['bank_name'];?></td>
                        <td><?php echo $row['bt_date'];?></td>
                        <td><?php echo $row['debit'];?></td>
                        <td><?php echo $row['credit'];?></td>
                        <td><?php echo $row['bt_status'];?></td>
                        <td style="text-align: right;">
				        <a href="#updateordinance<?php echo $row['bt_id'];?>" data-target="#updateordinance<?php echo $row['bt_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue">Edit</i></a>
						</td>
                      </tr>
				<div id="updateordinance<?php echo $row['bt_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Transaction Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="POST" action="bank_trans_update.php">
                <div class="form-group">
                  <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="bt_id" value="<?php echo $row['bt_id'];?>" required>  
                    <input type="hidden" class="form-control" id="name" name="bt_id" value="<?php echo $row['bt_id'];?>" readonly="">  
                  </div>
                </div>  
                <div class="form-group">
                    <label for="name">Amount</label>
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="bt_amount" value="<?php echo $row['bt_amount'];?>"> 
                      <input type="text" class="form-control" id="name" name="bt_amount" value="<?php echo $row['bt_amount'];?>">  
                    </div>
                </div> 
                <div class="form-group">
                <label for="exampleFormControlSelect1">Transaction Status</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="bt_status">
                    <option value="<?php echo $row['bt_status'];?>"><?php echo $row['bt_status']; ?></option>
                  </select>
                </div>
                <div class="form-group">
                    <label for="name">Payment Type</label>
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="payment_type" value="<?php echo $row['payment_type'];?>"> 
                      <input type="text" class="form-control" id="name" name="payment_type" value="<?php echo $row['payment_type'];?>">  
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
                     <?php
                        $qry=mysqli_query($con,"SELECT * FROM bank_info_view");
                        while($data=mysqli_fetch_array($qry)){
                    ?> 
                      <tr>
                          <td></td>
                          <td></td>
                          <td style="text-align: right;"><b>Total : </b></td>
                          <td><b><?php echo $data['debit'];?></b></td>
                          <td><b><?php echo $data['credit'];?></b></td>
                          <td></td>
                          <td><b>Net Balance : <?php echo $data['balance'];?></b></td>
                      </tr>
                      <?php } ?>				  
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->

	  <div class="col-md-3">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Add New Transaction</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
          <form method="POST" action="">
                <div class="form-group">
                <label for="exampleFormControlSelect1">Bank Name</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="bank_id">
                    <?php 
                        $query=mysqli_query($con,"select bank_name,bank_id from bank_info");
                        while($row=mysqli_fetch_array($query)){ ?>
                    <option value="<?php echo $row['bank_id'];?>"><?php echo $row['bank_name'];?></option>
                        <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                    <label for="date">Transaction Date</label>
                    <div class="input-group col-md-12">
                      <input type="date" class="form-control pull-right" id="date" name="bt_date" value="<?php echo date('Y-m-d')?>">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                    <label for="date">Amount</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="bt_amount" placeholder="Amount to transaction">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                <label for="exampleFormControlSelect1">Transaction Status</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="bt_status">
                    <option value="deposit">Deposite</option>
                    <option value="withdraw">Withdraw</option>
                  </select>
                </div>
                <div class="form-group">
                    <label for="date">Payment type</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="payment_type" placeholder="Amount to transaction">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
				  <div class="form-group">
					<div class="input-group">
					  <button class="btn btn-primary" name="submit">
						DONE
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
