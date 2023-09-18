<?php
	session_start();
	if(!ISSET($_SESSION['id'])){
		header('location:login.php');
	}
?>
<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "helpdesk";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn){
    die("connection failed ". mysqli_connect_error());
}
if(isset($_POST['request'])){
    $request = $_POST['request'];
    $query = "SELECT * FROM `ticketing` WHERE `status`='$request'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
   
?>
<table class="table table-hover text-center m-3" id="my-table">
    <?php
    if ($count){
    ?>
    <thead class="title" style="color:whitesmoke">
    <tr>
                            <th class="text-center" scope="col">No.</th>
                            <th class="text-center" scope="col">User Name</th>
                            <th class="text-center" scope="col">Issues</th>
                            <th class="text-center" scope="col">Comments</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Request Date</th>
                            <th class="text-center" scope="col">Admin Fix</th>
                            <th class="text-center" scope="col">Date Created</th>
                </tr>
    </thead>
    <tbody>
    <?php
    }else{
        echo "sorry! no record found";
    
    ?>
        <?php
        }while ($row = mysqli_fetch_assoc($result)){
        ?>
        
        <tr scope="row">
        <th class="text-center"><?php echo $row['id'] ?></th>
        <th class="text-center"><?php echo $row['username'] ?></th>
        <th class="text-center"><?php echo $row['issue'] ?></th>
        <th><?php echo $row['comment'] ?></th>
        <th class="text-center">  
        <?php 
        if($row['status'] == "Pending"){
            echo '<button class="btn btn-warning">'.$row['status'].'</button>';
        }else if($row['status'] == "In progress"){
            echo '<button class="btn btn-info">'.$row['status'].'</button>';
        }else if($row['status'] == "Cancelled"){
            echo '<button class="btn btn-danger">'.$row['status'].'</button>';
        }else if($row['status'] == "Done"){
            echo '<button class="btn btn-success">'.$row['status'].'</button>';
        }
        ?>
        </th>
        <th class="text-center"><?php echo $row['create_datetime'] ?></th>
        <th class="text-center"><?php echo $row['adminfix'] ?></th>
        <th class="text-center"><?php echo $row['sdate'] ?></th>
        </tr>
        <?php
    }
         ?>
    </tbody>

</table>
<?php
}
?>