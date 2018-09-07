<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');

if(!isset($_GET['m_id'])){
        echo "<script>location.href = 'home.php';</script>";
    }else{
        $m_id = $_GET['m_id'];
        $query=mysqli_query($con,"select m_name from member where m_id='$m_id'");
        $row=mysqli_fetch_array($query);
        $m_name = $row['m_name'];
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Supplier Ledger View</title>
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
    <style type="text/css">
        body { font-size: 120%; }
    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper" style="min-height: 60px">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header" style="text-transform: uppercase;font-weight: bold;line-height: 20px;">
            <h1></h1>
            <center><b><h4>Total Transactions List of <?php echo $m_name;?></h4></center></b>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Supplier ledger view</li>
            </ol>
          </section>
          <section class="content" style="min-height: 500px">
            <div class="row">
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Supplier Ledger List</h3>
                </div>
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th style="text-align: right;">Debit</th>
                        <th style="text-align: right;">Credit</th>
                      </tr>
                    </thead>
                    <tbody>
    <?php
        $query=mysqli_query($con,"select * from supplier_ledger_view_display where m_id='$m_id'");
            while($row=mysqli_fetch_array($query)){
    ?>
            <tr>
                <td><?php echo $row['deli_date'];?></td>
                <td><?php echo $row['Description'];?></td>
                <td style="text-align: right;"><?php echo $row['Debit'];?></td>
                <td style="text-align: right;"><?php echo $row['Credit'];?></td>
            </tr>
    <?php } ?>

    <?php
        $query=mysqli_query($con,"select * from sum_supplier_ledger_view where m_id='$m_id'");
            $row=mysqli_fetch_array($query);
    ?>
            <tr>
                <td></td>
                <td style="text-align: right;"><b>TOTAL:</b></td>
                <td style="text-align: right;"><b><?php echo $row['total_debit'];?></b></td>
                <td style="text-align: right;"><b><?php echo $row['total_credit'];?></b></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="text-align: right;"><b>TOTAL DUE:</b></td>
                <td style="text-align: right;"><b><?php echo $row['DUE'];?></b></td>
            </tr>
                    </tbody>
                  </table> 
                </div>
            </div>
          </div>
            <div class="col-md-3">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title" style="text-align: center;">New Payment</h3>
                </div>
                <div class="box-body">
    <?php 
        if(isset($_POST['submit'])){
        $pay_date = mysqli_real_escape_string($con, $_POST['pay_date']);
        $payment  = mysqli_real_escape_string($con, $_POST['payment']);
        
        mysqli_query($con,"CALL insert_payment('$m_id','$pay_date','$payment',@msg)");
        $query = mysqli_query($con,"select @msg");
        $result = mysqli_fetch_assoc($query);
        $msg = $result['@msg'];
        echo '<script type="text/javascript">alert("'.$msg.'");</script>'; 
        echo "<script>document.location='ledger_supplier.php?m_id=$m_id'</script>";
        }
    ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="date">Amount</label>
                    <div class="input-group col-md-12">
                    <input type="text" name="payment" placeholder="Enter Payment Amount" min="0">
                    </div>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <div class="input-group col-md-12">
                    <input type="date" name="pay_date" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                      <button class="btn btn-primary" name="submit">
                         Payment
                      </button>
                    </div>
                  </div>
            </form> 
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
<?php include('../dist/includes/footer.php');?>