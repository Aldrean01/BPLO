<?php
	require_once 'database/db_conn.php';
	if(ISSET($_POST['submit'])){
		$user_id = $_POST['user_id'];
		$image_name = $_FILES['photo']['name'];
		$image_temp = $_FILES['photo']['tmp_name'];
		$adminfix = $_POST['adminfix'];
		$feedback = $_POST['feedback'];
        $status = 'In progress';
		$previous = $_POST['previous'];
		$exp = explode(".", $image_name);
		$end = end($exp);
		$name = time().".".$end;
		if(!is_dir("./upload"))
			mkdir("upload");
		$path = "upload/".$name;
		$allowed_ext = array("gif", "jpg", "jpeg", "png");
		if(in_array($end, $allowed_ext)){
			if(unlink($previous)){
				if(move_uploaded_file($image_temp, $path)){
					mysqli_query($conn, "UPDATE `user` set `adminfix` = '$adminfix', `feedback` = '$feedback', `status` = '$status', `photo` = '$path' WHERE `user_id` = '$user_id'") or die(mysqli_error());
					echo "<script>alert('User account updated!')</script>";
					header("location: index.php");
				}
			}		
		}else{
			echo "<script>alert('Image only')</script>";
		}
	}
?>