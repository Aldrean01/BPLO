<?php
        
        // retrieve token
        if (isset($_GET["token"]) && preg_match('/^[0-9A-F]{40}$/i', $_GET["token"])) {
            $token = $_GET["token"];
        }
        else {
            throw new Exception("Valid token not provided.");
                header('location: forgetpassword.php');
        
        }
        
        $db = mysqli_connect('localhost', 'username', '', 'helpdesk');
        $query = "SELECT * FROM account WHERE token='$token' LIMIT 1";
        
        $result =  mysqli_query($db, $query);
        if ($result === FALSE) 
        {
           die(mysqli_error($connect));
        }
        $user = mysqli_fetch_assoc($result);
        if($user)
        {
           
            if ($user['token'] === $token) 
            {
                    // delete token so it can't be used again
                    $query1 = "DELETE FROM forgot-password-request WHERE token='$token' LIMIT 1";
                    $result1 =  mysqli_query($db, $query1);
                    if($result1 === TRUE){
                        // do one-time action here, like activating a user account
                        //  or delete the record from forgot-password-request and creating a new record in registered_users.
                        echo "Password Reset";
                    }
                    else
                      exit;
            }
        }
        
        ?>
        <html>
            <head>
                <link href="css/style.css" type="text/css" rel="stylesheet" />
            </head>
            <body>
                  <div class="container">
        
                        <form method="post" id="mobile-number-verification" action="update-password.php">
                            <div class="mobile-heading"> Reset your password </div>
                          <div class="mobile-row">
                            <input type="hidden" name="email" value="<?php echo $user['email']; ?>">
                            <input type="password" class="mobile-input" name="password1" placeholder="Enter your password">
                            <br><br>
                            <input type="password" class="mobile-input" name="password2" placeholder="Confirm your password">
                              <div id="message2"></div>
                          </div>
                          <div id="loading-image"><img src="/image/ajax-loader.gif" alt="ajax loader"></div>
                          <input type="submit" class="mobileSubmit" id="enter" name="update-password" value="Update Password">
                
                        </form>
                    </div>
            </body>
        </html>