<?php
include "database/db_conn.php";
$id = $_GET['id'];
$sql = "DELETE FROM `ticketing` WHERE id = $id";
$result = mysqli_query($conn, $sql);
if($result) {
    header ('Location: user_myticket.php?msg=record deleted successfully');
}
else {
    echo "failed: " .  mysqli_error($conn);
}
?>