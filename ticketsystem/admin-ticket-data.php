<!DOCTYPE html>
<?php
	session_start();
	if(!ISSET($_SESSION['id'])){
		header('location:login.php');
	}
?>
<?php

include "database/db_conn.php";
$id = $_GET['id'];
if(isset($_POST["submit"])) {
    $adminfix = $_POST['adminfix'];
    $status = "In progress";

    $sql = "UPDATE `ticketing` SET `adminfix`='$adminfix', `status`='$status'
    WHERE id=$id";

    $result = mysqli_query($conn, $sql);



    if($result) {

        header("location:admin-data.php?msg=Data update successfully");
    }
    else{
        echo "failed " . mysql_error($conn);
    }
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/stylesheet.css"/>
    <link rel="stylesheet" href="css/div-report.css"/>
    

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
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <title>Maintanance Tab</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
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
                <header>
                    <a href="">HOME</a>
                    </header>
                    <ul class="nav mr-6">
                    <li style="margin-left: 10px;">
                        <a type="button " href="add_new.php" class="btn btn-success mb-3" data-toggle="modal" onclick="openModal()">Add Tickets</a>
                        <a class="btn btn-success" href="admin-data.php">Tickets</a>
                        <a class="btn btn-success" onclick="history.go(-1);">Back </a>
                    <div class="filters" id="filters">
                    </div>
                    </div>

                 <!--TABLE -->      
                <!-- Content -->
                
        <div class="tickcontainer" id="content"> 
            <?php 
            $id = $_GET['id'];
            $sql = "SELECT * FROM ticketing WHERE id = '$id' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <h2>Ticket Report</h2>
        <form action="" method="post" ><br>
            <div class="col mb-3">
                <div class="col">
                    <label class="form-lebel">UserName</label>
                    <input type="text" class="form-control" name="username"
                   value="<?php  echo $row['username']?>">
                </div>
            </div>

            <div class="form-group mb-3">
                    <label>Request Date:</label>
                    <input type="date" name="sdate"
                    value="<?php  echo $row['sdate']?>">
            </div>

            <div class="form-group mb-3">
                <label>Support Type:</label>
                    <input type="text" value="<?php  echo $row['issue']?>">
            </div>  

            <div class="form-comment mb-3">
                <label class="form-comments" >Problem Description :</label><br>
                <textarea type="text" class="form-control" id="4" cols="55" rows="4" name="comment"><?php  echo $row['comment']?></textarea>
            </div>
            
            <div class="form-group mb-3">
                <label>Select Status:</label>
                    <input value="<?php  echo $row['status']?>" >
            </div> 
             


            <p class="text-muted">(It Fix The Ticket)</p>
            <div class="col mb-3">
                <div class="col">
                    <label class="form-lebel">UserName</label>
                    <input type="text" class="form-control" name="adminfix"
                   value="<?php  echo $_SESSION['username']?>">
                </div>
            </div>

            <div class="form-btn content">
            <button type="submit" class="btn btn-primary" name="submit">Accept</button>
            <a class="btn btn-danger" onclick="history.go(-1);">Back </a>
           
            </div>
            </div>
        </form>
            </div>
        </div>
        </div>
    </div>
    <nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-green">
     
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous">
    </script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>




</body>
</html>