<?php
 
 session_start();
 include "database/db_conn.php";

 
 if(isset($_POST['edit'])) {
     $id = $_SESSION['id'];
     $username = $_POST['username'];
     $fullname = $_POST['fullname'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     $user_type = $_POST['user_type'];
    
 
     $select= "select * from account where id='$id'";
     $sql = mysqli_query($conn,$select);
     $row = mysqli_fetch_assoc($sql);
     $res= $row['id'];
     if($res === $id)
     {
    

     $sqli = "UPDATE `account` SET `username`='$username',`fullname`='$fullname',`email`='$email',`password`='$password',`user_type`='$user_type',
     WHERE id=$id";
 
     $result = mysqli_query($conn, $sqli);
    if($result)
       { 
           /*Successful*/
           header('location:user-profile.php');
       }
       else
       {
           /*sorry your profile is not update*/
           header('location:user-changepassword.php');
       }
    }
    else
    {
        /*sorry your id is not match*/
        header('location:user-changepassword.php');
    }
 }
?>