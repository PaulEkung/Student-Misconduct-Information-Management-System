<?php 
session_start();

include "connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="bootstrap3/fonts/bootstrap.mcss">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap3/fonts/glyphicons-halflings-regular.svg">
    <style type="text/css" media="all">
        *{
            margin:0;
            padding:0;
            box-sizing: border-box;
            font-family: "Century Gothic";
        }
        .background{
            background-image:linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.8)),url('Images/about.jpg');
             background-size: cover;
            background-repeat: no-repeat;height: 76vh; 
            background-attachment: fixed;
        }
    </style>
   
</head>
<body>
<!-- div.bg-body -->

<!-- Navbar section -->

<nav class=" text-center text-light p-4" style="background:rgb(63, 5, 5);">
<div class="container p-0" style="margin-left:-10px">
<div class="d-flex justify-content-center align-items-center p-1">
<img src="Images/aifpu.jpg" width="70px" class="offset-0" alt="">
 <h2 class="ms-auto"><b> AKANU IBIAM FEDERAL POLYTECHNIC UNWANA </b><br>
 <span class="fw-normal fs-6">Skill For Technolgical Freedom</span></h2>

</div>
</div>
</nav>

<!-- body section -->
<section class="p-5 background text-center shadow-1-strong">
    <h1 class="mt-5 text-warning bg-gradient-2 fs-1 lead fw-bold p-2">

   <b>Administrative Student's Misconduct Management System</b>

    </h1>

   <p class="text-light lead">Confidence Comes From Discipline And Training</p>
    <a href="#role" class="mt-5 p-3 w-25 text-light fw-semibold btn btn-outline-success" data-bs-toggle="modal">CONTINUE </a>

</section>

<div class="container">
<div class="row">
<div class="modal fade" role="dialog" id="about">
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-body">
<p class="brand">

<br>
   <h4>ABOUT SYSTEM</h4>
<p>
This is an opened source web-based student misconduct management system where the school administration
can manage disciplinary cases of the students in a computerized way.
The system gives access to three different category of users, namely the Admin, Staff and Student,
where only the Admin and the Staff are entitled to handle, manipulate and make changes to the system.
The major objective of the system is to improve the academic performance of the institution in the area of discipline.
</p>



</div>
<button class="btn btn-danger lead w-25 offset-4"
 data-bs-dismiss="modal" style="border-radius: 0">EXIT</button>
 <br>
</div>
<div class="col-md-4"></div>
</div>
</div>
</div>
</div>  
</div>
</div>
</div>
</div>


<div class="container">
<div class="row">
<div class="modal fade" id="role">
<div class="container">
<div class="row">
<div class="col-sm-4"></div>
<div class="col-sm-5">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header bg-black text-warning"><span class="text-center">Login Role</span>
<img src="images/person icon.jpg" style="width:40px" class="rounded-circle offset-1" alt="...">
<span class="close fs-3 btn btn-close btn text-light" data-bs-dismiss="modal">&times;</span>
 </div>
<div class="modal-body bg-light" style="height:28rem">
<br>
<br>
 
<a href="Student_login.php" class="text-decoration-none text-light offset-0 btn btn-danger btn-md">Student Login</a>
 &nbsp;&nbsp;
 <a href="Admin_login.php" class="text-decoration-none offset-0 text-light btn btn-dark btn-md">Admin Login</a>
&nbsp;&nbsp;
<a href="Staff_login.php" class="text-decoration-none offset-0 text-light btn btn-success btn-md">Staff Login</a>
<br>
<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;
<img src="images/engaged logo.png" alt="..." style="width:100px" class="offset-4">
<br>
<br>
<br>
&nbsp;&nbsp;
<a href="quick_report.php" class="lead btn btn-secondary offset-4">Quick Report</a>
</div>
</div>
</div>
</div>
<div class="col-sm-3"></div>
</div>
</div>
</div>
</div>
</div>

<!-- footer section -->
<section>
<footer class="text-center text-light p-2 mt-0 fixed-bottom" style="background:rgb(63, 5, 5);">
<a href="#about" class="text-light btn btn-dark
 position-fixed bottom-1 end-0 p-2 fw-semibold mb-4" data-bs-toggle="modal" style="">About system and developer</a>
<p clas=""> <span class="fs-3">&copy;</span>  2022 Akanu Ibiam Federal Polytechnic Unwana</p>
</footer>
</section>

    
<script src="bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="bootstrap-5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>