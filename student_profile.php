        <?php
        session_start();
        require "connection.php";
        require "login_check.php";
        $conn_Check = check_student_Login($conn);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Student_Profile</title>
        <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
        <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap-icons.css">
        </head>
        <body>
        <nav class="navbar bg-secondary p-2 text-light">

        <?php
        echo "<div class='brand fw-bold bg-danger p-3'>" . $_SESSION['sessionStudentReg'] . "</div>"; 
        ?>

        <i id="Msg" class="position-absolute w-25 offset-2">
            <?php
            if(isset($_SESSION['successful'])){

            echo $_SESSION['successful'];
            }

            ?>
            </i>
        <strong class='btn offset-3 text-light fw-bold' data-bs-toggle="modal" data-bs-target="#feedback">
        <?php
        $query = "SELECT regNumber FROM feedback WHERE regNumber =' ".$_SESSION['sessionStudentReg']."'";
        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0 ){
        $row = mysqli_fetch_assoc($result);
        echo "feedback message available"; 

        }else{

            echo "No Feedback Message";
        }

        echo "&nbsp";

        $sql = "SELECT COUNT(*) FROM feedback WHERE regNumber =' ".$_SESSION['sessionStudentReg']."'";
        if($count = mysqli_fetch_array(mysqli_query($conn, $sql))) {

            echo "<span class=\"p-2 fs-9 position-absolute mb-5 fw-bold\"
            style='border-radius: 13px 0 15px 0; background:#f329'>". $count[0]. "</span>";
        }

        ?>
        
        </strong>
        <span class="active offset-0 btn text-light" data-bs-target="#change_Pass" data-bs-toggle="modal"> CHANGE PASSWORD </span>
        <a href="#logout" data-bs-target="#logout" class="btn btn-danger offset-0" data-bs-toggle="modal">Logout</a>
        </nav>

            <script type="text/javascript">
           
             var message = document.getElementById("Msg");
            message.onclick = setTimeout(function(){
            message.style.visibility = "hidden";
            <?php 
            if(isset($_SESSION['successful'])){
                unset($_SESSION['successful']);
            }
            ?>    
            },
            3000)

            </script>

        <br>

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
        <p class="brand fw-bold text-center">Dear 
        <?php echo $_SESSION['sessionStudentName'] ?>, are you sure to logout?</p>
        <br>
        <a href="#" class="close btn btn-danger offset-3" data-bs-dismiss="modal">No</a>
        <a href="studentLogout.php" class="btn btn-success offset-3">Yes</a>
        </div>
        </div>
        </div>
        </div>
        </div>
        <div class="col-sm-3"></div>
        </div>
        </div>
        </div>
        </div>

        <div class="container">
        <div class="row">
        <div class="modal fade" id="change_Pass" role="dialog">
        <div class="container">
        <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-dark">
        <p class="lead font-monospace text-warning">Change Your Password</p>
        <span class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</span>
        </div>
        <div class="modal-body">
        <?php 
        if(isset($_POST["change"])){
            $password_1 = $_POST["password_1"];
            $password_2 = $_POST["password_2"];
            if(empty($password_1) || empty($password_2))
            {
             $err = "<center>" . "<div class='alert alert-danger w-100 text-black'>" . 
            "<b> Empty Input Fields  </b>" . "<br>" .
             "Please fill in all input fields!" . "</div>" . "</center>";

            echo $err;

            }elseif($password_2 <> $password_1){

             $error = "<center>" . "<div class='alert alert-danger w-100 text-black'>" . 
            "<b> Error :</b>"  .  "  The two passwords did not match!" . "</div>" . "</center>";

            echo $error;
            echo "<script type='text/javascript'> window.alert('The two confirm password did not match the new password.') </script>";
            

        }else{
            
            $sql = "UPDATE `student` SET password='$password_1' WHERE `student` . regNumber = '".$_SESSION['sessionStudentReg']."'";
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
                <form action="student_profile.php" method="post">
                <br>
                <input type="password" class="form-control" name="password_1" placeholder="Enter New Password" id="pwd1">
                <br>
                <br>
                <input type="password" class="form-control" name="password_2" placeholder="Conmfirm New Password" id="pwd2">
                <script type="text/javascript">
                function ShowPass(){
                   var x = document.getElementById("pwd1");
                   var y = document.getElementById("pwd2");
                   
                   if(x.type =="password"){
                       x.type ="text";
                   }else{
                       x.type ="password";
                   }
                   if(y.type =="password"){
                       y.type ="text";
                   }else{
                       y.type ="password";
                   }
                }
                </script>
                <br>
                <input type="submit" class="btn btn-secondary" name="change">
                <span class="offset-6 fw-bold">Show password</span>  <input type="checkbox" onclick="ShowPass()">
                </form>
                </div>
                </div>
                </div>
                </div>
                </div>
                <div class="col-sm-3"></div>
                </div>
                </div>
                </div>
                </div>


                <section>


               <?php
        
                $sql = "SELECT * FROM report WHERE regNumber = '".$_SESSION['sessionStudentReg']."'";
                $sql = "SELECT img.Image, re.* FROM `student` img, `report` re WHERE img.regNumber = re.regNumber AND re.regNumber = '".$_SESSION['sessionStudentReg']."'";

                $result = mysqli_query($conn, $sql);
                if($result && mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                $_SESSION['sessionReg'] = $row['regNumber'];
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
                $punishment = $row['punishment'];
                $created = $row['date'];
                $image = $row['Image'];
                $sample = $row['report_img'];
              
                echo "<table class='w-100 text-center table-bordered table table-active'>" .
                "<p class='lead bg-light text-dark fw-normal p-2'>  
                Created:  $created" . "<img src='uploads/$image' class='offset-1 p-1' style='width:100px; border-radius:3px'>".
                 "<span class='offset-3 fw-normal'>Sample Evidence---><img src='uploads/$sample' class=' p-1' style='width:100px;
                  border-radius:3px'></span>" .
               
                "</p>" .

                    "<thead>" .

                "<th class='bg-secondary p-3 text-light' style='border: 4px solid white'>Name</th>" .
                "<th class='bg-secondary p-2 text-light' style='border: 4px solid white'>Department</th>" .
                "<th class='bg-secondary p-2 text-light' style='border: 4px solid white'>Registration Number</th>" .
                "<th class='bg-secondary p-2 text-light' style='border: 4px solid white'>Level</th>" .
                "<th class='bg-dark p-2 text-warning' style='border: 4px solid white'>Phone number/Email</th>" .
                "</thead>" .
                "<tbody>" .
                "<tr>" .
                "<td class='bg-light p-3' style='border: 4px solid white '>" .
                "<b>" . $name . "</b>".
                "</td>" .
                "<td class='bg-light p-3' style='border: 4px solid white'>" .
                "<b>" . $department . "</b>" .
                "</td>" .
                "<td class='bg-light p-3' style='border: 4px solid white'>" .
                "<b>" . $regNumber . "</b>" .
                "</td>" .
                "<td class='bg-light p-3' style='border: 4px solid white'>" .
                "<b>" . $level . "</b>" .
                "</td>" .
                "<td class='bg-light p-3' style='border: 4px solid white'>"  .
                "<b>" . $mobile . "<br>" . $email . "</b>" .
                "</td>" .
                "</tr>" .
                "</tbody>" .
                "<thead>" .
                "<tbody>" .
                "<th class='bg-secondary p-2 text-light' style='border: 4px solid white'>Misconduct Case</th>" .
                "<th class='bg-secondary p-2 text-light' style='border: 4px solid white'>Description</th>" .
                "<th class='bg-secondary p-2 text-light' style='border: 4px solid white'>Date of Misconduct</span></th>" .
                "<th class='bg-secondary p-2 text-light' style='border: 4px solid white'>Punishment</th>" .
                "<th class='bg-dark p-3 text-warning' style='border: 4px solid white'>Action</th>" .
                "</thead>" .
                "<tr>" .
                "<td class='bg-light p-4' style='border: 4px solid white'>" .
                "<b>" . $misType . "</b>" .
                "</td>" .
                "<td class='bg-light p-3 w-25' style='border: 4px solid white'>" .
                    "<b>" . $description . "</b>" .
                "</td>" .
                "<td class='bg-light p-5' style='border: 4px solid white'>" .
                "<b>" . $date . "</b>".
                "</td>" .
                "<td class='bg-light p-5' style='border: 4px solid white'>" .
                "<b class='text-danger'>" . $punishment . "</b>" .
                "</td>" .
                "<td class='bg-light p-3' style='border: 4px solid white'>" .
                "<span class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#Statement'>Reply Report</span></td>" .
                "</td>" .
                "</tr>" .
                "</tbody>" .

                "</table>";
                }
                    }else{
                        echo "<div class='text-center fw-bold'>
                        <br>
                        <br>
                        <br>
                        <center> NO REPORT AVALAIBLE </center>
                        </div>";
                    }

                    ?>
                    
                    <br>
                    <br>
                    <?php 
                    
                    $sql = "SELECT * FROM report WHERE regNumber = '".$_SESSION['sessionStudentReg']."'";
                    $result = mysqli_query($conn, $sql);
                    if($result && mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                        
                        echo "
                        
                    <div class='container'>
                    <div class='panel panel-primary border-primary'>
                    <div class='panel-heading bg-danger text-center text-light p-2'>Notice</div>
                    <span class='brand'>Dear <b class='text-danger'> $name </b>, 
                    this report was posted by the HOD of $department department.
                    
                    ";
                    echo "<br>";
                    
                    $query = "SELECT puishment FROM report WHERE punishment ='$punishment'";
                    $result = mysqli_query($conn, $sql);
                    if($result && mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $punishment = $row['punishment'];
                    $effectDate = $row['punishmentDate'];
                    if($punishment == ""){

                    echo "No punishment has been tagged to this misconduct report due to ongoing investigations.
                            Note that futher notice will be communicated or posted to your profile if any.
                            You are hereby advised to frequently check your profile in other to remain updated.  
                    ";

                    }else{
                        echo " After neccessary investigations, you where found guilty and the punishment of your misconduct
                        is stated above. Your punishment Takes effect from the <b class='text-danger'>
                        $effectDate.</b>";
                    }
                }
                        

                    }else{
                        die(mysqli_error($conn));
                    }
                    
                    ?>
                    
                </span>
                </div>
                </div>

                </div>


                </div>
                </div>
                </div>

            
                <div class="container">
                <div class="row">
                <div class="modal fade" id="Statement" role="dialog">
                <div class="container">
                <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-dark text-warning">
            <span class="close btn btn-danger offset-10" data-bs-dismiss="modal">Exit</span>
                </div>
                <div class="modal-body">

                <form action="student_profile.php" method="post">
                <div class="form-group">
                <input type="text" name="regNumber" class="form-control" placeholder="Enter registration number" value="<?php echo $_SESSION['sessionStudentReg'] ?>">
                <br>
                <textarea type="text" name="Appeal" id="" cols="50" rows="10" class=" form-control textarea" placeholder="Enter response">
                </textarea>
                <br>
                <p>Dear <?php if(isset($_SESSION['sessionStudentId'])){ echo $_SESSION["sessionStudentName"]; }?>
                , You are allowed to respond to the Administration about this report. Your response will be seen by the admin and feedback will be given to you. </p>
                <br>
                <input type="submit" name="submit" value="submit" class="btn btn-dark offset-5">

                </div>

                </form>
                <br>
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
                <div class="modal fade" id="feedback" role="dialog">
                <div class="container">
                <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-dark text-warning">
                <p>Feedback message from Admin</p> <span class="btn btn-danger" data-bs-dismiss="modal">Exit</span>
                </div>
                <div class="modal-body">

                <?php 

                $query = "SELECT * FROM feedback WHERE regNumber =' ".$_SESSION['sessionStudentReg']."'";
                $result = mysqli_query($conn, $query);
                if($result && mysqli_num_rows($result) > 0 ){
                while($row = mysqli_fetch_assoc($result)) {
                $message = $row['feedbackMsg'];
                $date = $row["date"];

                echo "<div class=\"bg-success text-light p-3\">
                $message 
                </div>";
                echo "<span class=\" text-black p-1 w-50\">Posted: $date</span>";
                echo "<br>"; 
                echo "<br>"; 


                }
                }

                ?>

                </div>

                </form>
                <br>
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

                <?php 

                if(isset($_POST['submit'])) {

                $reg = $_POST['regNumber'];
                $apmsg = $_POST['Appeal'];

                // To protect SQL injection.
                $reg = stripslashes($reg);
                $apmsg = stripslashes($apmsg);
                $reg = mysqli_real_escape_string($conn, $reg);
                $apmsg = mysqli_real_escape_string($conn, $apmsg);


                if(empty($reg) || empty($apmsg)) {

                $_402_error_msg = "<script class='text-danger fw-bold'> 
                window.alert(\"Please fill in all required input fields\")</script>";
                echo $_402_error_msg;

                }else {

                $query = "SELECT regNumber FROM `report` WHERE regNumber ='$reg'";
                $result = mysqli_query($conn, $query);
                if($result && mysqli_num_rows($result) === 0 ) {

                echo "<script type='text/javascript'> 
                window.alert(\"Please key in the correct registration number\")</script>";


                }else{

                $sql = "INSERT INTO `appeal` (regNumber, appeal_Message) VALUES ('$reg','$apmsg')";
                $result = mysqli_query($conn, $sql);
                if($result) {

                ?>
                </section>
                <br>
                <?php 
                echo "<script type='text/javascript'> 
                window.alert(\"Response message posted successfully!\")</script>";

                $msgSuccess = "<center>" . "<div class='alert alert-success w-50 text-black'
                style='background:transparent;
                border:2px solid green; padding:7px'>" . 
                "<b>Your response was successfully submitted. <br>
                Feedback will be given to you from the school administration</b>" . "</div>" . "</center>";

                echo $msgSuccess;

                }else{

                echo "Failed to submit appeal";
                }
                }

                }
                }

                ?>

                

                </section>

                <script type="text/javascript">
                function refreshPage() {

                window.location.reload();
                }
                function exitModal(){
                    window.location.reload();
                }
                </script>
                <br>
                <br>
                <br>
                <br>
                <section class="w-100">
                <footer class="text-center bg-dark p-2 text-light w-100">
                <p class="">Copyrights &copy; 2022 Alrights reserved</p>
                </footer>
                </section> 
                <script src="bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js"></script>  
                <script src="bootstrap-5.1.3/dist/js/bootstrap.min.js"></script>  
                </body>
                </html>