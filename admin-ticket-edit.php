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
    $username = $_POST['username'];
    $sdate = $_POST['sdate'];
    $issue = $_POST['issue'];
    $comment = $_POST['comment'];
    $status = $_POST['status'];
    $adminfix = $_POST['adminfix'];
    $feedback = $_POST['feedback'];

    $sql = "UPDATE `ticketing` SET `username`='$username',`sdate`='$sdate',`issue`='$issue',`comment`='$comment',`status`='$status',`adminfix`='$adminfix',`feedback`='$feedback'
    WHERE `id`='$id'";

    $result = mysqli_query($conn, $sql);


    if($result) {

        header("location:admin-update.php?msg=Data update successfully");
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
          <li><a href="admin-status.php">tickets</a>
          </li>
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
                    <ul class="nav">
                    <li>
                        <a class="btn btn-success" href="admin-data.php">My Tickets</a>
                        <a class="btn btn-success" onclick="history.go(-1);">Back </a>
                    </li>
                </div>
                 <!--TABLE -->      
 
                <!-- Content -->
        <div id="content"> 
            <div class="detail bg-smokewhite">
            <form action="" method="post" ><br>
            <?php 
            $id = $_GET['id'];
            $sql = "SELECT * FROM ticketing WHERE id = '$id' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <h1>Ticket Report</h1>
            <form action="" method="post" ><br>

            <div class="col mb-3">
                <div class="col">
                    <label class="form-lebel">UserName</label>
                    <input type="text" class="form-control" name="username"
                   value="<?php  echo $row['username']?>">
                </div>
            </div>

            <div class="col">
                    <label class="form-lebel">Request Date</label>
                    <input type="date" class="form-control" name="sdate"
                    value="<?php  echo $row['sdate']?>">
            </div><br>

        
            <div class="form-group mb-3">
                <label>Support Type:</label>
                    <select name="issue">
                        <option value="Software" <?php  echo ($row['issue']=='internet')? "checked":"";?>>SOFTWARE</option>
                        <option value="Internet" <?php  echo ($row['issue']=='hardware')? "checked":"";?>>INTERNET</option>
                        <option value="Hardware" <?php  echo ($row['issue']=='software')? "checked":"";?>>HARDWARE</option>
                    </select>
            </div>  

            <div class="form-comment mb-3">
                <label class="form-comments" >Problem Description :</label><br>
                <textarea type="text" class="form-control" id="4" cols="55" rows="4" name="comment"><?php  echo $row['comment']?></textarea>
            </div>
            
            <div class="form-group mb-3">
                <label>Select Status:</label>
                    <select name="status">
                    <option value="Done" <?php  echo ($row['issue']=='In Progress')? "checked":"";?>>Done</option>
                        <option value="Cancelled" <?php  echo ($row['issue']=='Pending')? "checked":"";?>>Cancelled</option>
                    </select>
            </div>  


            <p class="text-muted">(It Fix The Ticket)</p>
            <div class="col">
                    <label class="form-name"> Tech Name</label>
                    <input type="text" class="form-control" name="adminfix"
                    value="<?php  echo $row['adminfix']?>">
                </div>
                <div class="form-comment mb-3">
                <label class="form-comments" >Feedback:</label><br>
                <textarea type="text" class="form-control" id="4" cols="55" rows="4" name="feedback"><?php  echo $row['feedback']?></textarea>
            </div>
            <div class="form-btn content">
                <button type="submit" class="btn btn-success" name="submit">Submit</button>
                <a class="btn btn-danger" onclick="history.go(-1);">Back</a>
            </div>
                <br>
            </div>
            </form>
                    </div>
                </div>

    <div class="report bg-white">
        <div>
            <h2>Technician Report Image</h2>
            <form method='post' action='#' enctype='multipart/form-data'>
            <div class="form-group"><br>
                <label for="">Upload The Image</label>
                <input class="form-control" type="file" name="ticketing" id="file" multiple required>
            </div> 
        
    
            <?php
            if(isset($_POST['save'])){
            $id = $_GET['id'];
            $filename = $_FILES['ticketing']['name'];

            // Select file type
            $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));

            // valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif");

            // Check extension
            if( in_array($imageFileType,$extensions_arr) ){

            // Upload files and store in database
            if(move_uploaded_file($_FILES["ticketing"]["tmp_name"],'upload/'.$filename)){
                // Image db insert sql
                $insert = "UPDATE `ticketing` SET `photo`='$filename' WHERE id=$id";
                if(mysqli_query($conn, $insert)){
                echo '<h3>Data Inserted Successfully</h3>';
                }
                else{
                echo 'Error: '.mysqli_error($conn);
                }
            }else{
                echo 'Error in uploading file - '.$_FILES['ticketing']['name'].'<br/>';
            }
            }
            } 
            ?>
            <div id="display-image">
            <?php
                $id = $_GET['id'];
                $sql = "SELECT * FROM `ticketing` WHERE `id` = '$id' LIMIT 1";
                $result = mysqli_query($conn, $sql);
                while ($data = mysqli_fetch_assoc($result)) {
            ?>
                <img src="./upload/<?php echo $data['photo']; ?>">
        
            <?php
                }
            ?>
            <div class="form-group"> 
                <button type='save' name='save' value='Upload' class="btn btn-primary">Save</button>
            </div> 
            </div><br>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $("#statusval").on("change",function(){
                var value = $(this).val();
            //alert(value);
            $.ajax({
                    url:"filter/fetch.php",
                    type:"POST",
                    data:"request=" + value,
                    beforeSend:function(){
                        $(".container-fluid").html("<span>working...</span>");
                    },
                    success:function(data){
                        $(".container-fluid").html(data);
                    }
                
                });
            });
        });

    </script>
    <script type="text/javascript">
                $(document).ready(function(){
                    $("#issue").on("change",function(){
                        var value = $(this).val();
                    //alert(value);
                    $.ajax({
                            url:"filter/issue.php",
                            type:"POST",
                            data:"request=" + value,
                            beforeSend:function(){
                                $(".container-fluid").html("<span>working...</span>");
                            },
                            success:function(data){
                                $(".container-fluid").html(data);
                            }
                        
                        });
                    });
                });
            </script>
                <script>
                    $(document).ready(function(){
                        $("#myInput").on("keyup",function(){
                            var value = $(this).val().toLowerCase();
                            $("#myTable tr").filter(function(){
                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                            });
                        });
                    });
                </script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
            <script src="js/delete.js"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
            <script src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script>
            <script src="js/filterdate.js"></script>


</body>
</html>