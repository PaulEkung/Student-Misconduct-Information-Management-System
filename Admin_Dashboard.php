                    <?php 
                    session_start();
                    require "connection.php";
                    require "login_check.php";
                    $checkConnection = check_admin_login($conn);

                    ?>

                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Admin_dashboard</title>
                    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
                    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">
                    <link rel="stylesheet" href="bootstrap-icons/bootstrap-icons.css">


                    <style type="text/css" media="all">
                    /* .bi-alarm::before { content: "\f102"; } */
                    #preloader{
                    background: rgba(0, 0, 0, 0.979)  url("images/excited-loading.gif") no-repeat center center;
                    height: 100vh;
                    width: 100%;
                    position:fixed;
                    z-index: 100;
                    margin-top: 3px;
                    
                    
                    } 
                    /* The sidenav navigation menu */

                    .sidenav{
                    height: 100vh; /*Full height*/
                    width: 0;  /* width stays 0, can only be changed using javascript*/
                    position: fixed;   /*Stay in place*/
                    z-index: 1;   /*Keep the sidenav on top*/
                    top: 0;
                    left: 0;
                    background: rgba(0, 3, 32, 0.908);
                    overflow-x: hidden;    /*Disable horizontal scroll*/
                    padding-top: 90px;
                    transition: 0.3s;

                    }


                    .sidenav a {
                    display: block;
                    padding: 8px 8px 8px 30px;
                    text-decoration: none;
                    font-size: 22px;
                    transition: 0.3s;
                    color: #fffffff2;
                    font-family: 'Courier New', Courier, monospace;;
                    text-transform: capitalize;

                    }

                    .sidenav a:hover, offcanvas a:focus{
                    background-color: rgba(4, 48, 56, 0.781);
                    color:gold;
                    transform: scale(1.1);
                    transition: 0.1s;
                    font-weight: 500;
                    }

                    .sidenav .closebtn{
                    position: absolute;
                    color: #f1f2f2;
                    top: 6rem;
                    right: 25px;
                    font-size: 36px;
                    /* margin-left: 60%; */
                    cursor: pointer;
                    }

                    li{
                        color:white;
                    }

                    .modal-dialog{
                        box-shadow: 6px 6px 5px 5px 6px rgba(0,0,0,0.3);
                    }

                    #main{
                        transition: margin-left .3s ease-in-out;
                        overflow: hidden;
                        width: 100%;
                    }
                    input[type="checkbox"]{
                        cursor: pointer;
                    }

                    #navmenu a{
                        margin-right: 40px;
                    }

                    </style>
                    </head>
                    <body class="bg-light bg-gradient">
                    <div id="preloader"> <center><p style="margin-top: 440px;color: rgba(240, 232, 232, 0.877)">
                    <br>
                    <br>
                      &nbsp;&nbsp;&nbsp; <txt class="">Please Wait..</txt> 
                   </p></div>
                    <script type="text/javascript">
                    function openNav(){
                    document.getElementById("mySidenav").style.width ="470px";
                    // document.getElementById("main").style.marginLeft ="80px";
                    // document.getElementById("main").style.opacity ="0.50";
                    }

                    function closeNav(){
                    document.getElementById("mySidenav").style.width ="0";
                    // document.getElementById("main").style.marginLeft ="0";
                    // document.getElementById("main").style.opacity ="100";
                    }

                    function refreshPage(){
                    window.location.reload();
                    }

                    function hideBadge() {
                    document.getElementById("badge1").remove();

                    document.getElementById("badge2").remove();

                    }

                    function disappear(){
                        document.getElementById("badge3").remove();
                    }

                    function dismissModal(){
                        window.location.reload();
                    }
                    function die(){
                        window.location.reload();
                    }
                    function quick_report_notice(){

                        document.getElementById("badge4").remove();
                    }

                    var loader = document.getElementById("preloader");
                    window.addEventListener("load", function(){
                    loader.style.display = "none";
                    
                   })

 

                    </script>


                    <nav class="navbar navbar-expand-md bg-black text-light fixed-top p-4">
                    <div class="navbar-brand">

                    <?php
                    if(isset($_SESSION['sessionAdminId'])){
                        echo "&nbsp;" . "<img src ='Images/person icon.jpg' style='width:50px' class='rounded-circle'/> " .
                        "&nbsp;&nbsp;\t" . $_SESSION['sessionAdmin'];
                    
                    }else{
                        
                        echo "You are logged in!";
                    }
                    
                    ?>
                    
                    </div>

                    <div class="container">
                    <div id="message" class="fw-bold position-absolute" style="margin-left:2rem; margin-top:10px; width:12rem">
                    <?php
                    if(isset($_SESSION['sessionMessage'])){
                        
                        echo $_SESSION['sessionMessage'];
                    }
                    
                    ?>
                    </div>
                    <div class="collapse navbar-collapse" id="navmenu">
                    <ul class="navbar-nav nav ms-auto ">
                
                    <!-- <li class="nav-item "> -->
                    <a href='#add-staff' data-bs-toggle="modal" class=' btn btn-dark fw-semibold offset-0'>ADD  STAFFS</a> 
                    <a href='view_staffs.php' class=' btn btn-dark fw-semibold offset-0'>VIEW STAFFS</a>
                    <a href='admin_view_students.php' class=' btn btn-dark fw-semibold offset-0'>ALL STUDENTS</a>
                    <span href="#" onclick="openNav()"
                    class="btn btn rounded-2 lead text-light border-1 active offset-0">
                    MORE
                    <span href="#" class="badge position-absolut  text-decoration-none">

                    <?php
                    $result = $conn->query("SELECT sum(table_count.EachTableCount) FROM (SELECT count(*) AS EachTableCount FROM `appeal` UNION ALL SELECT count(*) AS EachTableCount FROM `staffwriteadmin`) table_count");
                        if($result){
                            if($count = mysqli_fetch_array($result))
                            {
                        echo "<span class='bg-pink p-2 my-0'
                        style='background:purple;border-radius:100%;margin-left:-7px' id='badge1'>$count[0]</span>";
                        
                    }
                }
                
            
            
            ?>

                    <!-- </div> -->
                    </span> 
                    </span>
                    <span class ="offset-0">
                    
                    <span style="width:50px; cursor:pointer" class="bi bi-chat-fill fs-3" onclick="quick_report_notice()" data-bs-target="#quickReport" data-bs-toggle="modal"></span>
                    <?php
                    $sql = "SELECT * FROM `quick_report`"; 
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        $row = mysqli_fetch_assoc($result);
                        if(!empty($row["unique_id"]) || !empty($row["mobile"]) || !empty($row["report"]) || !empty($row['image1'])){ 
                            $query = "SELECT count(*) FROM `quick_report`";
                            $result = mysqli_query($conn, $query);
                            if($quick_report_count = mysqli_fetch_array($result)){
                                
                                echo "<span class='bg-warning text-black p-1 
                                fs-0 rounded-circle position-absolute' id='badge4' style='margin-left:7px;margin-top:0.2rem'>
                                <b>$quick_report_count[0]</b>
                                </span>";
                            }
                        }
                    }
                    ?>
                    </span>
                
                    </div>
                    </ul>
                    </div>
                    </nav>
                    <br>
                    <div class="container shadow">
                    <div class="row shadow">
                    <div class="container shadow">

                    <div id="mySidenav" class="sidenav shadow">

                    <div class="container bg-dark p-4">
                    <span class="text-warning lead fw-bold">Dashboard</span>
                    <img src ='Images/person icon.jpg' style='width:40px' class='rounded-circle offset-1'/>
                    <a href="javascript:void(0)" class="closebtn offset-5" onclick="closeNav()">&times;</a>

                    </div>
                    <br>
                    <ol>
                    <li>
                    <a href="#sendMail" data-bs-toggle="modal">
                    <span class="bi bi-envelope-fill text-warning"></span>  Send Mail to student</a>
                    </li>
                    <li>
                    <a href="#statements" data-bs-toggle="modal" onclick="hideBadge()">
                    <span class="bi bi-emoji-expressionless-fill text-warning"></span> Student respondses
                    <span class="badge position-absolute mb-5">

                    <?php
                    $sql = "SELECT * FROM `appeal`";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                    $row = mysqli_fetch_assoc($result);
                    if(!empty($row['regnumber']) || !empty($row['appeal_Message'])) {
                        
                    $sql = "SELECT COUNT(*) FROM appeal";
                    $result = mysqli_query($conn, $sql);
                    if($count_result = mysqli_fetch_row($result)){ 
                    
                        echo "<span class='bg-pink p-2'
                        style='background:green;border-radius:100%;margin-left:-16px' id='badge2'>$count_result[0]</span>";
                        
                    }
                    
                    }
                }
                    #endregion

                    ?>
                    </span>
                    </a>
                    </li>
                    <li>
                    <a href="#staffNotice" data-bs-toggle="modal" onclick="disappear()">
                    <span class="bi bi-messenger text-warning"></span>  Staffs Notifications
                    <?php 
                    $sql = "SELECT * FROM `staffwriteadmin`";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        $row = mysqli_fetch_assoc($result);
                        
                    if(!empty($row['Department']) || !empty($row['msg'])) {
                    $countQuery = "SELECT COUNT(*) FROM `staffwriteadmin`";
                    $result = mysqli_query($conn, $countQuery);
                    if($counter = mysqli_fetch_array($result)){
                        echo "<span class='bg-pink p-2 rounded-circle'
                        style='background:green;margin-left:-16px' id='badge3'>$counter[0]</span>";
                        
                    }
                }
            }
            ?>
                    </a>
                    </li>
                    <li>
                    <a href="#search-report" data-bs-toggle="modal">
                    <span class="bi bi-search text-warning"></span>  Search report</a>
                    </li>
                    <li>
                    <a href="#changeId" data-bs-toggle="modal">
                    <span class="bi bi-person-badge-fill text-warning"></span>  Change Admin ID</a>
                    </li>
                    <li>
                    <a href="#changePass" data-bs-toggle="modal">
                    <span class="bi bi-key-fill  text-warning"></span>  Change Password</a>
                    </li>
                    <li>
                    <a href="#logout" data-bs-toggle="modal"
                    class=" ">
                    <span class="bi bi-lock-fill text-warning"></span>  logout
                    </a>
                    </li>
                    </ol>
                    </div>
                    </div>
                    </div>
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
                    $query = "SELECT * FROM `admin`";
                    $result = mysqli_query($conn, $query);
                    if($result){
                        $row = mysqli_fetch_assoc($result);
                        $recent_Pass = $row['password'];
                    }
                    
                    ?>
                    <form action="Admin_Dashboard.php" method="post">
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
                        $old_Pass = $_POST["recentPassword"];
                        $new_Pass = $_POST["newPassword"];
                        $confirm_New_Pass = $_POST["confirmNewPassword"];
                        if(empty($old_Pass) || empty($new_Pass) || empty($confirm_New_Pass)){
                            echo "<script type='text/javascript'> window.alert('All input fields are required with valid information.') </script>";
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;<span class='alert alert-danger offset-2' p-1>Please fill in all input fields.</span>";  
                            
                        }elseif($old_Pass <> $recent_Pass){
                            echo "<script type='text/javascript'> window.alert('The recent password you entered is incorrect!') </script>";
                            echo "&nbsp;&nbsp;&nbsp;<span class='alert alert-danger offset-1' p-1>The recent password you entered was incorrect!</span>";
                        }elseif($new_Pass !== $confirm_New_Pass){
                            echo "<script type='text/javascript'> window.alert('The new password does not match the confirm password!') </script>";
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;<span class='alert alert-danger' p-1>The new password did not match the confirm password!</span>";
                        }else{
                            $sql = "UPDATE `admin` SET password='$new_Pass' WHERE `admin` . id = 1";
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
                    <div class="modal fade" id="changeId" role="dialog">
                    <div class="container">
                    <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                    <div class="modal-dialog shadow">
                    <div class="modal-content">
                    <div class="modal-header bg-secondary text-light font-monospace fs-5">Change your ID
                    <span class="btn btn-danger" data-bs-dismiss="modal">Exit</span></div>
                    <div class="modal-body">
                    <?php 
                    $query = "SELECT * FROM `admin`";
                    $result = mysqli_query($conn, $query);
                    if($result){
                        $row = mysqli_fetch_assoc($result);
                        $recent_Id = $row['Admin_Id'];
                    }
                    
                    ?>
                    <form action="Admin_Dashboard.php" method="post">
                    <input type="text" name="recentId" class="form-control shadow" placeholder="Enter Recent ID">
                    <br>
                    <input type="text" name="newId" class="form-control shadow" placeholder="Enter New ID">
                    <br>
                    <br>
                    &nbsp;&nbsp;<button type="submit" name="finish" class="btn btn-primary w-25 offset-4 shadow">Confirm</button>

                    </form>
                    
                    <br>
                    <br>
                    <?php 
                    if(isset($_POST['finish'])){
                        $old_Id = $_POST["recentId"];
                        $new_Id = $_POST["newId"];
                        if(empty($old_Id) || empty($new_Id)){
                            echo "<script type='text/javascript'> window.alert('All input fields are required with valid information.') </script>";
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;<span class='alert alert-danger offset-2' p-1>Please fill in all input fields.</span>";  
                            
                        }elseif($old_Id !== $recent_Id){
                            echo "<script type='text/javascript'> window.alert('The recent ID you entered is incorrect!') </script>";
                            echo "&nbsp;&nbsp;&nbsp;<span class='alert alert-danger offset-1' p-1>The recent ID you entered was incorrect!</span>";
                        }else{
                            $sql = "UPDATE `admin` SET Admin_id='$new_Id' WHERE `admin` . id = 1";
                            $result = mysqli_query($conn, $sql);
                            if($result){
                                echo "<script type='text/javascript'> window.alert('You have successfully changed your ID.') </script>";
                                echo "<span class='alert alert-success offset-2' p-1>Your ID was changed successfully</span>";
                            }else{
                                echo "<script type='text/javascript'> window.alert('Failed to change ID.') </script>";
                                echo "<span class='alert alert-danger' p-1>We were unable to change your ID. Something went wrong!</span>"; 
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
                    
                    

                    <br>

                <div class="container">
                <div class="row">
                <div class="modal fade" id="quickReport" role="dialog">
                <div class="container">
                <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-black text-warning">
                    All quick reports <span class="close fs-3 btn-close btn text-light" data-bs-dismiss="modal">&times;</span>
                </div>
                <div class="modal-body">
                <span>
                
                <?php 
                    $query = "SELECT * FROM `quick_report`";
                    $result = mysqli_query($conn, $query);
                    if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        
                    $quick_report_id = $row["id"];
                    $quick_report_unique_id = $row["unique_id"];
                    $quick_report_mobile = $row["mobile"];
                    $quick_report_Report = $row["report"];
                    $quick_report_date = $row["date"];
                    $studentId_card = $row["image1"];
                    $sample_image = $row["image2"];

                    echo "
                    <span class='alert-light'><strong style='border-radius: 100px' class='bg-light p-1 text-black'>
                    Quick Report</strong>  from <b>$quick_report_mobile</b> <span class='text-danger'>Unique Id:  <b>$quick_report_unique_id</b> </span>
                    <p class='bg-primary p-2 text-light'>
                    &nbsp; $quick_report_Report
                    <p><b>Report Date:</b>  $quick_report_date </p>
                    
                    </p>
                    <span>
                    <strong>Reporter's ID</strong>
                    <span class='offset-4 fw-bold'>Sample Image</span>
                    <br>
                    <img src='./uploads/$studentId_card' class='offset-0' style='width:120px; border-radius:3px'/>
                
                    <a href='uploads/$studentId_card' class='btn btn-primary btn-sm'>Large Image</a>
                    </span>
                    &nbsp;&nbsp;&nbsp;
                    <span class='offset-0'>
                    
                    <img src='uploads/$sample_image' class='offset-0' style='width:120px; border-radius:3px'/>
                    
                    <a href='uploads/$sample_image' class='btn btn-primary btn-sm'>Large Image</a>
                    </span>
                    
                    

                    
                    </span>

                    <br><br>

                    ";
                    
                    }
                    }else{
                        echo "No quick report avalaible";
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
                </div>


                    <a href="#" id="top"></a>

                    <div id="main">
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
                    <p class="lead font-monospace text-warning">Ready to exit!</p>
                    </div>
                    <div class="modal-body">
                    <p class="brand fw-bold text-center">Dear administrator, are you sure to logout? </p>
                    <br>
                    <a href="#" class=" close btn btn-danger offset-3" data-bs-dismiss="modal">No</a>
                    <a href="Admin_logout.php" class="btn btn-success offset-3">Yes</a>
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

                   <div class="container">
                    <div class="row">
                    <div class="modal fade" id="add-staff" role="dialog">
                    <div class="container">
                    <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                    
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header bg-dark text-light"> Add Staffs <span class="btn btn-danger btn-sm" data-bs-dismiss="modal">close</span></div>
                    <div class="modal-body">
                    <?php 

                    require 'connection.php';
                    
                    if(isset($_POST['register']) && isset($_FILES['Image']['name'])){
                        
                        $name = stripslashes($_POST["name"]);
                        $staff_department = stripslashes($_POST["department"]);
                        $password = stripslashes($_POST["password"]);
                    $img_name = $_FILES['Image']['name'];     
                    $tmp_name = $_FILES['Image']['tmp_name']; 
                    $img_size = $_FILES['Image']['size'];  
                    $img_error = $_FILES['Image']['error']; 
                    if($img_error === 0){
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
                    $allowed_exs = array('jpg','png','jpeg');
                    if(in_array($img_ex_to_lc, $allowed_exs)){
                        if($img_size > 4000000){
                            
                    echo  "<script type =\"text/javascript\"> window.alert(\"Sorry, the image size is too large\") </script>";
                    
                        }else{
                    $new_img_name = uniqid("$name", true).'.'.$img_ex_to_lc;
                    $img_upload_path = './uploads/'.$new_img_name;
                    if(file_exists($img_upload_path)){
                        
                        echo  "<script type =\"text/javascript\"> window.alert(\"Sorry, the file already exist\") </script>";
                    }else{
                     move_uploaded_file($tmp_name, $img_upload_path); 
                     
                    }
                }
                
                    }else{
                        
                    echo "<script type='text/javascript'>
                    window.alert('You cant upload images of this type.');
                    </script>"; 
                }
                }else{ 

                    echo "<script type='text/javascript'>
                    window.alert('An unknown image error occured!');
                    </script>";
                }
                
                
                $name = mysqli_real_escape_string($conn, $name);
                $staff_department = mysqli_real_escape_string($conn, $staff_department);
                    $password = mysqli_real_escape_string($conn, $password);
                    
                    
                    if(empty($name) && empty($staff_department) && empty($password) && empty($img_name)){
                        
                    echo  "<script type =\"text/javascript\"> window.alert(\"All input fields are required with some valid information.\") </script>";
                    
                }elseif(!preg_match("/^[a-zA-Z]*/", $name)){
                    
                    echo  "<script type =\"text/javascript\"> window.alert(\"Invalid name format '$name'.\") </script>";
                    
                }else{

                    $sql = "SELECT department FROM staffs WHERE department = ?";
                    $stmt = mysqli_stmt_init($conn);
            
                    if(!mysqli_stmt_prepare($stmt, $sql)){
            
                    echo "failed to connect";
                    exit();
            
                }else{
            
                    mysqli_stmt_bind_param($stmt, "s", $staff_department);
            
                    mysqli_stmt_execute($stmt);
            
                    mysqli_stmt_store_result($stmt);
            
                    $rowCount = mysqli_stmt_num_rows($stmt);
                    
                    if($rowCount > 0){

                        echo  "<script type =\"text/javascript\"> window.alert(\"The department '$staff_department' already exists.\") </script>";
                  
                    }else{
                
                        $query = "INSERT INTO staffs (name, department, password, Image) 
                    VALUES ('$name','$staff_department','$password','$new_img_name')";
                    if($conn->query($query) === TRUE){
                        
                        echo  "<script type =\"text/javascript\"> window.alert(\"Staff added successfully.\") </script>";
                        
                        
                    }
                }
                // mysqli_stmt_close($stmt);
                // mysqli_close($conn);
                }
            }
                }
            
                ?>

                    <form action="Admin_Dashboard.php" method="post" enctype="multipart/form-data" class="p-2 mt-2">
                    <div class="form-group">
                    <input type="text" name="name" id="name" 
                    class="form-control border-2" placeholder="Name of HOD">
                    <br>
                    <select type="text " name="department" id="departments" autofocus="autofocus" 
                    class="form-control text-black" placeholder="Department">
                    <optgroup label="School Of Science and General Studies" class="text-black">
                    <option value="Accountancy" class="text-black">Accountancy</option>
                    <option value="Agricultural Technology" class="text-black">Agricultural Technology</option>
                    <option value="Bussiness Administration Management" class="text-black">Bussiness Administration and Management</option>
                    <option value="Ceramics and Glass Technology" class="text-black">Ceramics and Glass Technology</option>
                    <option value="Civil Engineering Technology" class="text-black">Civil Engineering Technology</option>
                    <option value="Computer Science" class="text-black">Computer Science</option>
                    <option value="Electrical Engineering" class="text-black">Electrical Engineering</option>
                    <option value="Food Technology" class="text-black">Food Technology</option>
                    <option value="General Studies" class="text-black">General Studies</option>
                    <option value="Hospitality Management and Tourism" class="text-black">Hospitality Management and Tourism</option>
                    <option value="Mass Communication Technology" class="text-black">Mass Communication Technology</option>
                    <option value="Marketing" class="text-black">Marketing</option>
                    <option value="Mathematics/Statistics" class="text-black">Mathematics/Statistics</option>
                    <option value="Mechanical Engineering" class="text-black">Mechanical Engineering Technology</option>
                    <option value="Office technology and Management" class="text-black">Office technology and Management</option>
                    <option value="Pre-ND Science" class="text-black">Pre-ND Science</option>
                    <option value="Pre-ND Science" class="text-black">Public Administration</option>
                    <option value="Quantity Survey" class="text-black">Quantity Survey</option>
                    <option value="Science Laboratory Technology" class="text-black">Science Laboratory Technology</option>
                    </optgroup>
                    </select>
                    <br>
                    <input type="password" name="password" id="password"
                    class="form-control border-2 "
                    placeholder="Password">
                    <br>
                    <input type="file" class="form-control" name="Image">
                    <br>
                    <input type="checkbox" onclick="showPass()"> <span class="text-black">Show password</span>
                    <br>
                    <br>
                    &nbsp;&nbsp;&nbsp;<input type="submit" value="Add" name="register" class="btn btn-success w-75 offset-1">
                    <br>
                    
                    </div>
                    </div>

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
                    
                    </div>
                    </div>
                    </div>
                    <div class="col-sm-1"></div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    &nbsp;&nbsp;
                    <button type="button" onclick="refreshPage()"
                    class='btn btn-success fw-semibold shadow'>Reload Page 
                    </button>

                    <?php

                    $query = "SELECT COUNT(*) FROM `report`";
                    $result = mysqli_query($conn, $query);
                    if($report_count = mysqli_fetch_array($result)){ 
                        // mysqli_fetch_array can still be used.
                    if($report_count > 1){
                        
                        $msg_1 = "
                    <span class='p-4 text-light text-light font-monospace offset-0 fs-6 fw-semibold' style='height:5vh;background: rgba(0, 3, 32, 0.808)'>" .
                    "<span class='offset-0 fs-2 fw-bold'> $report_count[0]</span> &nbsp;&nbsp;" . 
                    "Available Reports" .
                    "</span>";

                        echo $msg_1;
                        
                    }else{
                        
                        $msg_2 = "<span class='alert alert-success bg-primary offset-0 fw-semibold p-4' style='height:5vh'>" .
                        "<span class='offset-0 fs-2 fw-bold'> $count[0]</span>" .
                        "Available Report".
                        "</span>";
                        
                        
                        echo $msg_2;
                        
                        }
                        
                    }else{
                    
                    echo "<span class='offset-0 alert alert-success w-25'> No report avalaible" . 
                    "<span class='close btn btn fs-3 mb-4' data-bs-dismiss='alert'> &times</span>" . "</span>";
                    
                    }
                    

                    $sql = "SELECT COUNT(*) FROM `staffs`";
                    if($count = mysqli_fetch_row(mysqli_query($conn, $sql))){ 
                    // mysqli_fetch_array can still be used.
                    if($count > 1){
                        
                        $msg_3 = "<span class=' bg-success p-4 text-light text-light fs-6 offset-0 fw-semibold' style='height:5vh'>" .
                        "<span class='offset-0 fs-2 fw-bold'> $count[0]</span> &nbsp;&nbsp;" . 
                        "Registered  Staffs" .
                        "</span>";
                        
                        echo $msg_3;
                        
                    }else{
                        
                        $msg_4 = "<span class='alert alert-success bg-primary offset-0 fw-semibold p-4' style='height:5vh'>" .
                        "<span class='offset-0 fs-2 fw-bold'> $count[0]</span>" .
                        "Registered Staff".
                        "</span>";
                        
                        
                        echo $msg_4;
                        
                    }
                    
                }else{
                    
                    echo "<span class='offset-2 alert alert-success bg-primary'>No registered staff" . 
                    "<span class='close btn btn fs-3 mb-4' data-bs-dismiss='alert'> &times</span>" . "</span>";
                    
                }
                    
                
                        $sql = "SELECT COUNT(*) FROM `student`";
                        if($count = mysqli_fetch_row(mysqli_query($conn, $sql))){ 
                            // mysqli_fetch_array can still be used.
                        if($count > 1){
                        
                        $msg_5 = "<span class=' bg-primary p-4 text-light text-light font-monospace fs-6 offset-0 fw-semibold' style='height:5vh'>" .
                        "<span class='offset-0 fs-2 fw-bold'> $count[0]</span> &nbsp;&nbsp;" . 
                        "Registered Students" .
                        "</span>";

                        echo $msg_5;
                        
                    }else{
                        
                        $msg_6 = "<span class=' bg-primary offset-0 fw-semibold p-5' style='height:5vh'>" .
                        "<span class='offset-0 fs-2 fw-bold'> $count[0]</span>" .
                        "student".
                        "</span>";
                        
                        
                        echo $msg_6;
                        
                    }
                    
                }else{
                    
                    echo "<span class='offset-2 alert alert-primary bg-primary'>No registered student" . 
                    "<span class='close btn btn fs-3 mb-4' data-bs-dismiss='alert'> &times</span>" . "</span>";
                    
                    }
                    
                    $query = "SELECT count(regNumber) FROM `report` GROUP BY regNumber HAVING COUNT(regNumber) = 2";
                        $result_count = mysqli_query($conn, $query);
                        if($result_counter = mysqli_fetch_array($result_count)){
                            
                            ?>
                        <span class=' bg-warning p-4 text-black text-light font-monospace fs-6 fw-semibold offset-0' style='height:5vh'>
                        <span class='offset-0 fs-2 fw-bold'><?php echo $result_counter[0] ?> </span> &nbsp;&nbsp; 
                        Report Frequencies  &nbsp; <a href='#FrequentCheck' data-bs-toggle='modal' class='btn btn-dark btn-sm'>view</a>
                        </span>
                        
                        <?php
                            
                        }else{
                            $msg_6 = "<span class=' bg-warning offset-0 fw-semibold p-4 offset-1' style='height:5vh'>" .
                            "<span class='offset-0 fs-2 fw-bold'> 0 </span>" . " "." "." ".
                            "Report Frequency Avalaible". "&nbsp;" .
                        "</span>";
                        
                        echo $msg_6;
                        }
                        
                        ?>
                    

                        <script type="text/javascript"> 
                        var message = document.getElementById("message");
                        message.onclick = setTimeout(function(){
                        message.style.visibility = "hidden";
                        <?php 
                        if(isset($_SESSION['sessionMessage'])){
                            
                            unset($_SESSION['sessionMessage']);
                        }
                        ?>
                       }, 4000);

                        </script>
                        <br>
                        <br>
                        <br>
                        <?php
                        echo "
                        <table class='table table-bordered p-0 table-condensed table-sm alert alert-primary text-center table-responsive table-hover'>
                        <thead>
                        <th class='alert alert-secondary p-3  border-light border-2' style='border:'>Image</th> 
                        <th class='alert alert-secondary p-3  border-light border-2' style='border:'>Name</th>
                        <th class='alert alert- secondary p-3  border-light border-2' style='border:'>Department</th>
                        <th class='alert alert-secondary p-3  border-light border-2' style='border:'>Student Category</th>
                        <th class='alert alert-secondary p-3  border-light border-2'>Misconduct Severity</th> 
                        <th class='alert alert-dark p-3  border-light border-2' style=''>Action</th> 
                        </thead>
                        ";

                        $sql = "SELECT img.Image, re.* FROM `student` img , `report` re WHERE img.regNumber = re.regNumber ORDER BY id ASC";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                            while($row = mysqli_fetch_assoc($result)){
                            
                                
                                $id = $row['id'];
                                $name = $row['studentName'];
                                $department = $row['department'];
                        $regNumber = $row['regNumber'];
                        $level = $row['level'];
                        $student_category = $row['student_category'];
                        $mobile = $row['mobile'];
                        $email = $row['email'];
                        $misType = $row['misType'];
                        $description = $row['description'];
                        $date = $row['time'];
                        $punishment = $row['punishment'];
                        $created = $row['date'];
                        $image = $row['Image'];
                        // $time = date("U");
                        
                        if($misType == 'Rape' || $misType == 'Examination Malpractice' || $misType == 'Theft' || $misType == ucwords('cultism practices')
                        || $misType == strtolower('cultism practices') || $misType =='Sexual Asault' || $misType == 'Discrimination' || $misType == 'Sexual Harassment' || $misType == 'Bribery' || $misType == 'Drugs Possession'){
                            $category = "<div class=\"p-2 text-black\">
                            A
                            <span class=\"offset-0\">
                            &nbsp;&nbsp;&nbsp; <progress min=\"0\" max=\"100\" value='100' style=\"color:red\" class=\"p-2 bg-danger\"></progress>
                            </span>
                            </div>";
                        }elseif($misType == 'Vandalism' || $misType == 'Brutalism' || $misType == 'Smoking' || $misType == 'Forgery'){

                            $category = "<div class=\"p-2 text-black\">
                            B
                            <span class=\"offset-0\">
                            &nbsp;&nbsp;&nbsp;&nbsp; <progress min=\"0\" max=\"100\" value=\"100\" style=\"color:black\" class=\"p-2 bg-warning\"></progress>
                            </span>
                            </div>";
                        }else{
                            $category = "<div class=\"p-2 text-black\">
                            C
                            <span class=\"offset-0\">
                            &nbsp; &nbsp;&nbsp;<progress min=\"0\" max=\"100\" value=\"100\" style=\"color:black\" class=\"p-2 bg-success\"></progress>
                            </span>
                            </div>"; 
                        }
                        
                        
                        
                        echo "
                        <tr>
                        <td class='bg-light p-2 border-light border-2'>
                        
                        <span><img src='./uploads/$image' class='offset-0' style='width:120px; border-radius:3px'/></span>
                        </td>
                        <td class='bg-light p-3 border-white border-2' style='border:height:20px'> <br> $name</td>
                        
                        <td class='bg-light p-3 border-2 border-white' style='height:20px'>
                        <br>
                        $department 
                        </td>
                        <td class='bg-light p-3 border-white border-2' style='height:20px'>
                        <br> $student_category
                        </td>
                        <td class='bg-light p-2 border-white border-2' style='height:20px'>
                        <br> $category
                        
                        </td>
                        
                        <td class='bg-light p-3 border-white border-2' style='height:20px'>
                        <form action='Admin_viewFullreport.php' method='post' class='p-3' style='padding:0'>
                        <input type='hidden' name='id' value=' ".$row['id']." '>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' name='view' value='View Full Report' 
                        class='btn btn-success btn-md fw-semibold mb-4 offset-0 fw-normal'>
                        </form>
                        </td>
                        </tr>
                        ";

                        
                        
                        
                        
                        
                    }
                }

               echo "</table>";
                        
                        if($report_count == 0){
                            
                            echo "<div>No report available</div>";
                        }
                        
                        ?>

                        
                        <!-- <button><a href="http://" target="_blank" rel="noopener noreferrer"></a></button> -->
                        <!-- <button><a href="http://" target="_blank" rel="noopener noreferrer"></a></button> -->

                        <div class="container">
                        <div class="row">
                        <div class="modal fade" id="statements" role="dialog">
                        <div class="container">
                        <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                        <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header bg-dark">
                        <p class="lead font-monospace text-warning">Response statements</p><span class="close btn btn-danger offset-2" data-bs-dismiss="modal">Close</span>
                        </div>
                        <div class="modal-body">

                        <?php 

                        $sql = "SELECT img.Image, ap.* FROM `student` img, `appeal` ap WHERE img.regnumber = ap.regNumber";
                        $result = mysqli_query($conn, $sql);
                        if($result) {

                        while($row = mysqli_fetch_assoc($result)) {

                        $appeal_Message = $row['appeal_Message'];
                        $appeal_id = $row['id'];
                        $reg = $row['regNumber'];
                        $date = $row['date'];
                        $pic = $row['Image'];
                        
                    

                        echo "
                        <span class='alert-light'><strong style='border-radius: 100px' class='bg-light p-1 text-black'>
                        Response</strong> message from <b>$reg</b>
                        <p class='bg-primary p-2 text-light'>
                        <img src='./uploads/$pic' class='offset-0 mt-1 rounded-circle' style='width:50px; border-radius:3px'/>
                        &nbsp; $appeal_Message
                        <p><b>Posted date:</b>  $date </p>
                        &nbsp;&nbsp; <a href='appealMsgDelete.php?deleteAppealMsg=$appeal_id' class='btn btn-danger btn-sm offset-0'>Delete</a>
                        <form action='feedback.php' method='post'>
                        <input type='hidden' name='regnumber' value='".$row['regNumber']."' class='form-control'>
                        <input type='submit' name='sendFeed' value='Send feedback' class='btn btn-success offset-8'>
                        </form>
                        </p>


                        </span>

                        <br><br>

                        ";
                        }
                        }else{
                            echo "No result";
                        }
                        ?>

                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="col-sm-1"></div>
                        </div>
                        </div>
                        </div>
                        </div>

                        <div class='container'>
                        <div class='row'>
                        <div class='modal fade' id='confirmDeleteResponse' role='dialog'>
                        <div class='container'>
                        <div class='row'>
                        <div class='col-sm-4'></div>
                        <div class='col-sm-5'>
                        <br>
                        <br>
                        <br>
                        <div class='modal-dialog'>
                        <div class='modal-content'>
                        <div class='modal-header bg-dark text-warning'>Confirm delete appeal message </div>
                        <div class='modal-body'>
                        <p class='fw-bold text-center'>Are you sure to delete this message?</p>
                        <br>
                        &nbsp;&nbsp;
                        <span class='btn btn-dark btn-md offset-3' onclick='dismissModal()'>No</span>
                        <a href='appealMsgDelete.php?deleteAppealMsg=<?php echo $appeal_id ?>' class='btn btn-success btn-md offset-1'>Yes</a>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class='col-sm-3'></div>
                        </div>
                        </div>
                        </div>
                        </div>

                        <div class='container'>
                        <div class='row'>
                        <div class='modal fade' id='staffNotice' role='dialog'>
                        <div class='container'>
                        <div class='row'>
                        <div class='col-sm-1'></div>
                        <div class='col-sm-10'>
                        <br>
                        <br>
                        <br>
                        <div class='modal-dialog'>
                        <div class='modal-content'>
                        <div class='modal-header bg-dark text-warning'>Notifications from Staffs  
                        <span class="btn btn-outline-danger btn-sm text-light" data-bs-dismiss="modal">Close</span></div>
                        <div class='modal-body'>
                        
                        <?php 
                        $query = "SELECT sta.*, st.Image FROM staffwriteadmin sta, staffs st WHERE sta.Department = st.department";
                        $result = mysqli_query($conn, $query);
                        if($result){

                            while($rowCount = mysqli_fetch_assoc($result)){
                            $staffDept = $rowCount['Department'];
                            $staffNotice = $rowCount['msg'];
                            $staffImage = $rowCount['Image'];
                            $noticeDate = $rowCount['date'];

                        echo "
                        <span class='alert-light'><strong style='border-radius: 100px' class='bg-light p-1 text-black'>
                        Notification from</strong> <b>$staffDept Department.</b>
                        <p class='bg-dark p-2 text-light'>
                        <img src='./uploads/$staffImage' class='offset-0 mt-1 rounded-circle' style='width:50px; border-radius:3px'/>
                        &nbsp; $staffNotice
                        <p class='text-dark'><b>Posted date:</b>  $noticeDate </p>
                    
                        </p>
                        </span>

                        <br><br>

                        ";
                        
                            }
                        }
                        
                        ?>

                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class='col-sm-1'></div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <!-- Seearching reports -->

                        </div>
                        <div class='container'>
                        <div class='row'>
                        <div class='modal fade' id='search-report' role='dialog'>
                        <div class='container'>
                        <div class='row'>
                        <div class='col-sm-1'></div>
                        <div class='col-sm-10'>
                        <br>
                        <br>
                        <br>
                        <div class='modal-dialog'>
                        <div class='modal-content'>
                        <div class='modal-header bg-dark text-warning'>Search Report 
                        <span class="btn btn-outline-danger btn-sm text-light" data-bs-dismiss="modal">Close</span></div>
                        <div class='modal-body'>
                        
                       <form action="admin_viewFullreport.php" method="post">
                       <input type="text" name = "regnum" class="form-control" placeholder="Enter student's registration number">
                       <br>
                       <input type="submit" name="search" class="btn btn-primary" value="Search">
                       </form>

                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class='col-sm-1'></div>
                        </div>
                        </div>
                        </div>
                        </div>

                        </div>

                        <div class='container'>
                        <div class='row'>
                        <div class='modal fade' id='sendMail' role='dialog'>
                        <div class='container'>
                        <div class='row'>
                        <div class='col-sm-3'></div>
                        <div class='col-sm-6'>
                        <br>
                        <br>
                        <br>
                        <div class='modal-dialog'>
                        <div class='modal-content'>
                        <div class='modal-header bg-dark text-warning'>Send notice to student via E-mail 
                        <a href='#' class='btn btn-danger btn-md offset-3' data-bs-dismiss="modal">Exit</a>
                        </div>
                        <div class='modal-body'>
                        <form action="Mail.php" method="post">
                        <input type="search" name="reg" class="form-control" placeholder="Student's Registration Number">
                        <br>
                        <br>
                        <input type="submit" value="Continue" name="submit"  class='btn btn-success btn-md offset-4'>
                        </form>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class='col-sm-3'></div>
                        </div>
                        </div>
                        </div>
                        </div>

                        </div>

                        </div> 
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class='col-sm-1'></div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>

                        <div class='container container-lg'>
                        <div class='row'>
                        <div class='modal fade' id='FrequentCheck' role='dialog'>
                        <div class='container'>
                        <div class='row'>
                        <!-- <div class='col-sm-0'></div> -->
                        <div class='col-sm-12'>
                        <br>
                        <br>
                        <br>
                        <div class='modal-dialog'>
                        <div class='modal-content'>
                        <div class='modal-header bg-dark text-warning'>Frequently Occured Reports 
                        <a href='#' class='btn btn-danger btn-sm offset-3' data-bs-dismiss="modal">Exit</a>
                        </div>
                        <div class='modal-body'>
                        
                        <?php
                        $query = "SELECT count(*) FROM `report` GROUP BY regNumber HAVING COUNT(regNumber) > 1";
                        $result = mysqli_query($conn, $query);
                        if($result_counting = mysqli_fetch_array($result)){
                            $addCount = $result_counting[0];
                        }
                    
                        $sql = "SELECT img.Image, re.* FROM `student`img, `report`re WHERE img.regNumber = re.regNumber GROUP BY re.regNumber HAVING COUNT(re.regNumber) > 1";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                        while($row = mysqli_fetch_assoc($result)){ 
                        $F_regNumber = $row['regNumber'];   
                        $F_Image = $row['Image'];   
                        $F_name = $row['studentName'];   

                        if($addCount[0] == 2){
                            $rate = "<span class=\"offset-0\">
                            &nbsp; &nbsp;&nbsp;<progress min=\"0\" max=\"100\" value=\"25\" style=\"\" class=\"p-2\"></progress> <span class='text-dark'>25%</span>
                            </span>"; 
                        }elseif($addCount[0] == 3){
                            $rate = "<span class=\"offset-0\">
                            &nbsp; &nbsp;&nbsp;<progress min=\"0\" max=\"100\" value=\"50\" style=\"accent-color: yellow\" class=\"p-2\"></progress> <span class='text-dark'>50%</span>
                            </span>"; 
                        }elseif($addCount[0] == 4){
                            $rate = "<span class=\"offset-0\">
                            &nbsp; &nbsp;&nbsp;<progress min=\"0\" max=\"100\" value=\"75\" style=\"accent-color:black\" class=\"p-2\"></progress> <span class='text-dark'>75%</span>
                            </span>"; 
                        }elseif($addCount[0] == 5){
                            $rate = "<span class=\"offset-0\">
                            &nbsp; &nbsp;&nbsp;<progress min=\"0\" max=\"100\" value=\"100\" style=\"accent-color:red\" class=\"p-2\"></progress> <span class='text-dark'>100%</span>
                            </span>"; 
                        }
                        // mysqli_fetch_array can still be used.
                        // foreach($countings as $counting){
                        
                        echo "
                            
                        <div class=\"container\" style=''>
                        <br>
                        
                        <img src='./uploads/$F_Image' class='offset-0 mt-0 rounded-circle' style='width:50px;'/>
                        &nbsp; <span class='fw-bold text-black'>$F_name</span> <span class=\"bg-danger p-2 offset-2 text-light\" style='width='4rem'>$addCount[0] reports</span> $rate
                        <form action='frequency_check.php' method='post' class='form'>
                        <input type='hidden' name='reg' value='$F_regNumber'>
                        
                        <input type='submit' name='check' class='btn btn-primary btn-sm offset-9' value='view'/>
                        </form>
                        <br>
                        
                        </div>
                        <br>

                        ";
                        }
                    
                        }
                        
                    //    }

                        //  else{
                        
                        // $msg_7 = "<span class=' bg-warning offset-0 fw-semibold p-4' style='height:5vh'>" .
                        // "<span class='offset-0 fs-3 fw-bold'> No Report Frequency Avalaible </span>" . 
                        
                        // "</span>";
                        
                        
                        // echo $msg_7;
                        
                        // }
                    
                        
                    
                        
                        ?>
                        
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <!-- <div class='col-sm-0'></div> -->
                        </div>
                        </div>
                        </div>
                        </div>

                        </div>

                        </div>              


         <br>
         <br>
                  <section class="w-100">

                    <footer class="footer bg-dark p-1 text-light position-fixed fixed-bottom">
                    <code> <span class="fs-3">&copy;</span> 2022 Akanu Ibiam Federal Polytechnic Unwana
                    <a href="#top" class ='btn btn-outline-primary offset-3 text-light'>Back to top</a>  
                    </code>
                    </footer>

                    </section> 

                        <script src="bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js"></script>
                        <script src="bootstrap-5.1.3/dist/js/bootstrap.min.js"></script>
                        <script src="bootstrap-5.1.3/dist/js/bootstrap.bundle.js"></script>
                        <script src="bootstrap-5.1.3/dist/js/bootstrap.bundle.js.map"></script>
                        <script src="bootstrap-5.1.3/dist/js/bootstrap.js.map"></script>

                        </body>
                        </html>