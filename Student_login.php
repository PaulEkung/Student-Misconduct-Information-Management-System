<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student_login</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap-icons.css">
    <style type="text/css" media="all">
    input[type="password"]:placeholder-shown{
        border:2px solid red !important;
    }
   
        *{
            margin:0;
            padding:0;
            box-sizing: border-box;
            font-family: "Century Gothic";
        }
        
    </style>
</head>
<body>
<!-- header section -->
<section class="p-1 text-center text-light" style="background:rgb(63, 5, 5);">
<div class="container p-0">
<div class="d-flex justify-content-between align-items-center">
<img src="Images/aifpu.jpg" style="width:80px;height:80px" class="w-15 mt-1" alt="">
<h3 class="my-4"><b>AKANU IBIAM FEDERAL POLYTECHNIC UNWANA (AIFPU)</b></h3>

</div>
</div>
</section>
<!-- body section -->

<section class="p-0 px-5  text-center shadow-1-strong" 
 style="background-image:linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.7)),
  url('Images/bgl.jpg'); background-size: cover;
    background-repeat: no-repeat;height: 78vh; background-attachment: fixed">

    <div class="container">
    <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
<br>
    <form action="Student_login.php" method="post" class="p-5 mt-1 bg-dark">

    <?php 
    session_start();
    
    include 'connection.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        // for case insensitivity

        $reg_number = $_POST["regNumber"];
        $password  = $_POST["password"];    
        
        // To protect SQL injection
        $reg_number = stripslashes($reg_number);
        $reg_number = mysqli_real_escape_string($conn, $reg_number);
        $password = stripslashes($password);
        $password = mysqli_real_escape_string($conn, $password);


        if(empty($reg_number) || empty($password)) {
        echo "<center>" . "<div class='alert alert-danger'
        style='background:transparent;border:2px solid red; color:red;padding:10px'>" . 
        "Please fill in your registration number and password." . "</div>" . "</center>";

        }else{
            
            $query = "SELECT * FROM student WHERE regNumber = '$reg_number' AND password = '$password' limit 1";
            $result = mysqli_query($conn, $query);
            if($result){
            if($result && mysqli_num_rows($result) > 0){

                    $row = mysqli_fetch_assoc($result);

                    if(strtoupper($row['regNumber']) === $reg_number || strtolower($row['regNumber']) === $reg_number
                      && $row['password'] === $password){
                          
                    $_SESSION['sessionStudentId'] = $row['id'];
                    $_SESSION['sessionStudentName'] = $row['studentName'];
                    $_SESSION['sessionStudentDept'] = $row['department'];
                    $_SESSION['sessionStudentReg'] = $row['regNumber'];
                    $_SESSION['successful'] = "<div class='alert alert-success text-center p-0 fw-semi-bold'>
                    Login successful!
                    </div>";
                   
                    header("Location: Student_profile.php");
                     die;
                    }else{

                    }
                    echo "<center>" . "<div class='alert alert-danger'
                    style='background:transparent;border:2px solid red; color:red;padding:10px'>" . 
                    "Unknown Registration Number Or Incorrect Password." . "</div>" . "</center>";  
                }else{
                    echo "<center>" . "<div class='alert alert-danger'
                    style='background:transparent;border:2px solid red; color:red;padding:10px'>" . 
                    "Unknown Registration Number Or Incorrect Password." . "</div>" . "</center>";  
                }
            }
        }
    }

    ?>
    <br>
 
    <div class="form-group">
    <input type="text " name="regNumber" 
    class="form-control form-control-lg border-light border-2" placeholder="Registration Number">
    <br>
    <br>
    <input type="password" name="password" 
    class="form-control form-control-lg border-light border-2" placeholder="Password">
    <br>
    <br>
    <input type="submit" value="PROCEED" name="login" class="btn btn w-75 text-light" style="background:rgb(63, 5, 5)">
    
    </div>
    </div>
    </form>
    <div class="col-md-3"></div>
    </div>
    <br>
    <a href="index.php" class="offset-0 p-3 text-light text-decoration-none">Back to home</a>
    
    </section>
<!-- footer section -->
    <section> 
<footer class="text-center text-light p-4" style="background:rgb(63, 5, 5);">
<p class="">Copyright &copy; 2022 Alrights reserved</p>
</footer>
</section>
</body>
</html>