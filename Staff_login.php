<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Staffs_login</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap-icons.css">
    <style type="text/css">
    input[type="password"]:placeholder-shown{
        border:3px solid red !important;
    }

    input[type="checkbox"]{
        cursor: pointer;
    }

        
    </style>
</head>
<body>
<!-- header section -->
<section class="p-2 text-center text-light" style="background:rgb(63, 5, 5);">
<div class="container p-0">
<div class="d-sm-flex justify-content-between align-items-center p-0">
<img src="Images/aifpu.jpg" style="width:90px" class="w-15 mt-3" alt="">
<h2 class="ms-auto"><b>AKANU IBIAM FEDERAL POLYTECHNIC UNWANA <span class="fw-normal">(A.I.F.P.U)</span></b></h2>

</div>
</div>
</section>
<!-- body section -->
<section class="p-0 px-5  text-center shadow-1-strong" 
 style="background-image:linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.8)),
  url('Images/bgl.jpg'); background-size: cover;
    background-repeat: no-repeat;height: 78vh; background-attachment: fixed">

    <div class="container">
    <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <br>
    <br>
    <br>
    <br>
    <br>
    <form action="Staff_login.php" method="post" class="p-3 mt-1">

    <?php 
    session_start();
    
    include 'connection.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $department = strtoupper($_POST["department"]);
        $department = strtolower($_POST["department"]);

        // $department = ucwords($_POST["department"]);// commented out since it is the default-
        //  pattern avalaible in the databse, else loggin will not.
        
        $password = $_POST["password"];

        // To protect MYSQL injection
        $department = stripslashes($department);
        $password = stripslashes($password);
        $department = mysqli_real_escape_string($conn, $department);
        $password = mysqli_real_escape_string($conn, $password);


        if(empty($department) || empty($password)) {
        echo "<center>" . "<div class='alert alert-danger'
        style='background:transparent;border:2px solid red; color:red;padding:10px'>" . 
        "Input fields required." . "</div>" . "</center>";
        }else{
            $query = "SELECT * FROM staffs WHERE department = '$department' AND password = '$password' limit 1";
            $result = mysqli_query($conn, $query);
            if($result){
                if($result && mysqli_num_rows($result) > 0){

                    $row = mysqli_fetch_assoc($result);
                    if(strtoupper($row['department']) === $department || strtolower($row['department']) === $department
                      && $row['password'] === $password){

                    $_SESSION['sessionStaffId'] = $row['id'];
                    $_SESSION['sessionDept'] = $row['department'];
                    $_SESSION['sessionName'] = $row['name']; 
                    $_SESSION['successLogin'] = "<div class=\"alert alert-success text-black\">Login successful!</div>"; 
                    header("location: Staffs_Dashboard.php");
                     die;

                    }

                    }else{
                        echo "<center>" . "<div class='alert alert-danger'
                        style='background:transparent;border:2px solid red; color:red;padding:10px'>" . 
                        "Incorrect password or Unknown department given." . "</div>" . "</center>";
                        }
            }
        }
    }
    ?>
    <br>
 
    <div class="form-group">
    <select type="text " name="department" id="departments" autofocus="autofocus" 
    class="form-control bg-transparent border-primary border-3 text-light" placeholder="Department">
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
    <br>
    <input type="password" name="password" id="password" 
    class="form-control bg-transparent border-primary border-3 text-light" placeholder="Password">
    <br>
    <input type="checkbox" onclick="showPass()"> <span class="text-light">Show password</span>
    <br>
    <br>
    <input type="submit" value="PROCEED" name="login" class="btn btn-success w-75">

    <script type="text/javascript">
    function showPass(){
        var x = document.getElementById("password");
        if(x.type == "password"){
            x.type ="text";
        }else{
            x.type ="password";
        }
    }
    </script>
    
    </div>
    </div>
    </form>
    <div class="col-md-3"></div>
    </div>
    <br>
    <a href="Intro.php" class="offset-0 fs-4 text-light">Back to home</a>
    </section>
<!-- footer section -->
    <section> 
    <footer class="text-center text-light p-3" style="background:rgb(63, 5, 5);">
    <p class="">Copyright &copy; 2022 Alrights reserved</p>
    </footer>
    </section>
    </body>
    </html>