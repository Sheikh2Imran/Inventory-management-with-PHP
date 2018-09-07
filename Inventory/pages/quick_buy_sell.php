<?php 
    include('../dist/includes/dbcon.php');
    if(!isset($_GET['deli_id'])){
        echo "<script>location.href = 'home.php';</script>";
    }else{
        $deli_id=$_GET['deli_id'];
        $status = $_GET['status'];
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quick buy/sell</title>
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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <style type="text/css">
        a{
            color: black;
        }
    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition-skin layout-top-nav">
    <div class="wrapper">
      <!-- Full Width Column -->
      <div class="content-wrapper" style="min-height: 560px;">
        <div class="container">
          <!-- Content Header (Page header) -->
          <form method="POST" action="">
          <section class="content-header">
            <?php if ($status == "buy") { ?>
                <center><b><h3 style="margin-top: -5px;">Buy Product</h3></b></center> 
            <?php }else{  ?>
                <center><b><h3 style="margin-top: -5px;">Sell Product</h3></b></center> 
            <?php } ?>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Quick buy/sell Product</li>
            </ol>
          </section>
        </form>
          <!-- Main content -->
          <section class="content">
            <div class="row" style="margin-top: 10px;">
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header">
                  <h4 class="box-title">
                </h4>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Product</th>
                        <th>Unit price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Discount</th>
                        <th>Price</th>
                        <th>VAT</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
            <?php
                $query1=mysqli_query($con,"select * from delivery_details_temp_view where deli_id='$deli_id'");
                $i=0;
                while($row1=mysqli_fetch_array($query1)){
                    $i++;
            ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row1['prod_name'];?></td>
                    <td><?php echo $row1['prod_price']; ?></td>
                    <td><?php echo $row1['dd_qty']; ?></td>
                    <td><?php echo $row1['total']; ?></td>
                    <td><?php echo $row1['dd_discount']; ?></td>
                    <td><?php echo $row1['ntotal']; ?></td>
                    <td><?php echo $row1['VAT']; ?></td>
                    <td><?php echo $row1['FTotal'];?></td>
                    <td>
                    <a href="#updateordinance<?php echo $row1['prod_id'];?>" data-target="#updateordinance<?php echo $row1['prod_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
                    ||
                    <a onclick="return confirm('Are you sure to delete this product?');" href="quick_product_delete.php?deli_id=<?php echo $deli_id;?>&status=<?php echo $status;?>&dd_id=<?php echo $row1['dd_id'];?>"><i class="glyphicon glyphicon-remove text-red"></i></a>
                    </td>
                  </tr>
    <div id="updateordinance<?php echo $row1['prod_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Product Details</h4>
              </div>
              <div class="modal-body">
            <form class="form-horizontal" method="POST" action="quick_product_update.php?deli_id=<?php echo $deli_id;?>&status=<?php echo $status;?>">
                <div class="form-group">
                <div class="input-group col-md-12">
                    <input type="hidden" class="form-control" id="name" name="dd_id" value="<?php echo $row1['dd_id'];?>" readonly="">  
                </div>
                </div>
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <div class="input-group col-md-12">
                        <textarea class="form-control" rows="2" readonly="">
                            <?php echo $row1['prod_name'];?>        
                        </textarea>  
                    </div>
                </div> 
                <div class="form-group">
                    <label for="date">Unit Price</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="prod_price" placeholder="Product unit price" value="<?php echo $row1['prod_price'];?>">
                    </div><!-- /.input group -->
                </div><!-- /.form group --> 
               <div class="form-group">
                    <label for="date">Quantity</label>
                    <div class="input-group col-md-12">
                      <input type="number" class="form-control pull-right" id="date" name="dd_qty" placeholder="Product Quantity" value="<?php echo $row1['dd_qty'];?>" >
                    </div><!-- /.input group -->
                </div><!-- /.form group -->                        
                <div class="form-group">
                    <label for="date">% Discount</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="pdisc" placeholder="Product dd_discount" value="<?php echo $row1['pdisc'];?>">
                    </div><!-- /.input group -->
                </div><!-- /.form group --> 
                <div class="form-group">
                    <div class="input-group col-md-12">
                      <input type="hidden" class="form-control pull-right" id="date" name="pvat" placeholder="Product dd_discount" value="<?php echo $row1['pvat'];?>">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                </div>
                <hr>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit5">Save changes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div><!--end of modal-dialog-->
    </div><!--end of modal-->   
<?php } ?>         

    <?php
        $query=mysqli_query($con,"select * from delivery_temp_view where deli_id='$deli_id'");
        $row=mysqli_fetch_array($query);
    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="font-size: 12px;border-top: 2px solid black"><b>Total Price:</b></td>
                        <td style="font-size: 12px;border-top: 2px solid black"><?php echo "<b>".$row['total'];?></td>
                        <td></td>
                    </tr> 
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="font-size: 12px"><b>- <?php echo $row['p_disc']."%";?> Discount :</b></td>
                        <td style="font-size: 12px"><?php echo "<b>".$row['per_disc'];?> </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="font-size: 12px"><b>- Overall Discount :</b></td>
                        <td style="font-size: 12px"><?php echo "<b>".$row['o_disc'];?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="font-size: 12px;border-top: 2px solid black"><b>Subtotal :</b></td>
                        <td style="font-size: 12px;border-top: 2px solid black"><?php echo "<b>".$row['subtotal'];?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="font-size: 12px;"><b>- <?php echo $row['per_vat']."%";?> VAT :</b></td>
                        <td style="font-size: 12px;"><?php echo "<b>".$row['vat'];?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="font-size: 12px;border-top: 2px solid black"><b>Grand Total Price:</b></td>
                        <td style="font-size: 12px;border-top: 2px solid black"><?php echo "<b>".$row['Grand'];?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="font-size: 12px;border-top: 2px solid black"><b>Paid Amount:</b></td>
                        <td style="font-size: 12px;border-top: 2px solid black"><?php echo "<b>".$row['paid'];?></td>
                        <td></td>
                    </tr>
                    <tr>
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
                    </tr> 
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $prod_id = mysqli_real_escape_string($con, $_POST['prod_id']);
        $dd_qty = mysqli_real_escape_string($con, $_POST['dd_qty']);
        mysqli_query($con,"CALL insert_deli_det('$prod_id','$dd_qty','$deli_id',@msg)");
        echo "<script>document.location='quick_buy_sell.php?deli_id=$deli_id&status=$status'</script>";   
    } 
?>

      <div class="col-md-3">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Add new product to order</h3>
                </div>
                <div class="box-body">
            <form method="POST" action="">
                <div class="form-group">
                <label for="exampleFormControlSelect1">Product name</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="prod_id">
            <?php
                $query2=mysqli_query($con,"select * from product");
                while($row8=mysqli_fetch_array($query2)){ ?>
                    <option value="<?php echo $row8['prod_id'];?>"><?php echo $row8['prod_name'];?>-<?php echo $row8['prod_desc_short'];?></option>
            <?php } ?>
                  </select>
              </div>
               <div class="form-group">
                    <label for="date">Quantity</label>
                    <div class="input-group col-md-12">
                      <input type="number" class="form-control pull-right" id="date" name="dd_qty" placeholder="Quantity of product" required>
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                    <div class="input-group">
                      <input type="submit" class="btn btn-primary" value="Add Product">
                    </div>
                </div><!-- /.form group -->
            </form>   
                </div><!-- /.box-body -->
              </div><!-- /.box -->
<?php 
    if (isset($_POST['submit4'])) {
        $p_disc = mysqli_real_escape_string($con, $_POST['p_disc']);
        $deli_discount = mysqli_real_escape_string($con, $_POST['deli_discount']);
        $vat = mysqli_real_escape_string($con, $_POST['vat']);
        mysqli_query($con,"CALL update_perdisc_delivery('$deli_id','$p_disc',@msg)");
        mysqli_query($con,"CALL update_disc_delivery('$deli_id','$deli_discount',@msg)");
        mysqli_query($con,"CALL update_vat_delivery('$deli_id','$vat',@msg)");
        echo "<script>location.href = 'quick_buy_sell.php?deli_id=$order_id&status=$status';</script>";
     }
?>
             <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Overall Discount / VAT</h3>
                </div>
                <div class="box-body">
        <?php
            $qry1=mysqli_query($con,"select * from create_delivery where deli_id='$deli_id'");
            $data1=mysqli_fetch_array($qry1);
        ?>
            <form method="POST" action="">
                <div class="form-group">
                <label for="date">Discount Amount (%)</label>
                <div class="input-group col-md-12">
                <input type="text" name="p_disc" value="<?php echo $data1['p_disc'];?>" />
                </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                <label for="date">Discount Amount (TK.)</label>
                <div class="input-group col-md-12">
                <input type="text" name="deli_discount" value="<?php echo $data1['deli_discount'];?>" />
                </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                <label for="date">VAT Amount (%)</label>
                <div class="input-group col-md-12">
                <input type="text" name="vat" value="<?php echo $data1['vat'];?>" />
                </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                    <div class="input-group">
                      <button class="btn btn-primary" name="submit4">
                        Give Discount / VAT
                      </button>
                    </div>
                </div><!-- /.form group -->
            </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            <?php
                $qry=mysqli_query($con,"select paid_amount from create_delivery where deli_id='$deli_id'")or die(mysqli_error());
                $value=mysqli_fetch_array($qry);
            ?> 
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Paid Amount</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
            <form method="POST" action="quick_paid_amount.php?deli_id=<?php echo $deli_id;?>&status=<?php echo $status;?>">
                <div class="form-group">
                    <label for="date">Cash Amount</label>
                    <div class="input-group col-md-12">
                    <input type="text" name="paid_amount" value="<?php echo $value['paid_amount'];?>">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                    <div class="input-group">
                      <button class="btn btn-primary" name="submit">
                         Payment
                      </button>
                    </div>
                  </div><!-- /.form group -->
            </form> 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demo-1">CONFIRM</button>
            <button type="button" onclick="return confirm('Are you sure to Remove this delivery?');" class="btn btn-danger"><a href="cancel_incomplete_delivery_page.php?deli_id=<?php echo $deli_id;?>">CANCEL</a></button>
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
            <h4>Are you sure to <?php echo $status;?> these products ?</h4>
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
            <button type="button" name="submit404" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-"><a onclick="window.open('','_self').close();" href="form/quick_sell_buy_invoice.php?deli_id=<?php echo $deli_id;?>" target="_blank">Print Bill</a></button>
        </div>
     </div>
    </div>
  </div>
            </div><!-- /.col (right) -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
<?php include('../dist/includes/footer.php');?>
