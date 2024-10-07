<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin_login</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap-icons.css">

    <style type="text/css" media="all">

        *{
            margin:0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Century Gothic";
        }

    
    
    </style>

</head>
<body>
<!-- header section -->
<section class="text-center text-light p-1" style="background:rgb(63, 5, 5);">
<div class="container p-0">
<div class="d-sm-flex justify-content-between align-items-center p-0">
<img src="Images/aifpu.jpg" style="width:80px" class="" alt="">
<h2 class="ms-auto"><b>AKANU IBIAM FEDERAL POLYTECHNIC UNWANA </b><span class="fw-normal"> (AIFPU)</span></h2>

</div>
</div>
</section>
<!-- body section for login -->
<section>
<section class="p-5 px-5 text-center shadow-1-strong" 
 style="background-image:linear-gradient(rgba(0,0,0,0.8),rgba(0,0,0,0.8)),
  url('Images/about.jpg'); background-size: cover;
    background-repeat: no-repeat;height: 77vh; background-attachment: fixed">

    <div class="container">
    <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">

    <?php 
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        
        require "connection.php";
    
    //something was posted
    $admin_id = strtoupper($_POST['Admin_Id']);
    $password = $_POST['password'];

    // To protect MYSQL injection
    $admin_id = stripslashes($admin_id);
    $password = stripslashes($password);
    $admin_id = mysqli_real_escape_string($conn, $admin_id);
    $password = mysqli_real_escape_string($conn, $password);

    if(empty($password) || empty($admin_id))
    {
        echo "<center>" . "<div class='alert p-3 alert-danger'
         style='background:transparent;
         border:2px solid red; color:red;padding:7px'>" . 
        "All input fields are required." . "</div>" . "</center>";

    }else{

        $sql = "SELECT * FROM admin WHERE Admin_Id = ? AND password = ?";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){

            echo "<center>" . "<div class='alert alert-danger' style='color:red;
             background: transparent; border: 2px solid red'>"
             . "Unable to perform request" . "</div>" . "</center>";
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "ss", $admin_id, $password);

            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)){

            if($admin_id === strtoupper($row['Admin_Id']) || $admin_id === ucwords($row['Admin_Id'])
             && $password === $row['password']){
             session_start();
             $_SESSION['sessionAdminId'] = $row['id'];
             $_SESSION['sessionAdmin'] = $row['Admin_Id'];
             $_SESSION['sessionMessage'] = "<div class='alert alert-success text-center p-0 fw-semi-bold'>
             Login successful!
             </div>";
                   
             header("location: Admin_dashboard.php");
             die;


                }
        
        }else{

            echo "<center>" . "<div class='alert alert-danger' style='color:red;
            background: transparent; border: 2px solid red;padding:7px'>"
            . "Unknown ID or incorrect password" . "</div>" . "</center>"; 
        }
    }
}
    }


    ?>
    <form action="Admin_login.php" method="post" class="bg-dark p-5">
    
    <div class="form-group">

     <input type="text" class="form-check form-control form-control-lg"
     placeholder="Enter ID number" name="Admin_Id" autocomplete> 
     <br>
     <br>
     <input type="password" class="form-check form-control form-control-lg"
     placeholder="Enter password" name="password" id="password"> 
     <br>
    <input type="checkbox" onclick="showPass()" 
    class="p-3 ms-4"> <span class="text-light">Show password</span>
    <br>
    <script type="text/javascript">
    function showPass(){
        var x = document.getElementById("password");
        if(x.type == "password"){
            x.type = "text";
        }else{
            x.type = "password";
        }
    }
    </script>
     <br>
     <input type="submit" class="btn btn-primary w-75 p-3" value="PROCEED" name="submit" id="submit">
    
    </div>
    
    </form>
    
    </div>
    <div class="col-md-3"></div>
    </div>
    </div>
    <div>
</section>
</section>
<!-- footer section -->
<section> 
<footer class="text-center text-light p-4" style="background:rgb(63, 5, 5);">
<p class="">&copy; 2022 Akanu Ibiam Federal Polytechnic</p>
</footer>
</section>
</body>
</html> 