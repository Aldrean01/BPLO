<?php
include "database/db_conn.php";
$id = $_GET['id'];
$sql = "DELETE FROM `account` WHERE id = $id";
$result = mysqli_query($conn, $sql);
if($result) {
    header ("Location:admin-accounts.php?msg=record deleted successfully");
}
else {
    echo "failed: " .  mysqli_error($conn);
}
?>  