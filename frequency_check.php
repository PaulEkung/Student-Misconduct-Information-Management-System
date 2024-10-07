
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">

</head>
<body>

   <nav class="navbar navbar-expand-md bg-black py-3 text-light fixed-top">
    <div class="navbar-brand">

    <?php
    if(isset($_SESSION['sessionAdminId'])){
    echo "&nbsp; <span class='bg-success text-center p-2 fw-bold text-light'>" . 
    "<script type='text/javascript'>document.write('Admin Panel')</script> " . "</span>" .
    "&nbsp;&nbsp;\t" . $_SESSION['sessionAdmin'];
    }else{

    echo "You are logged in!";
    }

    ?>
    <a href="Admin_Dashboard.php" class="btn btn-outline-primary offset-5">Back to home</a>
    </nav>
 
<br>
<br>
<br>
<br>


<?php
require 'connection.php';

if(isset($_POST["check"])){
    $F_regNumber = $_POST["reg"];

    // $sql = "SELECT * FROM `report` WHERE regNumber = '$F_regNumber'";
    $sql = "SELECT img.Image, re.* FROM `student` img, `report` re WHERE img.regnumber = re.regNumber AND re.regNumber = '$F_regNumber'";

    $result = mysqli_query($conn, $sql);
    if($result && mysqli_num_rows($result) > 0){

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
        $punishment = $row['punishment'];
        $created = $row['date'];
        $image = $row['Image'];
        



    echo "<table class='text-center table-bordered table table-active'>" . //'table-striped' class can also be added.
    "<p class=\"alert alert-primary p-3 text-center fw-bold font-monospace\">Report posted From $department Department</p>".
    "<p class='lead bg-light text-light p-3 fw-bold bg-dark'> 
    &nbsp;Created:  $created <span><img src='uploads/$image' class='offset-1 mt-1' style='width:100px; border-radius:3px'/></span>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
    <span class='btn btn-success offset-3' data-bs-toggle='modal' data-bs-target='#staffFeedback'>Send feedback to staff</span>
    <span class='offset-1'>
    <a class='text-decoration-none btn btn-danger'
    href='#confirmDeleteReport' data-bs-toggle='modal'>Delete report</a>
    </span>
    <span>
    

    </span>" .
    "</p>" .

    "<thead>" .

    "<th class='bg-secondary p-3 text-light' style='border: 4px solid white'>Name</th>" .
    "<th class='bg-secondary p-3 text-light' style='border: 4px solid white'>Department</th>" .
    "<th class='bg-secondary p-3 text-light' style='border: 4px solid white'>Registration Number</th>" .
    "<th class='bg-secondary p-3 text-light' style='border: 4px solid white'>Level</th>" .
    "<th class='bg-dark bg-gradient p-3 text-warning' style='border: 4px solid white'>Phone number/Email</th>" .
    "</thead>" .
    "<tbody>" .
    "<tr>" .
    "<td class='bg-light p-3' style='border: 4px solid white'>" .
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
    "<th class='p-2 text-light bg-secondary' style='border: 4px solid white'>Misconduct Case</th>" .
    "<th class='p-2 text-light bg-secondary' style='border: 4px solid white'>Description</th>" .
    "<th class='p-2 text-light bg-secondary' style='border: 4px solid white'>Date of Misconduct <span class='fw-lighter'></span></th>" .
    "<th class='p-2 text-light bg-secondary' style='border: 4px solid white'>Punishment</th>" .
    "<th class='bg-dark p-3 bg-gradient text-warning' style='border: 4px solid white'>Actions</th>" .
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
    "<td class='bg-light p-4' style='border: 4px solid white'>" .
    "<form action='punishment.php' method='post'>
    <input type='hidden' name='id' value='".$row['id']."'>
    <input type='submit' name='submit' value='Insert punishment' class='btn btn-primary shadow'>
    </form>
    " .
    "</td>" .
    "</tr>" .
    "</tbody>" .

    "</table>"; 
       }
      }
     }
   ?>

   <div class="container">
        <div class="row">
        <div class="modal fade" id="staffFeedback" role="dialog">
        <div class="container">
        <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-black text-warning"> <span class="btn btn-danger" data-bs-dismiss="modal">Close</span></div>
        <div class="modal-body">
        <div class="form-group">
        <form action="Admin_viewFullreport.php" method="post">
        <input type="text" class="form-control" name="staffDept" value="<?php echo $department ?>" placeholder="Enter Department">
        <br>
        <textarea type="text" cols="20" rows="10" class="form-control textarea" name="staffMessage" placeholder="Notification Message"></textarea>
            <br>
            <input type="submit" name="done" class="btn btn-dark offset-5">
        </div>
        </form>
        </div>
        </div>
        </div>

        <?php
        if(isset($_POST['done'])){
            $staffDept = $_POST["staffDept"];
            $staffMessage = $_POST["staffMessage"];
            if(empty($staffMessage)){
                echo "<script type=\"text/javascript\">window.alert(\"Please fill the required input field!\")</script>";
            }else{

                $query = "INSERT INTO `staffnotification` (department, message) VALUES ('$staffDept','$staffMessage')";
                if($conn->query($query) === TRUE){
                    echo "<span class='fw-semibold text-center'>Posted Successfully</span>";
                    echo "<script type=\"text/javascript\">window.alert(\"Notification message posted successfully!\")</script>";
                }else{
                    echo "<script type=\"text/javascript\">window.alert(\"Failed to post message! An unknown error occured.\")</script>";

                }
            }
        }
        ?>
        
        </div>
        <div class="col-sm-2"></div>
        </div>
        </div>
        </div>
        </div>
        </div>

        <div class='container'>
        <div class='row'>
        <div class='modal fade' id='confirmDeleteReport' role='dialog'>
        <div class='container'>
        <div class='row'>
        <div class='col-sm-4'></div>
        <div class='col-sm-5'>
        <br>
        <br>
        <br>
        <div class='modal-dialog'>
        <div class='modal-content'>
        <div class='modal-header bg-dark text-warning'>Confirm delete report! </div>
        <div class='modal-body'>
        <p class='fw-bold text-center'>Are you sure to delete this report?</p>
        <br>
        &nbsp;&nbsp;
        <a href='#' class='btn btn-dark btn-md offset-3' data-bs-dismiss="modal">No</a>
        <a href='Admin_delete.php?deleteId=<?php echo $id ?>' class='btn btn-success btn-md offset-1'>Yes</a>
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
    


        <script src="bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="bootstrap-5.1.3/dist/js/bootstrap.min.js"></script>
        <script src="bootstrap-5.1.3/dist/js/bootstrap.bundle.js"></script>
        <script src="bootstrap-5.1.3/dist/js/bootstrap.bundle.js.map"></script>
        <script src="bootstrap-5.1.3/dist/js/bootstrap.js.map"></script>

</body>
</html>