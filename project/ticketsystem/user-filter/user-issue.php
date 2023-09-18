
<?php
	session_start();
	if(!ISSET($_SESSION['username'])){
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
    $id = $_SESSION['username'];
    $request = $_POST['request'];
    $query = "SELECT * FROM `ticketing` WHERE `username`='$id' && `issue`='$request'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
   
?>
<br>
<table class = "table">
    <?php
    if ($count){
    ?>
    <thead class="title" style="color:whitesmoke">
    <tr>
                <th scope="col">No.</th>
                <th scope="col">User Name</th>
                <th scope="col">Request Date</th>
                <th scope="col">Issues</th>
                <th scope="col">Comments</th>
                <th scope="col">Status</th>
                <th scope="col">Date Created</th>
                <th scope="col">Action</th>

                </tr
    <?php
    }else{
                    echo "sorry! no record found";
    }
                ?>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)){
        ?>                              
            <tr>
            <th class="text-center"><?php echo $row['id'] ?></th>
            <th class="text-center"><?php echo $row['username'] ?></th>
            <th class="text-center"><?php echo $row['issue'] ?></th>
            <th><?php echo $row['comment'] ?></th>
            <th onsubmit="openModal()" id="myForm" class="text-center">  
            <?php 
            if($row['status'] == "Pending"){
                echo '<button type="submit" class="btn btn-warning">'.$row['status'].'</button>';
            }else if($row['status'] == "In progress"){
                echo '<button class="btn btn-info">'.$row['status'].'</button>';
            }else if($row['status'] == "Cancelled"){
                echo '<button class="btn btn-danger">'.$row['status'].'</button>';
            }else if($row['status'] == "Done"){
                echo '<button class="btn btn-success">'.$row['status'].'</button>';
            }
            ?>
            </th>
            <th class="text-center"><?php echo $row['sdate'] ?></th>
            <th class="text-center"><?php echo $row['create_datetime'] ?></th>
            <td>
                <button class="btn btn-primary"><a href="user-view.php?id=<?php echo $row['id']?>" class = "text-light">View</a></button>
            </td>
            </tr>
                    <?php
                }
         ?>
    </tbody>

</table>
<?php
}
?>