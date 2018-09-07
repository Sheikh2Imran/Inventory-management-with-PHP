<?php
//session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
date_default_timezone_set("Asia/Manila"); 
?>
<?php
include('../dist/includes/dbcon.php');

$branch=$_SESSION['branch'];
$query=mysqli_query($con,"select * from branch where branch_id='$branch'");
	$row=mysqli_fetch_array($query);
	$branch_name=$row['branch_name'];
?>
<header class="main-header">
	<nav class="navbar navbar-static-top">
		<div class="container">
			<div class="navbar-header" style="padding-left:20px">
				<a href="home.php" class="navbar-brand" style="color: red;"><b><i class="glyphicon glyphicon-home"></i> <?php echo "Home";?></b></a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
					<i class="fa fa-bars"></i>
				</button>
			</div>
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- Messages: style can be found in dropdown.less-->
						<li class="">
							<a href="log.php" class="dropdown-toggle">
								<i class="glyphicon glyphicon-list-alt"></i>
								History
							</a>
						</li>
						<!-- Notifications Menu -->
						<!-- Tasks Menu -->
		<li class="dropdown notifications-menu">
			<!-- Menu toggle button -->
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class="glyphicon glyphicon-wrench"></i> File
			</a>
			<ul class="dropdown-menu">
				<li>
					<!-- Inner Menu: contains the notifications -->
					<ul class="menu">
						<li><!-- start notification -->
							<a href="category.php">
								<i class="glyphicon glyphicon-list-alt text-green"></i> Category
							</a>
						</li><!-- end notification -->
						<li><!-- start notification -->
							<a href="product.php">
								<i class="glyphicon glyphicon-cutlery text-red"></i> Product
							</a>
						</li><!-- end notification -->
						<li><!-- start notification -->
							<a href="member.php">
								<i class="glyphicon glyphicon-user text-green"></i> Member
							</a>
						</li><!-- end notification -->
						<li><!-- start notification -->
							<a href="staff.php">
								<i class="glyphicon glyphicon-hand-right text-blue"></i> Staff
							</a>
						</li><!-- end notification -->
						<li><!-- start notification -->
							<a href="staff_payment.php">
								<i class="glyphicon glyphicon-briefcase text-red"></i> Staff Payment
							</a>
						</li><!-- end notification -->
						<li><!-- start notification -->
							<a href="expense.php">
								<i class="glyphicon glyphicon-signal text-blue"></i>Expense
							</a>
						</li><!-- end notification -->
						<li><!-- start notification -->
							<a href="bank_info.php">
								<i class="glyphicon glyphicon-briefcase text-green"></i>Bank Info
							</a>
						</li><!-- end notification -->
						<li><!-- start notification -->
							<a href="bank_trans.php">
								<i class="glyphicon glyphicon-briefcase text-red"></i>Bank Transections
							</a>
						</li><!-- end notification -->
					</ul>
				</li>
			</ul>
		</li>			
		<li class="dropdown notifications-menu">
			<!-- Menu toggle button -->
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class="glyphicon glyphicon-stats text-red"></i> Report
			</a>
			<ul class="dropdown-menu">
			 <li>
				<ul class="menu">
					<li><!-- start notification -->
						<a href="order_status.php">
							<i class="glyphicon glyphicon-signal text-blue"></i>
							<span style="color: black">Show specific order details</span>
						</a>
					</li><!-- end notification -->
				</ul>
			</li>
			</ul>
		</li>
			<li class="dropdown notifications-menu">
			<!-- Menu toggle button -->
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class="glyphicon glyphicon-zoom-in text-red"></i> Search
			</a>
			<ul class="dropdown-menu">
			 <li>
				<ul class="menu">
					<li><!-- start notification -->
						<a href="orderlist_search.php">
							<i class="glyphicon glyphicon-zoom-in text-blue"></i>
							<span style="color: red">Order</span> Search
						</a>
					</li><!-- end notification -->
					<li><!-- start notification -->
				 		<a href="date_wise_delivery_search.php">
							<i class="glyphicon glyphicon-zoom-in text-green"></i>Datewise <span style="color: red">Delivery Invoice</span> Search
						</a>
					</li><!-- end notification -->
					<li><!-- start notification -->
				 		<a href="product_range_search.php">
							<i class="glyphicon glyphicon-zoom-in text-green"></i>Product <span style="color: red">Stock</span> Search bellow certain num.
						</a>
					</li><!-- end notification -->
					<li><!-- start notification -->
				 		<a href="memberwise_search.php">
							<i class="glyphicon glyphicon-zoom-in text-green"></i>Member wise <span style="color: red">Order Search</span>
						</a>
					</li><!-- end notification -->
					<li><!-- start notification -->
				 		<a href="memberwise_delivery.php">
							<i class="glyphicon glyphicon-zoom-in text-green"></i>Member wise <span style="color: red">Delivery Search</span>
						</a>
					</li><!-- end notification -->
				</ul>
			</li>
			</ul>
		</li>
		<li class="">
			<!-- Menu Toggle Button -->
			<a href="profile.php" class="dropdown-toggle">
				<i class="glyphicon glyphicon-cog text-orange"></i>
				<?php echo $_SESSION['name'];?>
			</a>
		</li>
		<li class="">
			<!-- Menu Toggle Button -->
			<a href="logout.php" class="dropdown-toggle">
				<i class="glyphicon glyphicon-off text-red"></i> Logout 
				
			</a>
		</li>
	</ul>
		</div><!-- /.navbar-custom-menu -->
	</div><!-- /.container-fluid -->
</nav>
</header>