<!DOCTYPE html>
<?php
	session_start();
	if(!ISSET($_SESSION['username'])){
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
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <title>Maintanance Tab</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup",function(){
                var value = $(this).val().toLowerCase();
                $("#my-table tr").filter(function(){
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</head>
<body>
    <header class="header">
		<h1 class="logo">
            <a href="user_index.php"><i class="fa fa-ticket" style="font-size25px;color:red"></i> Ticketing Tab</a>
        </h1>
        <ul class="main-nav">
          <li><a href="user_index.php">Home</a></li>
          <li><a href="user_profile.php">profile</a></li>
          <li><a href="user_myticket.php">my ticket</a></li>
          <li><a href="logout.php" class="btn fa fa-sign-out"></a></li>
        </ul>
    
        

    </header> 
    <div class="list">
        <div class="viewport" id="viewport">
                <!-- Sidebar -->
                <div  class="sidebar" id="sidebar">
                <header>
                    <a href="">HOME</a>
                    </header>
                    <ul class="nav">
                    <li>
                        <a type="button " href="addnewuser.php" class="btn btn-success mb-3" data-toggle="modal" onclick="openModal()">Add Tickets</a>
                    </li>
                    <div class="filters" id="filters">
                    <div>
                        <label class="text-white">Status</label>
                    </div>
                    <select class="listed" name="statusval" id="statusval">
                        <option value="" disabled="" selected="">Select Status</option>
                        <option value="Pending">Pending</option>
                        <option value="In progress">In Progress</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="Done">Done</option>
                    </select>
                    <div>
                        <label class="text-white">Issues</label>
                    </div>
                    <select class="listed mb-2" name="issue" id="issue">
                        <option value="" disabled="" selected="">Select Issue</option>
                        <option value="Internet">Network</option>
                        <option value="Hardware">Hardware</option>
                        <option value="Software">Software</option>
                    </select>
                    <form class="form-inline" style="background-color:#37474F;" method="POST" action="">
                        <label class="text-white">Date:</label>
                        <input type="date" class="form-control" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
                        <div>
                            <label class="text-white">To</label>
                        </div>
                        <input type="date" class="form-control" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
                        <button class="btn btn-primary" name="search"><span class="glyphicon glyphicon-search"></span></button> 
                        <div class="col mt-3">
                        <a class="btn btn-success" onclick="history.go(-1);">Back </a>
                        </div>
                    </form>

                    </div>     
        </div>
                <!-- Content -->
                <div id="content">
                     
                    <div class="container-fluid">
                    <div class="form-group"><br>
                        <a class="btn btn-success" style="float: left;" href="user_myticket.php">My Tickets</a>
                        <input class="col mb-2"  style="float: right;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search" title="Type in a name">
                        </div>
                        <table class="table text-center" id="my-table">
                        <thead class="text-center" style="color:whitesmoke">
                        <tr>
                            <th class="text-center" scope="col">No.</th>
                            <th class="text-center" scope="col">User Name</th>
                            <th class="text-center" scope="col">Issues</th>
                            <th class="text-center" scope="col">Comments</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Date Created</th>
                            <th class="text-center" scope="col">Admin Fix</th>
                            <th class="text-center" scope="col">Request Date</th>
                            <th class="text-center" scope="col">Action</th>
                        </tr>
                        <tbody id="myTable ">
                            <?php include "table/userviewtables.php"; ?>
                        </tbody>
                        </thead>
                        </table>
                    </div>
                </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous">
    </script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#statusval").on("change",function(){
                var value = $(this).val();
            //alert(value);
            $.ajax({
                    url:"user-filter/user-fetch.php",
                    type:"POST",
                    data:"request=" + value,
                    beforeSend:function(){
                        $(".container-fluid").html("<span>working...</span>");
                    },
                    success:function(data){
                        $(".container-fluid").html(data);
                    }
                
                });
            });
        });

    </script>
    <script type="text/javascript">
                $(document).ready(function(){
                    $("#issue").on("change",function(){
                        var value = $(this).val();
                    //alert(value);
                    $.ajax({
                            url:"user-filter/user-issue.php",
                            type:"POST",
                            data:"request=" + value,
                            beforeSend:function(){
                                $(".container-fluid").html("<span>working...</span>");
                            },
                            success:function(data){
                                $(".container-fluid").html(data);
                            }
                        
                        });
                    });
                });
            </script>
            <script>
            function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
            }
            </script>
            <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
            <script src="js/delete.js"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
            <script src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script>
            <script src="js/filterdate.js"></script>
            <script src="js/modal.js"></script>

</body>
</html>