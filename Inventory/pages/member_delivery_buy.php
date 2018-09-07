<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Supplier List</title>
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
    <div class="wrapper" style="min-height: 60px">
      <?php include('../dist/includes/header.php');
        include('../dist/includes/dbcon.php'); ?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header" style="text-transform: uppercase;font-weight: bold;line-height: 20px;">
            <h1>
              <a class="btn btn-lg btn-warning" href="home.php">Back</a>
            </h1>
            <center><b><h3 style="margin-top: -40px;">Supplier List</h3></center></b>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Supplier List</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content" style="min-height: 500px">
            <div class="row">
        <div class="col-md-3"></div>
          <div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Select any supplier from here</h3>
                </div>
                <div class="box-body">
            <?php
                if (isset($_POST['submit'])) {
                    $m_id = mysqli_real_escape_string($con, $_POST['m_id']);
                    echo "<script>document.location='addOrder_seller.php?m_id=$m_id'</script>";
                }
            ?>
            <form method="POST" action="">
                <div class="form-group">
                <label for="date"></label>
                <div class="input-group col-md-12">
                <select required class="form-control select2" name="m_id">
                    <option value="">Select from here</option>
            <?php
                $query1=mysqli_query($con,"select DISTINCT m_id, company, Mobile from order_view where status='buy' order by m_id desc");
                  while($row1=mysqli_fetch_array($query1)){
            ?>
                    <option value="<?php echo $row1['m_id'];?>"><?php echo $row1['company']."-".$row1['Mobile'];?></option>
               <?php } ?>
                </select>
                </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                    <div class="input-group">
                      <button class="btn btn-primary" name="submit">
                        Show Order List
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
    