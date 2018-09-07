<?php session_start();?>

<?php 
    if(!isset($_GET['mem_id']) || $_GET['mem_id']==NULL){
         echo "<script> location.href='member.php'; </script>";
    }else{
        $mem_id = $_GET['mem_id'];
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create transaction</title>
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
  <body class="hold-transition layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');
      include('../dist/includes/dbcon.php');
      ?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container" style="min-height: 550px;">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              <a class="btn btn-lg btn-warning" href="member.php">Back</a>
              
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
              <li class="active">Member</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
            <div class="row">
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Transaction List of this member</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Serial</th>
                        <th>Transaction ID</th>
						<th>Transaction Date</th>
                        <th>Balance</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                		$query=mysqli_query($con,"select * from transaction_order where mem_id='$mem_id'")or die(mysqli_error());
                        $i=0;
                		while($row=mysqli_fetch_array($query)){
                        $i++;  
                    ?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row['trans_id'];?></td>
                        <td><?php echo $row['trans_date'];?></td>
                        <td><?php 
                        $trans_id = $row['trans_id'];
                        $query3 = mysqli_query($con,"select debit from debit_view where debit_view_id='$trans_id'")or die(mysqli_error());
                        $query4 = mysqli_query($con,"select credit from credit_view where credit_view_id='$trans_id'")or die(mysqli_error());
                        $row3 = mysqli_fetch_array($query3);
                        $row4 = mysqli_fetch_array($query4);
                        $balance = $row3['debit']-$row4['credit'];
                        echo $balance.".00";
                        ?></td>
                        <td>
                        <a href="#createOrder<?php echo $row['trans_id'];?>" data-target="#createOrder<?php echo $row['trans_id'];?>" data-toggle="modal" class="small-box-footer">Create Order</a>
                        ||
                        <a onclick="return confirm('Are you sure to delete?');" href="delete_trans.php?trans_id=<?php echo $row['trans_id'];?>&mem_id=<?php echo $mem_id;?>">Delete</a>
			          </td>
                </tr>
  	
 <div id="createOrder<?php echo $row['trans_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Are you really want to create new order ?</h4>
              </div>
              <div class="modal-body">
              <form class="form-horizontal" method="post" action="order_add.php">
                <div class="form-group">
                      <input type="hidden" class="form-control" id="name" name="trans_id" value="<?php echo $row['trans_id'];?>" Readonly="">  
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group col-md-12">
                        <input type="hidden" name="date_order" value="<?php echo date('Y-m-d'); ?>"> 
                    </div>
                </div> 
                <div class="form-group"></div><hr>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
              </form>
            </div>
            
        </div><!--end of modal-dialog-->
 </div>                
<?php } ?>					  
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
 
            </div><!-- /.col -->
          </div><!-- /.row -->
	  <div class="col-md-3">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Create New Transaction</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="trans_add.php">
  
					  <div class="form-group">
						<label for="date">Transaction ID</label>
						<div class="input-group col-md-12">
						  <input type="text" class="form-control pull-right" id="date" name="trans_id" value="<?php echo $mem_id.-date("Y").-rand(1,1000);?>" readonly="">
						</div><!-- /.input group -->
					  </div><!-- /.form group -->
                      
    		         <div class="form-group">
                        <label for="date">Date</label>
                        <div class="input-group col-md-12">
                         <input type="date" class="form-control pull-right" id="date" name="trans_date" value="<?php echo date('Y-m-d'); ?>" required>
                        </div><!-- /.input group -->
                      </div><!-- /.form group -->  
                      <div class="form-group">
                        <label for="date"></label>
                        <div class="input-group col-md-12">
                          <input type="hidden" class="form-control pull-right" id="date" name="mem_id" value="<?php echo $mem_id; ?>" required>
                        </div><!-- /.input group -->
                      </div><!-- /.form group -->
					  <div class="form-group">
						<div class="input-group">
						  <button class="btn btn-primary" name="">
							Create
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
    