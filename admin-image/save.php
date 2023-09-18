<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "helpdesk";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	if (!$conn){
		die("connection failed ". mysqli_connect_error());
	}
	if(ISSET($_POST['save'])){
		$image_name = $_FILES['photo']['name'];
		$image_temp = $_FILES['photo']['tmp_name'];
		$exp = explode(".", $image_name);
		$end = end($exp);
		$name = time().".".$end;
		if(!is_dir("./upload"))
			mkdir("upload");
		$path = "upload/".$name;
		$allowed_ext = array("gif", "jpg", "jpeg", "png");
		if(in_array($end, $allowed_ext)){
			if(move_uploaded_file($image_temp, $path)){
				mysqli_query($conn, "INSERT INTO `ticketing`(`photo`) VALUES('', '$path')") or die(mysqli_error());
				echo "<script>alert('User account saved!')</script>";
				header("location: index.php");
			}	
		}else{
			echo "<script>alert('Image only')</script>";
		}
	}
?>