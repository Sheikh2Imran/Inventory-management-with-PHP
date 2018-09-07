<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

    if(!isset($_GET['trans_id']) || $_GET['trans_id']==NULL){
         echo "<script> location.href='member.php'; </script>";
    }else{
        $trans_id = $_GET['trans_id'];
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product</title>
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
    <style>
      
    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              <a class="btn btn-lg btn-warning" href="home.php">Back</a>
              
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Order</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
	      <div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Add Order</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
            <form method="POST" action="">
                <div class="form-group">
                <label for="date">Name</label>
                <div class="input-group col-md-12">
                <select class="form-control select2" name="mem_id">
              <?php
        		    include('../dist/includes/dbcon.php');
        		    $query2=mysqli_query($con,"select * from member")or die(mysqli_error());
        			  while($row=mysqli_fetch_array($query2)){
        	    ?>
			        <option value="<?php echo $row['mem_id'];?>"><?php echo $row['mem_name'];?></option>
	           <?php } ?>
                </select>
                </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                    <div class="input-group">
                      <button class="btn btn-primary" name="submit">
                        Search
                      </button>
                    </div>
                  </div><!-- /.form group -->
            </form> 
            <?php 
                if (isset($_POST['submit'])) {
                    $mem_id = mysqli_real_escape_string($con, $_POST['mem_id']);
            ?>
            <form method="POST" action="">
                <div class="form-group">
                <label for="date">Transaction ID</label>
                <div class="input-group col-md-12">
                <select class="form-control select2" name="trans_id">
                <?php
                    include('../dist/includes/dbcon.php');
                    $query=mysqli_query($con,"select * from transaction_order where mem_id='$mem_id'")or die(mysqli_error());
                    while($data=mysqli_fetch_array($query)){
                ?>
                    <option value="<?php echo $data['trans_id']; ?>"><?php echo $data['trans_id']; ?></option>
                    <?php } ?>
                </select>
                </div><!-- /.input group -->
                </div><!-- /.form group -->
                  <div class="form-group">
                    <div class="input-group">
                      <button class="btn btn-primary" name="submit1">
                        Order list
                      </button>
                    </div>
                  </div><!-- /.form group -->
				</form>	
                <?php } ?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
            
            <div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Order List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
              <?php if (isset($_POST['submit1'])) { ?>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Order Id</th>
				        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
        <?php 
            $trans_id = mysqli_real_escape_string($con, $_POST['trans_id']);
        	$query=mysqli_query($con,"select * from tbl_order where trans_id='$trans_id'")or die(mysqli_error());
                $i=0;
        		while($row=mysqli_fetch_array($query)){
                    $i++;
        ?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row['id_order'];?></td>
            			<td><?php echo $row['date_order'];?></td>
                        <td><a href="">Edit</a> || <a href="">Delete</a></td>
                      </tr>     
            <?php } ?>					  
                    </tbody>
                  </table> 
                  <?php } ?>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    