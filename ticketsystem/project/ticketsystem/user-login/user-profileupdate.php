<!DOCTYPE html>
<html lang="en-US">
  <head>
  <title>IT SourceCode</title>
  <link rel="stylesheet" href="libs/css/bootstrap.min.css">
  <link rel="stylesheet" href="libs/style.css">
  </head>
  <?php
  include 'db.php';
  session_start();
$id=$_SESSION['id'];
$query=mysqli_query($conn ,"SELECT * FROM account where id='$id'")or die(mysqli_error());
$row=mysqli_fetch_array($query);
  ?>
  <h1>User Profile</h1>
<div class="profile-input-field">
        <h3>Please Fill-out All Fields</h3>
        <form method="post" action="#" >
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" style="width:20em;" placeholder="Enter your Username" value="<?php echo $row['full_name']; ?>" required />
          </div>
          <div class="form-group">
            <label>Fullname</label>
            <input type="text" class="form-control" name="fullname" style="width:20em;" placeholder="Enter your Fullname" required value="<?php echo $row['fullname']; ?>" />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="number" class="form-control" name="email" style="width:20em;" placeholder="Enter your Email" value="<?php echo $row['emaail']; ?>">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control" name="password" style="width:20em;" required placeholder="Enter your Password" value="<?php echo $row['password']; ?>"></textarea>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" style="width:20em; margin:0;"><br><br>
            <center>
             <a href="logout.php">Log out</a>
           </center>
          </div>
        </form>
      </div>
      </html>
      <?php
      if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

    
        $sqli = "UPDATE `account` SET `username`='$username',`fullname`='$fullname',`email`='$email',`password`='$password',`user_type`='$user_type',`create_datetime`='$create_datetime' 
        WHERE id=$id";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    ?>
                     <script type="text/javascript">
            alert("Update Successfull.");
            window.location = "index.php";
        </script>
        <?php
             }               
?>