<?php
    require('database/db_conn.php');
session_start();
if(isset($_POST['submit'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $select = " SELECT * FROM `account` WHERE `username` = '$username' && `password` = '$password' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_array($result);

        if(($row['user_type'] == 'admin') && ($row['username'] == $username)) {

            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['success'] = "You have logged in!";
            echo "<script>alert('Login Successfully!')</script>";
            header('location:admin-data.php');

        }elseif(($row['user_type'] == 'user') && ($row['username'] == $username)) {
            
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['success'] = "You have logged in!";
            echo "<script>alert('Login Successfully!')</script>";
            header('location:user_index.php');
        }
        
    }else{
        $error[] = 'Incorrect Username or Password!';
    }

};
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="css/style3.css"/>
    
</head>
<body>
 <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <p>Welcome to Ticketing System</p>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
};
?>
        <input type="text"  required class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" required class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <a href="forget-password.php">Forgot your password?</a>
        <p class="link"><a href="registration.php">Register Now!</a></p>
  </form>
</body>
</html>