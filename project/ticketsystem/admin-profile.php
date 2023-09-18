<!DOCTYPE html>
<?php
	session_start();
	if(!ISSET($_SESSION['id'])){
		header('location:index.php');
	}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/stylesheet.css"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>Maintanance Tab</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


<body>
<header class="header">
		<h1 class="logo">
            <a href="admin-index.php"><i class="fa fa-ticket" style="font-size25px;color:red"></i> Ticketing Tab</a>
        </h1>
        <ul class="main-nav">
          <li><a href="admin-index.php">Home</a></li>
          <li><a href="admin-profile.php">Profile</a></li>
          <li><a href="admin-accounts.php">accounts</a></li>
          <li><a href="admin-status.php">tickets</a></li>
          <li><a href="logout.php" class="btn fa fa-sign-out"></a></li>
        </ul>
    
        

    </header> 
    <div class="list">
        <div class="viewport" id="viewport">
                <!-- Sidebar -->
                <div  class="sidebar" id="sidebar">
                    <header>Profile</header>
                    <div class="text-center mt-3">
                <ul class="nav">
                    <li>
                    <a class="btn btn-success" href="admin-index.php">Home</a>
                    <a class="btn btn-success mt-3 " href="admin-updateprofile.php?id=<?php echo $_SESSION['id']?>">Update Profile</a>
                    <a class="btn btn-success" href="admin-data.php">My Tickets</a>
                    <a class="btn btn-success" onclick="history.go(-1);">Back </a>
                    </li>
                </ul>   
                    
                </div> 
        </div>
        <?php 

                require "database/db_conn.php";
                $query = mysqli_query($conn, "SELECT * FROM `account` WHERE `id`='$_SESSION[id]'") or die(mysqli_error());
                while ($row = mysqli_fetch_array($query)){
            ?>
                <!-- Content -->
                <div id="content"> 
                    <div class="container-fluid">

                        <div class="tickcontainer">
                <form action="" method="post">
                    <h1>My Profile</h1><br>
                        <div class="col mb-3">
                            <div class="form-group">
                                <label class="form-lebel">User Name</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $row['username'] ?>">
                            </div>
                        </div>

                        <div class="col mb-3">
                            <div class="form-group">
                                <label class="form-lebel">FullName</label>
                                <input type="text" class="form-control" name="fullname" value="<?php echo $row['fullname']?>">
                            </div>
                        </div>

                        <div class="col mb-3">
                            <div class="form-group">
                                <label class="form-lebel">Email</label>
                                <input type="text" class="form-control" name="email" value="<?php  echo $row['email']?>">
                            </div>
                        </div>

                        <div class="col mb-3">
                            <div class="form-group">
                                <label class="form-lebel">Password</label>
                                <input type="text" class="form-control" name="password" value="<?php  echo $row['password']?>">
                            </div>
                        </div>                     
                        <div class="date mb-3">
                            <div class="col">
                                <label class="form-lebel">Create Date:</label>
                                <?php  echo $row['create_datetime']?>
                            </div>
                        </div>
                                <center>
                                <a class="btn btn-danger" href="logout.php">Log out</a>
                                </center>
                            </div>


                    <?php
                }
                ?> 


                </form>
                        </div>
                    </div>
                </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous">
    </script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="js/profile.js"></script>

</body>
</html>