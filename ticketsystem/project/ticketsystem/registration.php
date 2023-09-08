<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="css/style3.css"/>
</head>
<body>
<?php
    require('database/db_conn.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslas9hes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($conn, $username);
        $fullname = stripslashes($_REQUEST['fullname']);
        $fullname = mysqli_real_escape_string($conn, $fullname);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $user_type = $_POST['user_type'];
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT INTO account (username, password, fullname, email, user_type, create_datetime)
                     VALUES ('$username', '" . md5($password) . "','$fullname', '$email', '$user_type', '$create_datetime')";
        $result   = mysqli_query($conn, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress" required>
        <input type="password" class="login-input" name="password" placeholder="Password" required>
        <input type="password" class="login-input" placeholder="Confirm Password" id="confirm_password">
        <input type="text" class="login-input" name="fullname" placeholder="Full Name">
        <div class="select">
            <select type="text" class="login-input" name="user_type" aria-label=".form-select-lg example">
                <option selected>Select Role</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>   
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link">Do you have Account?<a href="login.php">Click to Login</a></p>
    </form>

<?php
    }
?>
</body>
</html>