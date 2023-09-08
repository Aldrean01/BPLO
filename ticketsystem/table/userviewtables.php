
<?php
	require 'database/db_conn.php';
    $id = $_SESSION['username'];
	if(ISSET($_POST['search'])){
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));
		$query=mysqli_query($conn, "SELECT * FROM ticketing WHERE username ='$id' && date(`sdate`) BETWEEN '$date1' AND '$date2'") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($row=mysqli_fetch_array($query)){
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
        <th class="text-center"><?php echo $row['adminfix'] ?></th>
        <th class="text-center"><?php echo $row['create_datetime'] ?></th>
        <td>
            <a class="btn btn-primary" href="user-view.php?id=<?php echo $row['id']?>" class = "text-light">View</a>
        </td>
        </tr>
            <?php
                        }
                    }else{
                        echo'
                        <tr>
                            <td colspan = "4"><center>Record Not Found</center></td>
                        </tr>';
                    }
                }else{
                    $id = $_SESSION['username'];
                                        $sql = "SELECT * FROM ticketing where username ='$id'";
                                        $r = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($r))
                                        {
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
        <th class="text-center"><?php echo $row['adminfix'] ?></th>
        <th class="text-center"><?php echo $row['create_datetime'] ?></th>
        <td>
            <a class="btn btn-primary text-light" href="user-view.php?id=<?php echo $row['id']?>">View</a>
        </td>
        </tr>
<?php
		}
	}
?>