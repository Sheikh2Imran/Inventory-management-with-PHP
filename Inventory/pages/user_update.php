<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;

include('../dist/includes/dbcon.php');
	$id = $_POST['id'];
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$status = mysqli_real_escape_string($con, $_POST['status']);
	
	
	mysqli_query($con,"update user set name='$name',username='$username',status='$status' where user_id='$id'")or die(mysqli_error($con));
	
	echo "<script type='text/javascript'>alert('Successfully updated user details!');</script>";
	echo "<script>document.location='user.php'</script>";
?>
