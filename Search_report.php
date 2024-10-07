<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search_report</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap-icons.css">
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark py-3 text-light">
<div class="navbar-brand">
<?php
session_start();
require "connection.php";

if(isset($_SESSION['sessionStaffId'])){
 echo $_SESSION['sessionName'] . 
 "&nbsp;<div class='bg-success text-center fw-bold btn text-light'>" .
 "<script type='text/javascript'>document.write('HOD')</script> " . "</div>" .
 "&nbsp;&nbsp;\t" . $_SESSION['sessionDept'];
}else{
    echo "You are logged in!";
}

?>
</div>
<span class="bg-dark text-warning offset-2 p-0">
        <?php 
        if(isset($_POST['submit'])) {

            $reg = strtolower($_POST["regNumber"]);
            $reg = mysqli_real_escape_string($conn, $reg);
         
        $sql = "SELECT COUNT(regNumber) FROM report WHERE regNumber = '$reg'";
        $result = mysqli_query($conn, $sql);
        if($counter = mysqli_fetch_array($result)) {
    
            if($counter[0] == 1){

                echo " $counter[0] Result Found";

            }elseif($counter[0] > 1){

                echo " $counter[0] Results Found";

            }else {
            echo " No Result Found ";
        }
       }
        }
    
        ?>

        </span>
<div class="collapse navbar-collapse" id="navmenu">
<ul class="navbar-nav offset-10">

<li class="nav-item">
    <a href="Staffs_Dashboard.php" class="nav-link text-light btn btn-danger shadow">Back to home</a>
</li>

</ul>
</div>
</nav>
    
<br>
<?php

if(isset($_POST['submit'])) {

   $reg = strtolower($_POST["regNumber"]);
   $reg = mysqli_real_escape_string($conn, $reg);

    if(empty($reg)) {

        $_message = "<script type=\"text/javascript\"> window.alert(\"Please fill the required input field\")</script>";
        echo $_message;

    }else{

        $sql = "SELECT img.Image, re.* FROM `student` img,`report` re WHERE img.regNumber = re.regNumber AND re.regNumber = '$reg'";
        $result = mysqli_query($conn, $sql);
        if($result && mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)){

            $id = $row['id'];
            $name = $row['studentName'];
            $department = $row['department'];
            $regNumber = $row['regNumber'];
            $level = $row['level'];
            $mobile = $row['mobile'];
            $email = $row['email'];
            $misType = $row['misType'];
            $description = $row['description'];
            $date = $row['time'];
            $created = $row['date'];
            $punishment = $row['punishment'];
            $image = $row['Image'];
            $sample = $row['report_img'];
            
            echo "<table class='text-center table-bordered table-active table'>" . //'table-striped' class can also be added.
            "<p class='lead bg-light text-dark p-2'>  
            Created:  $created <img src='uploads/$image' class='offset-1 p-1 rounded-circl' style='width:100px; border-radius:3px'>
            <span class='offset-3 fw-normal'>Sample Evidence---><img src='uploads/$sample' class=' p-1' style='width:100px;
            border-radius:3px'></span>
         
            &nbsp;&nbsp; 
            <span class='btn btn-warning offset-1'>
            <form action='staff_update_students.php' method='post'>
            <input type='hidden' name='id' value='$id'/>
            <button type='submit' class='text-black btn btn-warning btn-sm' name='update'>Update</button> 
            </form>
            </span>" .
            "</span>" .
            "<p >" .
            "<p class=\"alert alert-primary p-3 text-center fw-bold font-monospace\">Report posted From $department Department</p>".
    
            "</p>" .
    
             "<thead>" .
            
            "<th class='bg-secondary p-2 text-light' style='border: 4px solid white'>Name of student</th>" .
            "<th class='bg-secondary p-2 text-light' style='border: 4px solid white'>Department</th>" .
            "<th class='bg-secondary p-2 text-light' style='border: 4px solid white'>Registration Number</th>" .
            "<th class='bg-secondary p-2 text-light' style='border: 4px solid white'>Level</th>" .
            "<th class='bg-dark p-3 text-warning' style='border: 4px solid white'>Phone number/Email</th>" .
            "</thead>" .
            "<tbody>" .
            "<tr>" .
            "<td class='bg-light p-3' style='border: 4px solid white;width:15vw '>" .
            "" . $name . "".
            "</td>" .
            "<td class='bg-light p-3' style='border: 4px solid white'>" .
            "" . $department . "" .
            "</td>" .
            "<td class='bg-light p-3' style='border: 4px solid white'>" .
            "" . $regNumber . "" .
            "</td>" .
            "<td class='bg-light p-3' style='border: 4px solid white'>" .
            "" . $level . "" .
            "</td>" .
            "<td class='bg-light p-3' style='border: 4px solid white'>"  .
            "" . $mobile . "<br>" . $email . "" .
            "</td>" .
            "</tr>" .
            "</tbody>" .
            "<thead>" .
            "<tbody>" .
            "<th class='bg-secondary p-2 text-light' style='border: 4px solid white;width:15px'>Misconduct Case</th>" .
            "<th class='bg-secondary p-3 text-light' style='border: 4px solid white'>Description</th>" .
            "<th class='bg-secondary p-2 text-light' style='border: 4px solid white'>Date of Misconduct</th>" .
            "<th class='bg-secondary p-3 text-light' style='border: 4px solid white'>Punishment</th>" .
            "<th class='bg-dark p-3 text-warning' style='border: 4px solid white'>Action</th>" .
            "</thead>" .
            "<tr>" .
            "<td class='bg-light p-4' style='border: 4px solid white'>" .
            "" . $misType . "" .
            "</td>" .
            "<td class='bg-light p-3 w-25' style='border: 4px solid white'>" .
             "" . $description . "" .
            "</td>" .
            "<td class='bg-light p-5' style='border: 4px solid white'>" .
            "" . $date . "".
            "</td>" .
            "<td class='bg-light p-5' style='border: 4px solid white'>" .
             "<b class='text-danger'>" . $punishment . "</b>" .
            "</td>" .
            "<td class='bg-light p-5' style='border: 4px solid white'>" .
            "No action required" .
            "</td>" .
            "</tr>" .
            "</tbody>" .
            
             "</table>";
            }
          }else{

            echo "<span class='offset-3 fw-bold'>No result was found for the registration number '$reg' </span>";
         }

     }

   }

        ?>
        
        </body>
        </html>