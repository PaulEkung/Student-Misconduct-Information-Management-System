<?php 
session_start();
require "connection.php";
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>students</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css"> 
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg bg-dark py-3 text-light">
<div class="navbar-brand">
<?php

if(isset($_SESSION['sessionAdminId'])){
 echo "&nbsp;" . $_SESSION['sessionAdmin'] . 
 "&nbsp;<div class='bg-success text-center fw-bold btn text-light offset-5'>" ;
}else{
    echo "You are logged in!";
}

?>

<div class="collapse navbar-collapse" id="navmenu">
<li class="nav-item">
<?php 
$query = "SELECT COUNT(*) FROM `student`";
$result = mysqli_query($conn, $query);
if($result){
    $count = mysqli_fetch_array($result);
    echo "Total students -> <b>$count[0]</b>";
   }
   ?>
</li>



    <a href="Admin_dashboard.php" class="text-light btn btn-danger shadow offset-11">Back to home</a>

    </div>
</nav>

<?php  
    $sql = "SELECT * FROM `student`";
    
    $result = mysqli_query($conn, $sql);
    if($result){
       while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $image = $row["Image"];
        $name = $row["studentName"];
        $regNumber = $row["regNumber"];
        $category = $row["category"];
        if($category == ""){
         $category = "Unknown";
         
        }
        echo "
        <table class='table table-bordered table-active text-center fw-bold table-responsive'>
        <thead>
        <th class='bg-secondary p-3 text-light' style='border: 4px solid white'>Image</th> 
        <th class='bg-secondary p-3 text-light' style='border: 4px solid white'>Name</th>
        <th class='bg-secondary p-3 text-light' style='border: 4px solid white'>Registration Number</th>
        <th class='bg-secondary p-3 text-light' style='border: 4px solid white'>Category</th>
        <th class='bg-dark p-3 text-warning' style='border: 4px solid white'>Action</th> 
        <thead>
        <tbody>
        <td class='bg-secondary p-3' style='border: 4px solid white'>
        
        <span><img src='./uploads/$image' class='offset-1 p-0 rounded-circl' style='width:100px; border-radius:3px'/></span>
        </td>
        <td class='bg-light p-3' style='border: 4px solid white'>$name</td>
        <td class='bg-light p-2' style='border: 4px solid white'>
        $regNumber
        </td>
        <td class='bg-light p-2' style='border: 4px solid white'>
        $category
        </td>
        <td class='bg-light p-3' style='border: 4px solid white'>
        <a href='Admin_delete_students.php?deleteStudent=$id'   class='btn btn-danger'>Delete</a>
        </td>
        </tbody>
        
        </table>

               
        ";

      }
    }
  
  ?>




<script src="bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js"></script>  
<script src="bootstrap-5.1.3/dist/js/bootstrap.min.js"></script>   
</body>
</html>