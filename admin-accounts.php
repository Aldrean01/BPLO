<!DOCTYPE html>
<?php
	session_start();
	if(!ISSET($_SESSION['id'])){
		header('location:login.php');
	}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/stylesheet.css"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <title>Maintanance Tab</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup",function(){
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function(){
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

</head>
<body>
<header class="header">
		<h1 class="logo">
            <a href="admin-index.php"><i class="fa fa-ticket" style="font-size25px;color:red"></i> Ticketing Tab</a>
        </h1>
        <ul class="main-nav">
          <li><a href="admin-index.php">Home</a></li>
          <li><a href="admin-profile.php">Profile</a></li>
          <li><a href="admin-accounts.php">accounts</a></li>
          <li><a href="admin-status.php">tickets</a></li>
          <li><a href="logout.php" class="btn fa fa-sign-out"></a></li>
        </ul>
    
</header> 

     
    <div class="list">
        <div class="form m-3">
        <a type="button " href="add_acc.php" class="btn btn-success" style="float: left" data-toggle="modal" onclick="openModal()">Add Account</a>  
        <div class="col mb-2 " style="float: right;">
        <label>From</label>
            <input 
                        type="date" 
                        id="min-date"
                        class="date-range-filter"
                        placeholder="From: yyyy-mm-dd">
            <label>to</label>
            <input 
                        type="date" 
                        id="max-date" 
                        class="date-range-filter"
                        placeholder="To: yyyy-mm-dd">
        </div> 
        </div>  
    <div class="form m-3">
                <?php
                if(isset($_GET['msgs'])){
                    $msgs = $_GET['msgs'];
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    '.$msgs.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                }
                ?>
                        <head>
                            <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
                            <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
                        </head>
                <table class="table text-center" id="myTable">
                    <thead class="table-#37474F" style="color:whitesmoke">
                        <tr>
                        <th scope="col">No.</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Type Of User</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php
                        include "database/db_conn.php";
                        $sql = 'SELECT * FROM account';
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            ?>
                                <tr>
                                <th><?php echo $row['id'] ?></th>
                                <th><?php echo $row['username'] ?></th>
                                <th><?php echo $row['fullname'] ?></th>
                                <th><?php echo $row['email'] ?></th>
                                <th><?php echo $row['password'] ?></th>
                                <th><?php echo $row['user_type'] ?></th>
                                <th><?php echo $row['create_datetime'] ?></th>
                                <th>
                                    <a class="btn btn-success" href="edit_acc.php?id=<?php echo $row['id']?>" class = "text-light">Update</a>
                                    <a class="btn btn-danger" href="admin-delete.php?id=<?php echo $row['id']?>" onclick="return confirm('Are you sure to delete?')">Delete</a>
                                </th>
                                        </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    </div>




</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script>


</body>