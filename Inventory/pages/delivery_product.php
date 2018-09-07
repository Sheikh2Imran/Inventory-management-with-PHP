<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
 
    if(!isset($_GET['order_id']) || !isset($_GET['deli_id'])){
        echo "<script>location.href = 'home.php';</script>";
    }else{
        $order_id=$_GET['order_id'];
        $deli_id=$_GET['deli_id'];
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Delivery Product</title>
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
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

    <style type="text/css">
        body { font-size: 120%; }
        input[type="number"] {
        width: 80px;
        border:none;
    }
    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');
      include('../dist/includes/dbcon.php');
      ?>
      <!-- Full Width Column -->
      <div class="content-wrapper" style="min-height: 560px;">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header" style="text-transform: uppercase;font-weight: bold;line-height: 20px;">
        <?php 
            $query=mysqli_query($con,"SELECT buy_sell_status,m_id FROM create_order WHERE order_id=$order_id")or die(mysqli_error());
            $row1=mysqli_fetch_array($query);
            $buy_sell_status = $row1['buy_sell_status'];
            $m_id = $row1['m_id'];
            if ($buy_sell_status == 'buy') { ?>
            <center><b><h3>Delivery Order To Buy</h3></b></center>
        <?php }elseif ($buy_sell_status == 'sell') { ?>
            <center><b><h3>Delivery Order To Sell</h3></b></center>
        <?php } ?>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Order no - <?php echo $order_id;?></li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
            <div class="row">
            <div class="col-md-10">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Product List of Delivery No - <?php echo $deli_id;?> & Order No - <?php echo $order_id;?></h3>
                </div>
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Product</th>
                        <th>Unit price</th>
                        <th>Qty</th>
                        <th>Delivered</th>
                        <th>Curr. Deli.</th>
                        <th>New</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>VAT</th>
                        <th>Total</th>
                        <th>Action</th>
                        <th>Stock</th>
                      </tr>
                    </thead>
                    <tbody>
    <?php
        $query1=mysqli_query($con,"select * from order_deli_view where order_id='$order_id'");
            $i=0;
            while($row=mysqli_fetch_array($query1)){
                $i++;
    ?>
                <tr>
                <form action="order_delivery_stock.php?deli_id=<?php echo $deli_id;?>&prod_id=<?php echo $row['prod_id'];?>&order_id=<?php echo $order_id;?>" method="POST">
                    <td><?php echo $i;?></td>
                    <td style="min-width:190px;"><?php echo $row['prod_name'];?></td>
                    <td><?php echo $row['prod_price'];?></td>
                    <td><?php echo $row['od_qty'];?></td>
                    <td><?php echo $row['dd_qty'];?></td>
                    <td><?php echo $row['nd_qty'];?></td>
                    <td>
                    <input type="number" name="dd_qty" />
                    </td>
                    <td><?php echo $row['total'];?></td>
                    <td><?php echo $row['dd_discount'];?></td>
                    <td><?php echo $row['VAT'];?></td>
                    <td><?php echo $row['Ftotal'];?></td>
                    <td><input type="submit" name="submit" value="OK" /></td>
                    <td><?php echo $row['prod_stock'];?></td>
                </form>
                </tr>         
            <?php } ?>
            <?php
                $query3=mysqli_query($con,"select * from delivery_temp_view where order_id='$order_id' and deli_id='$deli_id'");
                $row=mysqli_fetch_array($query3);
            ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" style="font-size: 12px;border-top: 2px solid black"><b>Total Price:</b></td>
                    <td style="font-size: 12px;border-top: 2px solid black"><?php echo "<b>".$row['total'];?></td>
                    <td></td>
                    <td></td>
                <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td colspan="2" style="font-size: 12px"><b>- <?php echo $row['p_disc']."%";?> Discount :</b></td>
                      <td style="font-size: 12px"><?php echo "<b>".$row['per_disc'];?> </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td colspan="2" style="font-size: 12px"><b>- Overall Discount :</b></td>
                      <td style="font-size: 12px"><?php echo "<b>".$row['o_disc'];?></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td colspan="2" style="font-size: 12px;border-top: 2px solid black"><b>Subtotal :</b></td>
                      <td style="font-size: 12px;border-top: 2px solid black"><?php echo "<b>".$row['subtotal'];?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td colspan="2" style="font-size: 12px;"><b>- <?php echo $row['per_vat']."%";?> VAT :</b></td>
                      <td style="font-size: 12px;"><?php echo "<b>".$row['vat'];?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td colspan="2" style="font-size: 12px;border-top: 2px solid black"><b>Grand Total:</b></td>
                      <td style="font-size: 12px;border-top: 2px solid black"><?php echo "<b>".$row['Grand'];?></td>
                    <td></td>
                    <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td colspan="2" style="font-size: 12px;border-top: 2px solid black"><b>Paid Amount :</b></td>
                      <td style="font-size: 12px;border-top: 2px solid black"><?php echo "<b>".$row['paid'];?></td>
                    <td></td>
                    <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <?php $DUE = $row['Grand']-$row['paid'];
                        if ($DUE >= 0) { ?>
                            <td colspan="2" style="font-size: 12px;border-top: 2px solid black"><b>DUE:</b></td>
                            <td style="font-size: 12px;border-top: 2px solid black"><?php echo "<b>".$DUE;?></td>
                        <?php } else{ ?>
                            <td colspan="2" style="font-size: 12px;border-top: 2px solid black"><b>CASH BACK:</b></td>
                            <td style="font-size: 12px;border-top: 2px solid black"><?php echo "<b>".-$DUE;?></td>
                        <?php } ?>
                    <td></td>
                    <td></td>
                    </tr>                 
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        <div class="col-md-2">
<?php
    if (isset($_POST['submit3'])){
        $deli_id = $deli_id;
        $paid_amount = mysqli_real_escape_string($con, $_POST['paid']);
        mysqli_query($con,"CALL update_payment_delivery('$deli_id','$paid_amount',@msg)");
    echo "<script>location.href = 'delivery_product.php?order_id=$order_id&deli_id=$deli_id';</script>";
    }     
?>
            <div class="box box-primary">
        <?php
            $query5=mysqli_query($con,"select * from delivery_temp_view where order_id='$order_id' and deli_id='$deli_id'");
            $row5=mysqli_fetch_array($query5);
        ?>
                <div class="box-header">
                  <h3 class="box-title">Payment</h3>
                </div>
                <div class="box-body">
          <form method="POST" action="">
               <div class="form-group">
                    <label for="date">Amount</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="paid" min="0" placeholder="Payment amount" value="<?php echo $row5['paid'];?>">
                    </div><!-- /.input group -->
                </div><!-- /.form group --> 
                      <div class="form-group">
                        <div class="input-group">
                          <button class="btn btn-primary" name="submit3">
                            Payment
                          </button>
                        </div>
                      </div><!-- /.form group -->
                  </form>   
                </div><!-- /.box-body -->
              </div><!-- /.box -->
<?php
    if (isset($_POST['submit4'])){
        $deli_id = $deli_id;
        $p_disc = mysqli_real_escape_string($con, $_POST['p_disc']);
        $deli_discount = mysqli_real_escape_string($con, $_POST['o_disc']);
        $pvat = mysqli_real_escape_string($con, $_POST['per_vat']);
        mysqli_query($con,"CALL update_perdisc_delivery('$deli_id','$p_disc',@msg)");
        mysqli_query($con,"CALL update_disc_delivery('$deli_id','$deli_discount',@msg)");
        mysqli_query($con,"CALL update_vat_delivery('$deli_id','$pvat',@msg)");
        echo "<script>location.href = 'delivery_product.php?order_id=$order_id&deli_id=$deli_id';</script>";
    }     
?>
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Discount / VAT</h3>
                </div>
                <div class="box-body">
          <form method="POST" action="">
                <div class="form-group">
                    <label for="date">% Discount</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="p_disc" placeholder="Discount amount" value="<?php echo $row5['p_disc']; ?>">
                    </div><!-- /.input group -->
                </div><!-- /.form group --> 
               <div class="form-group">
                    <label for="date">Overall Discount</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="o_disc" placeholder="Discount amount" value="<?php echo $row5['o_disc']; ?>">
                    </div><!-- /.input group -->
                </div><!-- /.form group --> 
                <div class="form-group">
                    <label for="date">VAT</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="per_vat" placeholder="VAT amount" value="<?php echo $row5['per_vat']; ?>">
                    </div><!-- /.input group -->
                </div><!-- /.form group --> 
                <div class="form-group">
                    <div class="input-group">
                      <button class="btn btn-primary" name="submit4">Give Discount / VAT</button>
                    </div>
                </div><!-- /.form group -->
                  </form>   
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demo-1">CONFIRM</button>
            <button type="button" onclick="return confirm('Are you sure to CANCEL this delivery?');" class="btn btn-danger"><a href="cancel_incomplete_delivery_page.php?deli_id=<?php echo $deli_id;?>">CANCEL</a></button>
  <!-- [ Modal #1 ] -->
  <div class="modal fade" id="demo-1" tabindex="-1">
    <div class="modal-dialog">
     <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title caps"><strong>Confirmation Popup</strong></h4>
      </div>
        <div class="modal-body">
            <h4>Are you sure to delivery these products ?</h4>
        </div>
       <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Decline</button>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#demo-2" data-dismiss="modal">Accept</button>
        </div>
     </div>
    </div>
  </div>
    <!-- [ Modal #2 ] -->
  <div class="modal fade" id="demo-2" tabindex="-1">
    <div class="modal-dialog">
     <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal"><i class="icon-xs-o-md"></i></button>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title caps"><strong>Confirmation Popup</strong></h4>
      </div>
        <div class="modal-body">
            <h4>Do you want to print this bill ?</h4>
        </div>
       <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-default"><a onclick="window.open('','_self').close();" href="form/deli_product_invoice.php?order_id=<?php echo $order_id;?>&deli_id=<?php echo $deli_id;?>" target="_blank">Print Delivery</a></button>
        </div>
     </div>
    </div>
  </div>
            </div><!-- /.box -->
        </div>
    </section><!-- /.content -->
    </div><!-- /.container -->
    </div><!-- /.content-wrapper -->
<?php include('../dist/includes/footer.php');?>