<!DOCTYPE html>
<?php
	session_start();
	if(!ISSET($_SESSION['username'])){
		header('location:login.php');
	}
?>
<?php

include "database/db_conn.php";
$id = $_GET['id'];
if(isset($_POST["submit"])) {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "UPDATE `account` SET `username`='$username',`fullname`='$fullname',`email`='$email',`password`='$password' 
    WHERE id='$id'";

    $result = mysqli_query($conn, $sql);

    if($result) {
        header("location: user_profile.php?msg=Data update successfully");
    }
    else{
        echo "failed " . mysql_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/stylesheet.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>Maintanance Tab</title>
</head>
<body>
    
<header class="header">
		<h1 class="logo">
            <a href="user_index.php"><i class="fa fa-ticket" style="font-size25px;color:red"></i> Ticketing Tab</a>
        </h1>
        <ul class="main-nav">
          <li><a href="user_index.php">Home</a></li>
          <li><a href="user_profile.php">profile</a></li>
          <li><a href="user_myticket.php">my ticket</a></li>
          <li><a href="logout.php" class="btn fa fa-sign-out"></a></li>
        </ul>
    
    </header>  
    <div class="tickcontainer">
        <div class="text-center">
            <h3>Edit Information</h3>
            <p class="text-muted">Click update after changing any Information</p>
        </div>
        <?php 
        $id = $_SESSION['username'];
        $sql = "SELECT * FROM account WHERE username = '$id' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>

        <div class="ticketform justify-content-center">
            <form action="" method="post">
            <div class="form mb-3">
                <div class="col">
                    <label class="form-lebel">User Name</label>
                    <input type="text" class="form-control" name="username"
                   value="<?php echo $row['username']?>">
                </div>
            </div>

            <div class="form mb-3">
                <div class="col">
                    <label class="form-lebel">Full Name</label>
                    <input type="text" class="form-control" name="fullname"
                   value="<?php  echo $row['fullname']?>">
                </div>
            </div>

            <div class="form mb-3">
                <div class="col">
                    <label class="form-lebel">Email</label>
                    <input type="text" class="form-control" name="email"
                   value="<?php  echo $row['email']?>">
                </div>
            </div>

            <div class="form mb-3">
                <div class="col">
                    <label class="form-lebel">Passsword</label>
                    <input type="text" class="form-control" name="password" value="<?php  echo $row['password']?>">
                </div>
            </div> 
            <div class="form mb-3">
                <div class="col">
                    <label class="form-lebel">Confirm Passsword</label>
                    <input type="text" class="form-control" name="password" placeholder="New Password">
                </div>
            </div> 
            
            <div class="form mb-3">
                <div class="col">
                    <label class="form-lebel">Create Date:</label>
                    <?php  echo $row['create_datetime']?>
                </div>
            </div>

            <div class="form-btn">
                <button type="submit" class="btn btn-success" name="submit">Update</button>
                <a href="user_profile.php" class="btn btn-danger">Cancel</a>
            </div>
            
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous">
    </script>

</body>
</html>