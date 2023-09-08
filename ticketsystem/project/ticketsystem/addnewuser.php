<?php
	session_start();
	if(!ISSET($_SESSION['username'])){
		header('location:login.php');
	}
?>

<?php

include "database/db_conn.php";
$username = $_SESSION['username'];
if(isset($_POST["submit"])) {
    $username = $_POST['username'];
    $sdate = $_POST['sdate'];
    $issue = $_POST['issue'];
    $comment = $_POST['comment'];
    $status = "pending";

    $sql = "INSERT INTO `ticketing`(`id`, `username`, `sdate`, `issue`, `comment`,`status`) 
    VALUES (NULL, '$username','$sdate','$issue','$comment','$status')";

    $result = mysqli_query($conn, $sql);


    if($result) {
        header("location: user_index.php?msg=New record  created successfully");
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
    <script src="picker.js"></script>
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

    <title>Ticketing Tab</title>
</head>
<body>
<header class="header">
		<h1 class="logo">
            <a href="user_index.php"><i class="fa fa-ticket" style="font-size25px;color:red"></i> Ticketing Tab</a>
        </h1>
        <ul class="main-nav">
          <li><a href="admin-index.php">Home</a></li>
          <li><a href="admin-profile.php">Profile</a></li>
          <li><a href="admin-accounts.php">accounts</a></li>
          <li><a href="admin-status.php">tickets</a>
          </li>
          <li><a href="logout.php" class="btn fa fa-sign-out"></a></li>
        </ul>
    
    </header>  
        <div class="tickcontainer">
            <div class="text-center">
                <h3>Add Tickets</h3>
                <p class="text-muted">Complete the form below to add a new user</p>
            </div>
            <form class="form"action="" method="post">
            <div class="col mb-3">
                <br>
                <div class="col">
                    <label class="form-lebel">UserName</label>
                    <input type="text" class="form-control" name="username"
                    value=<?php echo $username ?>>
                </div>
            </div>

            <div class="col">
                    <label class="form-lebel">Request Date</label>
                    <input type="date" class="form-control" name="sdate"
                    placeholder="Date" required>
            </div><br>
        

            <div class="form-group mb-3">
                <label>Support Type:</label>
                    <select  name="issue">
                        <option value="Software">SOFTWARE</option>
                        <option value="Internet">NETWORK</option>
                        <option value="Hardware">HARDWARE</option>
                    </select>
            </div>  

            <div class="form-comment mb-3">
                <label class="form-comments">Problem Description :</label><br>
                <textarea name="comment" id="4" cols="55" rows="4" placeholder="Enter you concern?"></textarea>
            </div>

            <div class="form-btn">
                <button type="submit" class="btn btn-success" name="submit">SUBMIT</button>
                <a href="user_index.php" class="btn btn-danger">Cancel</a>
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