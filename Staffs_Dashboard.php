                        <?php session_start(); ?>

                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta http-equiv="X-UA-Compatible" content="ie=edge">
                        <title>Staff_report</title>
                        <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
                        <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">
                        <link rel="stylesheet" href="bootstrap-icons/bootstrap-icons.css">
                        <!-- <link rel="stylesheet" href="bootstrap3/css/bootstrap.min.css"> -->
                        <style>
                        li{
                            padding: 8px 8px 8px 30px;
                            
                        }

                        .sidebar{
                        height: 83vh; /*Full height*/
                        width: 40vw;  /* width stays 0, can only be changed using javascript*/
                        position: fixed;   /*Stay in place*/
                        z-index: 1;   /*Keep the sidenav on top*/
                        top: 11vh;
                        left: 0;
                        background: rgba(0, 3, 32, 0.908);
                        overflow-x: hidden;    /*Disable horizontal scroll*/
                        padding-top: 90px;
                        transition: 0.3s;

                        }

                        </style>
                        </head>
                        <body class="bg-light bg-gradient">
                        <nav class="navbar navbar-expand-sm bg-dark navbar-dark py-3 text-light">
                        <div class="navbar-brand">
                        &nbsp;<span class="bi bi-person-check-fill text-light fs-2"></span> 
                        &nbsp;
                        <?php
                        require "connection.php";
                        require "login_check.php";
                        $checkConn = check_staff_Login($conn);

                        if(isset($_SESSION['sessionStaffId'])){
                            $dept = $_SESSION['sessionDept'];
                        echo $_SESSION['sessionName'] . 
                        "&nbsp;<div class='bg-success text-center fw-bold btn text-light'>" .
                        "<script type='text/javascript'>document.write('HOD')</script> " . "</div>" .
                        "&nbsp;&nbsp;\t" . $dept . ' Department';
                        }else{
                            echo "You are logged in!";
                        }

                        ?>
                        </div>
                        <div class="collapse navbar-collapse" id="navmenu">
                        <ul class="navbar-nav ms-auto">

                        <li class="nav-item">
                            <a href="#questions" class="nav-link text-light btn btn-dark"></a>
                        </li>
                        <li class="nav-item">

                            <a href="#search-result" class="nav-link btn btn-dark text-light" data-bs-toggle="modal">
                            <span class="bi bi-search text-warning"></span>  SEARCH REPORT</a>

                        </li>

                        
                        </ul>
                        </ul>
                        </div>
                        </nav>

                        <div class="container">
                        <div class="row">
                        <div class="modal fade" id="logout" role="dialog">
                        <div class="container">
                        <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                        <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header bg-dark">
                        <p class="lead font-monospace text-warning">Ready to exit?</p>
                        </div>
                        <div class="modal-body">
                        <p class="brand fw-bold text-center">Dear <?php echo ucwords($_SESSION['sessionName']) ?>, are you sure to logout?</p>
                        <br>
                        <a href="#" class="close btn btn-danger offset-3" data-bs-dismiss="modal">No</a>
                        <a href="staffs_logout.php" class="btn btn-success offset-3">Yes</a>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="col-sm-3"></div>
                        </div>
                        </div>
                        </div>
                        <br>
                        <div class="container">
                        <div class="row">
                        <div class="col-md-4">
                        <div id="sidenav" class=" sidebar w-0" style="">
                        
                         <div class="container bg-dark p-5" style="margin-top:-5rem">
                        <span class="text-warning lead fw-bold">Dashboard</span>
                        <?php 
                            $query = "SELECT * FROM `staffs` WHERE department = '".$_SESSION['sessionDept']."'";
                            $result = mysqli_query($conn, $query);
                            if($result && mysqli_num_rows($result) > 0){
                            $row = mysqli_fetch_assoc($result);
                            $image = $row['Image'];
                            echo "<span><img src='./uploads/$image' style='width:100px; border-radius:3px;border:3px solid dodgerblue' class='rounded-circle offset-3'/></span>";    

                            }
                            
                            ?>
                        <!-- <img src ='Images/person icon.jpg' style='width:40px' class='rounded-circle offset-1'/> -->
                        </div>

                            <br>
                            <ul class="text-light">
                            <li>
                            <a href="#changePass" data-bs-toggle="modal" class="text-decoration-none text-light">
                            <span class="bi bi-key-fill text-warning fs-4"></span>  Change Password</a>
                            </li>
                            <br>
                            <li>
                            <a href="#writeAdmin" data-bs-toggle="modal" class="text-decoration-none text-light">
                            <span class="bi bi-keyboard-fill fs-4 text-warning"></span>  Write Admin</a>
                            </li>
                            <br>
                            <li>
                            <a href="#viewNotification" data-bs-toggle="modal" class="text-decoration-none text-light">
                            <span class="bi bi-eye-fill text-warning fs-4"></span> Admin notifications
                            <span>
                            <?php 
                            $query = "SELECT * FROM `staffnotification` WHERE department = '".$_SESSION['sessionDept']."'";
                            $result = mysqli_query($conn, $query);
                            if($result && mysqli_num_rows($result) > 0){
                                $row = mysqli_fetch_assoc($result);

                                    $sql = "SELECT COUNT(*) FROM `staffnotification` WHERE department ='".$_SESSION['sessionDept']."'";
                                    if($count = mysqli_fetch_array(mysqli_query($conn,$sql))){
                                        

                                        echo "<span class=\"bg-success p-2 rounded-circle text-light position-absolute fw-bold\"
                                        style=\"height:2.5rem;place-items:center\">$count[0]</span>";
                                    }
                                }
                            
                            ?>
                            </span>
                            </a>
                            </li>
                            <br>
                            <li style="">
                            <a href=""  class=" text-decoration-none text-light">
                            <span class="bi bi-person-rolodex text-warning"></span>  Report-Problem </a>
                            </li>
                            <br>
                                <li style="">
                                <a href="#logout" style=""  class=" text-decoration-none text-light btn btn-danger w-25" data-bs-toggle="modal"> Log-Out</a>
                                </li><br>
                            </ul>
                            </div>
                            </div>
                            </div>
                            </div>
                            <div>
                            </div>
                            </div>

                            <div class="col-md-8"></div>
                            <!-- <div class="col-md-8"></div> -->
                        </div>
                        </div>
                        
                        
                        <a href="student_register.php"
                        class="btn btn-primary btn-lg offset-5 mt-5 p-3 lead fw-semibold text-uppercase text-center bg-gradient"> Add student
                        </a>  &nbsp;
                        <button class="btn btn-danger btn-lg  offset-0 mt-5 p-3 fw-semi-bold w-25 text-uppercase"
                        data-bs-toggle="modal" data-bs-target="#report">Add report &nbsp;
                        </button>
                        &nbsp;
                        <a href="Staff_View_Students.php"
                        class="btn btn-success btn-lg offset-0 mt-5 p-3 fw-semibold lead text-uppercase text-center">view students
                        </a>  &nbsp;

                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        
                                <div class="p-3 lead offset-5 alert alert-warning w-50">
                                Dear <?php echo $_SESSION["sessionName"] ?>, it is recommended you register a student before adding report.
                                </div>

                            <div class="container">
                            <div class="row">
                            <div class="modal fade" id="changePass" role="dialog">
                            <div class="container">
                            <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header bg-secondary text-light font-monospace fs-5">Change your password
                            <span class="btn btn-danger" data-bs-dismiss="modal">Exit</span></div>
                            <div class="modal-body">
                            <?php 
                            $query = "SELECT * FROM `staffs`";
                            $result = mysqli_query($conn, $query);
                            if($result){
                                $row = mysqli_fetch_assoc($result);
                                $recentPass = $row['password'];
                            }
                            
                            ?>
                            <form action="Staffs_Dashboard.php" method="post">
                            <input type="password" name="recentPassword" class="form-control" placeholder="Enter Recent Password" id="recentPass">
                            <br>
                            <input type="password" name="newPassword" class="form-control" placeholder="Enter New Password" id="newPass">
                            <br>
                            <input type="password" name="confirmNewPassword" class="form-control" placeholder="Confirm New Password" id="confirmPass">
                                <br>
                                <input type="checkbox" class="offset-4" onclick="showPassword()"><span class="text-black"> Show passwords</span>
                                <br>
                                <br>
                            &nbsp;&nbsp;<button type="submit" name="confirm" class="btn btn-primary w-25 offset-4 shadow">Confirm</button>

                            </form>
                            <script type="text/javascript">
                            function showPassword(){
                                var x = document.getElementById("recentPass");
                                var y = document.getElementById("newPass");
                                var z = document.getElementById("confirmPass");
                                if(x.type ==="password"){
                                    x.type ="text";
                                }else{
                                    x.type ="password";
                                }

                                if(y.type ==="password"){
                                    y.type ="text";
                                }else{
                                    y.type ="password";
                                }

                                if(z.type ==="password"){
                                    z.type ="text";
                                }else{
                                    z.type ="password";
                                }
                                
                            }
                            </script>
                            <br>
                            <br>
                            <?php 
                            if(isset($_POST['confirm'])){
                            $oldPass = $_POST["recentPassword"];
                            $newPass = $_POST["newPassword"];
                            $confirmNewPass = $_POST["confirmNewPassword"];
                            if(empty($oldPass) || empty($newPass) || empty($confirmNewPass)){
                            echo "<script type='text/javascript'> window.alert('All input fields are required with valid information.') </script>";
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;<span class='alert alert-danger offset-2' p-1>Please fill in all input fields.</span>";  

                            }elseif($oldPass !== $recentPass){
                            echo "<script type='text/javascript'> window.alert('The recent password you entered is incorrect!') </script>";
                                echo "&nbsp;&nbsp;&nbsp;<span class='alert alert-danger offset-1' p-1>The recent password you entered was incorrect!</span>";
                            }elseif($newPass !== $confirmNewPass){
                            echo "<script type='text/javascript'> window.alert('The new password does not match the confirm password!') </script>";
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;<span class='alert alert-danger' p-1>The new password did not match the confirm password!</span>";
                            }else{
                                $sql = "UPDATE `staffs` SET password='$newPass' WHERE `staffs` . department = '".$_SESSION['sessionDept']."'";
                                $result = mysqli_query($conn, $sql);
                                if($result){
                                echo "<script type='text/javascript'> window.alert('You have successfully changed your password.') </script>";
                                echo "<span class='alert alert-success offset-2' p-1>Your password was changed successfully</span>";
                                }else{
                                echo "<script type='text/javascript'> window.alert('You have successfully changed your password.') </script>";
                                echo "<span class='alert alert-danger' p-1>We were unable to change your password. Something went wrong!</span>"; 
                                }
                            }

                        }
                            ?>

                            </div>
                            </div>
                            </div>
                            </div>
                            <div class="col-sm-2"></div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>


                            <div class="container">
                            <div class="row">
                            <div class="modal fade" id="report" role="dialog">
                            <div class="container">
                            <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header lead bg-dark text-warning"> Add new report
                            <span class="close btn btn-danger" data-bs-dismiss="modal">Exit</span>
                            </div>
                            <div class="modal-body">
                            <form action="Staffs_Dashboard.php" method="post" enctype="multipart/form-data">

                            <?php 

                            if(isset($_POST["submit"]) || isset($_FILES['image']['name'])){

                            $name = stripslashes($_POST['name']); 
                            $regNumber = stripslashes($_POST['reg']);  
                            $department = stripslashes($_POST['department']); 
                            $level = stripslashes($_POST['level']); 
                            $student_category = stripslashes($_POST['student_category']); 
                            $mobile = stripslashes($_POST['number']); 
                            $email = stripslashes($_POST['email']);  
                            $misType = stripslashes($_POST['misType']); 
                            $description = stripslashes($_POST['description']);  
                            $date = stripslashes($_POST['date']); 

                            $image_name = $_FILES['image']['name'];
                            $image_size = $_FILES['image']['size'];
                            $tmp_name = $_FILES['image']['tmp_name'];
                            $image_err = $_FILES['image']['error'];
                            if($image_err === 0){
                                $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                                $image_exe_to_lc = strtolower($image_extension);
                                $allowed_exe = array('jpg','png','jpeg');
                                if(in_array($image_exe_to_lc, $allowed_exe)){
                                    $new_img_name = uniqid("$name", true) . '.' . $image_exe_to_lc;
                                    if($image_size > 4000000){
                                        echo "<script type='text/javascript'>
                                        window.alert('The image size is too large');
                                        </script>";
                                    }else{
                                        
                                        $move_upload_path = './uploads/'.$new_img_name;
                                    }
                                }else{
                                    echo "<script type='text/javascript'>
                                    window.alert('You cannot upload images of this type' + '$allowed_exe');
                                    </script>";
    
                                }
                            }


                             $name = mysqli_real_escape_string($conn, $name);
                            $regNumber = mysqli_real_escape_string($conn, $regNumber);
                            $department = mysqli_real_escape_string($conn, $department);
                            $level = mysqli_real_escape_string($conn, $level);
                            $mobile = mysqli_real_escape_string($conn, $mobile);
                            $email = mysqli_real_escape_string($conn, $email);
                            $misType = mysqli_real_escape_string($conn, $misType);
                            $description = mysqli_real_escape_string($conn, $description);
                            $date = mysqli_real_escape_string($conn, $date);

                            if(empty($name) || empty($department) || 
                            empty($regNumber) || empty( $level) || empty($mobile) || empty($email)
                            || empty($misType) || empty($description) || empty($date)){

                                echo "<script type='text/javascript'>
                                window.alert('Please fill in all input fields');
                                </script>";
                                echo "<center>" . "<div class='alert alert-danger'
                                style='background:transparent;
                                border:2px solid red; color:red;padding:7px'>" . 
                                "All input fields are required." . "</div>" . "</center>";

                            }

                              $sanitize_email = filter_var($email, FILTER_SANITIZE_EMAIL);

                                if(!filter_var($sanitize_email, FILTER_VALIDATE_EMAIL)){
                                echo "<script type='text/javascript'>
                                window.alert('Invalid email address format');
                                </script>";

                                echo "<center>" . "<div class='alert alert-danger'
                                style='background:transparent;
                                border:2px solid red; color:red;padding:7px'>" . 
                                "Invalid email address format." . "</div>" . "</center>";
                                }else if($department !== $dept){
                                    echo "<script type='text/javascript'>
                                    window.alert('You are not allowed to report cases of students from another department');
                                    </script>";
                                }else{

                                    $query = "SELECT regNumber FROM `student` WHERE regNumber = ?";
                                    $stmt = mysqli_stmt_init($conn);
                                    if(!mysqli_stmt_prepare($stmt, $query)) {

                                        die("Failed to connect");

                                    }else{

                                        mysqli_stmt_bind_param($stmt, "s", $regNumber);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_store_result($stmt);
                                        $rowCount = mysqli_stmt_num_rows($stmt);
                                        if($rowCount == 0) {

                                            echo "<script type='text/javascript'>
                                            window.alert('Student not found in database! Please add student before submitting report');
                                            </script>";
                                        }else{
                                    
                                        $sql = "INSERT INTO `report` (studentName, regNumber,
                                        department, level, student_category, mobile, email, misType, description, time, report_img)
                                        VALUES ('$name','$regNumber','$department',
                                        '$level', '$student_category', '$mobile', '$email', '$misType','$description','$date', '$new_img_name')";

                                        if($conn->query($sql)){
                                            move_uploaded_file($tmp_name, $move_upload_path);
                                            echo "<script type='text/javascript'>
                                            window.alert('Report Posted Successfully');
                                            </script>";
                                            
                                            }else{
                                                die(mysqli_error($conn));

                                            }
                                            }
                                        }
                                    }
                                }
                                // }
                            // }
                        // }
                            
                        
                              
                            
                            
                            ?>

                        <div class="form-group">
                        <input type="text" class="form-control form-control-md" name="name" placeholder="Name of student" autofocus>
                        <br>
                        <input type="text" class="form-control" name="reg" placeholder="Registration Number">
                        <br>
                        <input type="text" class="form-control" name="department" placeholder="Department">
                        <br>
                        &nbsp;<label for="level">level</label>
                        <select  name="level" class="form-control" placeholder="Level">
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                        <option value="400">400</option>
                        </select>

                        <br>
                        <select type="text" name="student_category" class="form-control" placeholder="Category">
                        <option value="ND-Regular">ND-Regular</option>
                        <option value="ND-Part-Time">ND-Part-Time</option>
                        <option value="HND-Regular">HND-Regular</option>
                        <option value="HND-Part-Time">HND-Part-Time</option>

                        </select>
                        <br>
                        <input type="number" name="number" class="form-control" placeholder="Phone Number">
                        <br>
                        <input type="email" name="email" class="form-control" placeholder="Email Address">
                        <br>
                        <label for="Misconduct Type" class="text-dark">Misconduct Case<b class="text-danger">*</b>
                        <br>
                        <select style="width:25vw" name="misType" class="form-control p-2" placeholder="Misconduct Case">
                        <option value="Examination Malpractice">Examination Malpractice</option>
                        <option value="Rape">Rape</option>
                        <option value="Theft">Theft</option>
                        <option value="Cultism Practices">Cultism Practices</option>
                        <option value="Vandalism">Vandalism</option>
                        <option value="Brutalism">Brutalism</option>
                        <option value="Sexual Harassment">Sexual Harassment</option>
                        <option value="Sexual Harassment">Sexual Assault</option>
                        <option value="Sexual Harassment">Descrimination</option>
                        <option value="Bribery">Bribery</option>
                        <option value="Forgery">Forgery</option>
                        <option value="Smoking">Smoking</option>
                        <option value="Fighting">Fighting</option>
                        <option value="Absenteeism">Absenteeism</option>
                        <option value="Drugs Possession">Drugs Possession</option>
                        <option value="Use Of Abusive Language">Use Of Abusive Language</option>
                        <option value="Lectures Disruption">Lectures Disruption</option>

                        </select>
                        </label>
                        <br>
                        <br>
                        <label for="Description" class="text-dark">Description<b class="text-danger">*</b>
                        <br>
                        <textarea cols="50" rows="10" type="text" name="description" class="form-control textarea"
                        placeholder="Describe Misconduct"></textarea>
                        </label>
                        <br>
                        <br>
                        <label for="date" class="text-dark">date
                        <br>
                        <input type="date" class="form-control p-1" name="date" placeholder="Date">
                        </label>
                        <br>
                        <br>
                        <span for="image" class="end-1">Sample image for report (<b class="text-danger">Optional</b>)</span>
                        <input type="file" class="form-control" name="image">
                        <!--   -->
                        <br>
                        &nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="submit" class="btn btn-primary w-50 offset-2">

                        </div>

                        </form>
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

                        </div>

                        <div class="container">
                        <div class="row">
                        <div class="modal fade" id="search-result" role="dialog">
                        <div class="container">
                        <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                        <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header bg-dark text-warning">
                        Input Student's Registration Number to search report.
                        </div>
                        <div class="modal-body">
                        <form action="Search_report.php" method="post">
                        <input type="search" name="regNumber" class="form-control shadow" placeholder="Student Registration Number" autofocus>
                        
                        <br>
                        <input type="submit" class="btn btn-success" name="submit">
                        <button type="button" class="btn btn-danger btn-sm w-25 offset-9" data-bs-dismiss="modal">Exit</button>
                        </div>
                        </form>
                        </div>
                        </div>
                        </div>
                        <div class="col-sm-3"></div>
                        </div>
                        </div>   
                        </div>
                        </div>
                        </div>

                        <div class="container">
                        <div class="row">
                        <div class="modal fade" id="writeAdmin" role="dialog">
                        <div class="container">
                        <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                        <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header bg-secondary text-warning">
                        Write a short notice to Admin.
                        <span type="button" class="btn btn-danger btn-sm " data-bs-dismiss="modal">Exit</span>
                        </div>
                        <div class="modal-body">
                        <form action="Staffs_Dashboard.php" method="post">
                        <input type="search" name="dept" class="form-control shadow" value="<?php echo $_SESSION["sessionDept"] ?>">
                        
                        <br>
                        <textarea name="msg" id="" cols="30" rows="10" class="p-5 form-control" style="padding:8rem" autofocus></textarea>
                        <br>
                        <input type="submit" class="btn btn-success" name="done" value="Done">
                        </div>
                        </form>
                        </div>
                        </div>
                        </div>
                        <div class="col-sm-2"></div>
                        </div>
                        </div>   
                        </div>
                        </div>
                        </div>

                        <?php 
                        if(isset($_POST["done"])){
                            $dept = $_POST["dept"];
                            $msg = $_POST["msg"];
                            if(!empty($msg)){
                                $query = "INSERT INTO staffwriteadmin (Department, msg) VALUES ('$dept','$msg')";
                                if($conn->query($query) === TRUE){
                                    define("MESSAGE", "<script type='text/javascript' class='offset-4 fw-bold'>window.alert('Notice posted successfully!')</script>");
                                    echo MESSAGE;
                                }

                            }else{
                                define("ERROR", "<script type='text/javascript' class='offset-3 fw-bold'>window.alert('Please write your noyification!') Input field cannot be empty.</script>");
                                echo ERROR;
                            }
                        }
                        ?>


                        <div class="container">
                        <div class="row">
                        <div class="modal fade" id="viewNotification" role="dialog">
                        <div class="container">
                        <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                        <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header bg-dark text-warning">
                        Notification message from Admin <span class="close btn btn-danger btn-sm" data-bs-dismiss="modal">Close</span>
                        </div>
                        <div class="modal-body">
                        <span>
                        <?php
                        $query = "SELECT * FROM `staffnotification` WHERE department = '".$_SESSION['sessionDept']."'";
                            $result = mysqli_query($conn, $query);
                            if($result && mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                            $notification = $row["message"];
                            echo "<div class=\"bg-secondary text-light p-3\">
                            $notification
                            </div>";
                            echo "<br>";
                            
                            }
                        }
                            ?>
                        </span>
                        </div>
                        </div>
                        </div>
                        <div class="col-sm-2"></div>
                        </div>
                        </div>   
                            
                        </div>
                        </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        &nbsp;&nbsp;&nbsp;
                            <div id="loginMsg" class="text-center w-25 fw-normal offset-7">
                            <?php 
                            if(isset($_SESSION['successLogin'])){
                                echo $_SESSION['successLogin'];
                            }

                            ?>
                            </div>
                            <script type="text/javascript">
                            var message = document.getElementById("loginMsg");
                            message.onclick = setTimeout(function(){ 

                            message.style.visibility = "hidden";
                             <?php 
                            if(isset($_SESSION['successLogin'])){
                                unset($_SESSION['successLogin']);
                            }
                            #endregion?>
                            },
                            
                             3000);
                            
                            </script>


                        <section class="w-100">

                        <footer class="text-center bg-dark p-4 fixed-bottom text-light">
                                <code>&copy; 2020 Akanu Ibiam Federal Polytechnic Unwana</code>
                        </footer>

                        </section>

                        <!-- <a href="Admin_login.php" class="fs-2">&#8592;</a> -->
                        <script src="bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js"></script>
                        <script src="bootstrap-5.1.3/dist/js/bootstrap.min.js"></script>
                        </body>
                        </html>