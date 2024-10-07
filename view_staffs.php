<?php 
session_start();
include 'connection.php'
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View_staffs</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap-icons.css">

    </head>
    <body>
    <nav class="navbar navbar-expand-md bg-dark p-3 text-light">
    <div class="navbar-brand">
    <?php
    if (isset($_SESSION['sessionId'])) {
    echo "&nbsp; <span class='bg-success text-center p-2 fw-bold text-light'>" .
    "<script type='text/javascript'>document.write('Admin Panel')</script> " . "</span>" .
    "&nbsp;&nbsp;\t" . $_SESSION['sessionAdmin'];
    } else {
    echo "You are logged in!";
    }

    ?>
    <a href="Admin_Dashboard.php" class="close btn btn-danger offset-1">Back</a>

    </div>
    </nav>

    <?php 
    $sql = "SELECT * FROM staffs";
    $result = mysqli_query($conn, $sql);
    if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $name = $row['name'];
    $department = $row['department'];
    $created = $row['date'];
    $image = $row['Image'];

    echo "<table class='w-100 text-center table-active table'>" .
    "<p class='lead bg-light text-dark fw-bold p-2 text-capitalize'>  
    created:  $created 
        </p>" .
    "<thead>" .

    "<th class='bg-secondary p-3 text-light' style='border: 4px solid white'>Name of HOD</th>" .
    "<th class='bg-secondary p-3 text-light' style='border: 4px solid white'>Department</th>" .
    "<th class='bg-secondary p-3 text-light' style='border: 4px solid white'>Image</th>" .
    "<th class='bg-dark p-3 text-warning bg-gradient' style='border: 4px solid white; width:35vw'>Actions</th>" .
    "</thead>" .
    "<tbody>" .
    "<tr>" .
    "<td class='bg-light p-3' style='border: 4px solid white '>" .
    "<br>".
    "<br>".
    "<b>" . $name . "</b>" .
    "</td>" .
    "<td class='bg-light p-3' style='border: 4px solid white'>" .
    "<br>".
    "<br>".
    "<b>" . $department . "</b>" .
    "</td>" .
    "<td class='bg-light p-3' style='border: 4px solid white'>" .
    "<b>" . "<span><img src='./uploads/$image' class='offset-1 mt-4' style='width:100px; border-radius:3px'/></span>" . "</b>" .
    "</td>" .
    "<td class='bg-light p-3' style='border: 4px solid white'>" .
    "<form action=\"Admin_updateStaffs.php\" method=\"post\">".
    "<input type=\"hidden\" name=\"id\" value='".$row['id']."'>".
    "<br>".
    "<br>".
    "<input type=\"submit\" value=\"Update\" name=\"submit\"
    class='btn btn-warning w-25' style=\"margin-top:-38px;\">" .
    "</form>".
    "</td>" .
    "</tr>" .
    "</table>";
  }
    }

    ?> 

     <script src="bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js"></script>  
     <script src="bootstrap-5.1.3/dist/js/bootstrap.min.js"></script>  
    </body>
    </html>