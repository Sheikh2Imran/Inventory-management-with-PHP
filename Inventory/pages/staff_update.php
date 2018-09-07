<?php session_start();
if(empty($_SESSION['id'])):
echo "<script>document.location='../index.php'</script>";
endif;
include('../dist/includes/dbcon.php');
    if(!isset($_GET['staff_id']) || $_GET['staff_id']==NULL){
        echo "<script> location.href='home.php'; </script>";
    }else{
        $staff_id = $_GET['staff_id'];
    }

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $doj = mysqli_real_escape_string($con, $_POST['doj']);
        $designation = mysqli_real_escape_string($con, $_POST['designation']);
        $salary = mysqli_real_escape_string($con, $_POST['salary']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $f_name = mysqli_real_escape_string($con, $_POST['f_name']);
        $m_name = mysqli_real_escape_string($con, $_POST['m_name']);
        $dob = mysqli_real_escape_string($con, $_POST['dob']);
        $education = mysqli_real_escape_string($con, $_POST['education']);
        $addr = mysqli_real_escape_string($con, $_POST['addr']);
        $mob = mysqli_real_escape_string($con, $_POST['mob']);

        $file_name = $_FILES['photo']['name'];

        $uploaded_image = "../uploads/".$file_name;

        if (!empty($file_name)) {
            move_uploaded_file($file_name, $uploaded_image);
            //mysqli_query($con,"CALL update_staff('$staff_id','$doj','$designation','$salary','$uploaded_image','$name','$f_name','$m_name','$dob','$education','$addr','$mob',@msg)");

            mysqli_query($con,"UPDATE staff 
                SET 
                staff_id = '$staff_id',
                doj='$doj',
                designation = '$designation',
                salary = '$salary',
                photo = '$uploaded_image',
                name = '$name',
                f_name = '$f_name',
                m_name = '$m_name',
                dob = '$dob',
                education = '$education',
                addr = '$addr',
                mob = '$mob'
                WHERE staff_id = '$staff_id'"); 

            echo '<script type="text/javascript">alert("Data is updated successfully !!");</script>';
            echo "<script>document.location='staff.php'</script>"; 
        } else{
            //mysqli_query($con,"CALL update_without_image_staff('$staff_id','$doj','$designation','$salary','$name','$f_name','$m_name','$dob','$education','$addr','$mob',@msg))");
        echo "<script>document.location='staff.php'</script>"; 
    }
    }
?>