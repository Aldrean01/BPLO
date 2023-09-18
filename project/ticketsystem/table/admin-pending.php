<?php
	require 'database/db_conn.php';
    $pending = 'Pending';
	if(ISSET($_POST['search'])){
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));
		$query=mysqli_query($conn, "SELECT * FROM ticketing where `status`='$pending' && date(`sdate`) BETWEEN '$date1' AND '$date2'") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($row=mysqli_fetch_array($query)){
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
                        <th>
                            <a class="btn btn-primary" href="admin-ticket-data.php?id=<?php echo $row['id']?>" class = "text-light">Open</a>
                             <a class="btn btn-danger" href="admin-delete.php?id=<?php echo $row['id']?>" onclick="return confirm('Are you sure to delete?')">Delete</a>                         
                        </th>
                    
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
        $pending = 'Pending';
		$query=mysqli_query($conn, "SELECT * FROM ticketing where `status`='$pending'") or die(mysqli_error());
		while ($row = mysqli_fetch_assoc($query)){
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
                        <th>
                            <a class="btn btn-primary" href="admin-ticket-data.php?id=<?php echo $row['id']?>" class = "text-light">Open</a>
                            <a class="btn btn-danger" href="admin-delete.php?id=<?php echo $row['id']?>" onclick="return confirm('Are you sure to delete?')">Delete</a>                         
                        </th>
                    
                        </tr>
<?php
		}
	}
?>