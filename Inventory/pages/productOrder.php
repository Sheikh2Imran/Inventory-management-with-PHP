<?php session_start();
include('../dist/includes/dbcon.php');
if(!isset($_GET['order_id']) || $_GET['order_id']==NULL){
    echo "<script>location.href = 'home.php';</script>";
}else{
    $order_id=$_GET['order_id'];
    $m_id=$_GET['m_id'];
}  
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product Order</title>
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
    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin- layout-top-nav">
    <div class="wrapper">
      <!-- Full Width Column -->
      <div class="content-wrapper" style="min-height: 560px;">
        <div class="container">
          <!-- Content Header (Page header) -->
          <form method="POST" action="">
          <section class="content-header" style="text-transform: uppercase;font-weight: bold;line-height: 20px;">
        <?php 
            $query=mysqli_query($con,"SELECT buy_sell_status FROM create_order WHERE order_id='$order_id'")or die(mysqli_error());
            $row=mysqli_fetch_array($query);
            $status = $row['buy_sell_status'];
            if ($status == 'buy') { ?>
            <center><b><h3>Product Order To Buy</h3></center></b>  
        <?php }elseif ($status == 'sell') { ?> 
            <center><b><h3>Product Order To Sell</h3></center></b>
        <?php } ?>
            
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Order no - <?php echo $order_id;?></li>
            </ol>
          </section>
          </form>
          <!-- Main content -->
          <section class="content">
            <div class="row" style="margin-top: 10px;">
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header">
                  <h4 class="box-title">Product List of Order No - <?php echo $order_id;?> & Member No - <?php echo $m_id;?>
                </h4>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="table table-bordered table-striped">
                    <thead style="font-size:12px;">
                      <tr>
                        <th>SL</th>
                        <th style="width: 350px">Product Name</th>
                        <th>Unit price</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Disc</th>                  
                        <th>Total</th> 
                        <th>Action</th>                      
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
    <?php
        $query=mysqli_query($con,"select * from order_details_temp_view where order_id='$order_id'")or die(mysqli_error());
                $i=0;
                while($row=mysqli_fetch_array($query)){
                    $i++;
    ?>
          <tr>
            <td><?php echo $i;?></td>
            <td style="width: 350px"><?php echo $row['prod_name'];?></td>
            <td><?php echo $row['prod_price'];?></td>
            <td><?php echo $row['od_qty'];?></td>
            <td><?php echo $row['price'];?></td>
            <td><?php echo $row['od_discount'];?></td>
            <td><?php echo $row['Total'];?></td>
            <td>
            <a href="#updateordinance<?php echo $row['prod_id'];?>" data-target="#updateordinance<?php echo $row['prod_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
                ||
            <a onclick="return confirm('Are you sure to delete?');" href="order_product_delete.php?od_id=<?php echo $row['od_id'];?>&order_id=<?php echo $order_id;?>&m_id=<?php echo $m_id;?>"><i class="glyphicon glyphicon-remove text-red"></i></a>
            </td>
            <td><?php echo $row['status'];?></td>
          </tr>
<div id="updateordinance<?php echo $row['prod_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Product Order Details</h4>
              </div>
              <div class="modal-body">
              <form class="form-horizontal" method="POST" action="order_product_update.php?order_id=<?php echo $order_id;?>&m_id=<?php echo $m_id;?>">
                <div class="form-group">
                  <label for="name">Product id</label>
                  <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="prod_id" value="<?php echo $row['prod_id'];?>" required>  
                    <input type="text" class="form-control" id="name" name="prod_id" value="<?php echo $row['prod_id'];?>" readonly="">  
                  </div>
                </div>
                <div class="form-group">
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="od_id" value="<?php echo $row['od_id'];?>" required>   
                    </div>
                </div> 
                <div class="form-group">
                    <label for="name">Ordered Quantity</label>
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="od_qty" value="<?php echo $row['od_qty'];?>" required>  
                      <input type="text" class="form-control" id="name" name="od_qty" value="<?php echo $row['od_qty'];?>" required>  
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Product Price</label>
                    <div class="input-group col-md-12"><input type="hidden" class="form-control" id="id" name="prod_price" value="<?php echo $row['prod_price'];?>" required>  
                      <input type="text" class="form-control" id="name" name="prod_price" value="<?php echo $row['prod_price'];?>" required>  
                    </div>
                </div>
               <div class="form-group">
                    <label for="date">Discount (%)</label>
                    <div class="input-group col-md-12">
                      <input type="text" class="form-control pull-right" id="date" name="p_disc" placeholder="Discount of the product" value="<?php echo $row['p_disc'];?>" required>
                    </div><!-- /.input group -->
                </div><!-- /.form group -->   
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
            <?php 
                $query=mysqli_query($con,"select * from order_temp_view where order_id='$order_id' and m_id='$m_id'");
                $row=mysqli_fetch_array($query);
            ?> 
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td colspan="2" style="font-size: 12px;border-top: 2px solid black"><b>Total Price:</b></td>
                      <td style="font-size: 12px;border-top: 2px solid black"><?php echo "<b>".$row['total'];?></td>
                    <td></td>
                    <td></td>
                    </tr>
                    <tr>
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
                      <td colspan="2" style="font-size: 12px;border-top: 2px solid black"><b>Grand Total Price:</b></td>
                      <td style="font-size: 12px;border-top: 2px solid black"><?php echo "<b>".$row['Grand'];?></td>
                    <td></td>
                    <td></td>
                    </tr>        
                    </tbody>
                  </table>

                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->
<?php 
    if (isset($_POST['submit3'])) {
        $prod_id = mysqli_real_escape_string($con, $_POST['prod_id']);
        $od_qty = mysqli_real_escape_string($con, $_POST['od_qty']);
        mysqli_query($con,"CALL insert_order_det('$prod_id','$od_qty','$order_id',@p_order,@p_msg)");
        echo "<script>location.href = 'productOrder.php?order_id=$order_id&m_id=$m_id';</script>";
    }
?>
      <div class="col-md-3">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Add New Product To Order</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
          <form method="POST" action="">
                <div class="form-group">
                <label for="exampleFormControlSelect1">Product name</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="prod_id"  style="font-size: 12px;">
            <?php
                $query2=mysqli_query($con,"select concat(prod_name,'-',prod_desc_short) as prod_short_long,prod_id from product")or die(mysqli_error());
                while($row=mysqli_fetch_array($query2)){ ?>
                    <option value="<?php echo $row['prod_id'];?>"><?php echo $row['prod_short_long'];?></option>
            <?php } ?>
                  </select>
              </div> 
               <div class="form-group">
                    <label for="date">Quantity</label>
                    <div class="input-group col-md-12">
                      <input type="number" class="form-control pull-right" id="date" name="od_qty" min="0" placeholder="Quantity of product" required>
                    </div><!-- /.input group -->
                </div><!-- /.form group --> 
                      <div class="form-group">
                        <div class="input-group">
                          <button class="btn btn-primary" name="submit3">
                            Add Product
                          </button>
                        </div>
                      </div><!-- /.form group -->
                  </form>   
                </div><!-- /.box-body -->
              </div><!-- /.box -->
<?php 
    if (isset($_POST['submit4'])) {
        $p_disc = mysqli_real_escape_string($con, $_POST['p_disc']);
        $vat = mysqli_real_escape_string($con, $_POST['vat']);
        $order_discount = mysqli_real_escape_string($con, $_POST['order_discount']);
        mysqli_query($con,"CALL update_perdisc_order('$order_id','$p_disc',@msg)");
        mysqli_query($con,"CALL update_vat_order('$order_id','$vat',@msg)");
        mysqli_query($con,"CALL update_disc_order('$order_id','$order_discount',@msg)");
    echo "<script>location.href = 'productOrder.php?order_id=$order_id&m_id=$m_id';</script>";
     }
?>
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Overall Discount / VAT</h3>
                </div>
                <div class="box-body">
            <?php
                $qry1=mysqli_query($con,"select * from create_order where order_id='$order_id'")or die(mysqli_error());
                $data1=mysqli_fetch_array($qry1);
            ?>
            <form method="POST" action="">
                <div class="form-group">
                <label for="date">Discount Amount (%)</label>
                <div class="input-group col-md-12">
                <input type="text" name="p_disc" min="0" value="<?php echo $data1['p_disc'];?>" />
                </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                <label for="date">Discount Amount (TK.)</label>
                <div class="input-group col-md-12">
                <input type="text" name="order_discount" min="0" value="<?php echo $data1['order_discount'];?>" />
                </div><!-- /.input group -->
                </div><!-- /.form group -->
                <div class="form-group">
                <label for="date">VAT Amount (%)</label>
                <div class="input-group col-md-12">
                <input type="text" name="vat" min="0" value="<?php echo $data1['vat'];?>" />
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
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demo-1">CONFIRM</button>
              <button type="button" onclick="return confirm('Are you sure to Remove this order?');" class="btn btn-danger"><a href="cancel_incomplete_order_page.php?order_id=<?php echo $order_id;?>">CANCEL</a></button>
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
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-default"><a onclick="window.open('','_self').close();" href="form/productOrder_invoice.php?order_id=<?php echo $order_id;?>&m_id=<?php echo $m_id;?>" target="_blank">Print Bill</a></button>
        </div>
        
     </div>
    </div>
  </div>
              
            </div><!-- /.col (right) -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
