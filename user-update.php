<?php
        if(isset($_POST['update-password']))
        {
                        $password1 = $_POST['password1'];
                        $password2 = $_POST['password2'];
                        $email = $_POST['email'];
        
                        if($password1 != $password2)
                        {
                            echo "password do not match";
                        }
                        $db = mysqli_connect("localhost","root","","helpdesk");
                        $password = md5('$password1');
                        $query =  "UPDATE account SET password='$password' where email='$email'";
                    $result1 = mysqli_query($db, $query);
                            if ($result1 === FALSE) 
                        {
                        die(mysqli_error($connect));
                       
                       }
                                else
                                {
                                        echo "password update successful";
                                        header("location: login.php");
                                }
        }
        
        ?>
        