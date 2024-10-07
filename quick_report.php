<?php 
    require_once 'connection.php';
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>quick report</title>
<link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
<link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap-icons.css">
<style type="text/css" media="all">
        *{
            margin:0;
            padding:0;
            box-sizing: border-box;
            font-family: "Century Gothic";
        }
        
    </style>
   
</head>
<body class="bg-light">
  <br>
<a href="index.php" class="close fs-2 offset-1 p-3 btn-close text-light" style="cursor:pointer"></a>
 <br>
 <br>
 
<center>
    <div class="message alert alert-success text-center" style="width:34rem">
    <span>
    Please note that you are about to send a quick report of a misconduct case to the administration 
    of the Akanu Ibiam Federal Polytechnic Unwana. We advise you ensure that this report is legitimate as proper investigation
    will be carried on in response to this report. <br>
    <b>Your identity is Undisclosed! </b> 
    </span>
    </div>
    </center>
    
    <center>
    <div class="container">
    <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <form action="quick_report.php" method="post" enctype="multipart/form-data" class="shadow-lg p-5">
      <?php 
        if(isset($_POST['submit']) || isset($_FILES['image']['name']) || isset($_FILES['img']['name'])) {

          $mobile = $_POST["mobile"];
          $_Report_Msg = $_POST["msg"];
            $Unique_id = bin2hex(random_int(6666, 99999));
            //  $Unique_id = uniqid(666, 999);
    
             $img_name_1 = $_FILES["image"]["name"];
             $tmp_name = $_FILES["image"]["tmp_name"];
             $img_size = $_FILES["image"]["size"];
             $img_error = $_FILES["image"]["error"];
             if($img_error === 0){
               $img_extension = pathinfo($img_name_1, PATHINFO_EXTENSION);
               $img_extension_to_lc = strtolower($img_extension);
               $allowed_extensions = array('jpg', 'jpeg', 'png');
               if(in_array($img_extension_to_lc, $allowed_extensions)){
                 $new_img_name_1 = uniqid("$mobile", true) . '.' . $img_extension_to_lc;
                 $img_upload_path = './uploads/'. $new_img_name_1;
                 if($img_size > 4000000){
                   echo "<span class='alert alert-danger'>The image file size is too large!</span>";
                 }elseif(file_exists($new_img_name_1)){
         
                   echo "<span class='alert alert-danger'>The image file has alredy been uploaded!</span>";
         
                 }
                
              }else{
                echo "<span class='alert alert-danger'>You cannot upload images of this type '$img_extension_to_lc'</span>";
         
              }
            }
    
            $img_name_2 = $_FILES["img"]["name"];
            $tmp_name_2 = $_FILES["img"]["tmp_name"];
            $img_size = $_FILES["img"]["size"];
            $img_error = $_FILES["img"]["error"];
            if($img_error === 0){
                $img_extension = pathinfo($img_name_2, PATHINFO_EXTENSION);
                $img_extension_to_lc = strtolower($img_extension);
                $allowed_extensions = array('jpg', 'jpeg', 'png');
              if(in_array($img_extension_to_lc, $allowed_extensions)){
                  $new_img_name_2 = uniqid("$mobile", true) . '.' . $img_extension_to_lc;
                $img_upload_path_2 = './uploads/'. $new_img_name_2;
                if($img_size > 4000000){
                    echo "<span class='alert alert-danger'>The image file size is too large!</span>";
                }elseif(file_exists($new_img_name_2)){
             
                  echo "<span class='alert alert-danger'>The image file has alredy been uploaded!</span>";
           
                }
              }else{
                echo "<span class='alert alert-danger'>You cannot upload images of this type '$img_extension_to_lc'</span>";
        
              }
            }
          
             if(empty($_Report_Msg) || empty($mobile)){
              define("ERR", "<div class='alert alert-danger p-3 text-center offset-0'style='padding:9px;width:28rem'>" . 
               "Please fill in all required input fields." . "</div>", false);
               echo ERR;
               
            }else if(empty($img_name_1)){
              define("REQUIRED", "<div class='alert alert-danger text-center offset-0'style='padding:9px;width:28rem'>" . 
              "You need to upload a photo of your student ID card." . "</div>", false);
              echo REQUIRED;
            }
            elseif(strlen($mobile) < 11 || strlen($mobile) > 11){
              
              define("WARNING", "<center>" . "<div class='alert alert-danger text-center offset-0'style='
              padding:9px;width:28rem'>" . 
              "Invalid mobile number! Please provide a valid mobile number." . "</div>" . "</center>", false);
              echo WARNING;
            }else{
              $query = "INSERT INTO `quick_report` (unique_id, mobile, report, image1, image2) VALUES ('$Unique_id', '$mobile', '$_Report_Msg', '$new_img_name_1','$new_img_name_2')";
              if($conn->query($query) === TRUE){
                move_uploaded_file($tmp_name, $img_upload_path);
                move_uploaded_file($tmp_name_2, $img_upload_path_2);
                    define("SUCCESS", "<center>" . "<div class='alert alert-success text-center offset-0'style='
                    border:3px solid green;padding:5px;width:28rem'>" . 
                   nl2br("Your report has successfully been submited. \r\n Thanks for promoting discipline in the school." . "</div>" . "</center>"), false);
                    echo SUCCESS;
                
                }else{
                    define("ERROR", "<center>" . "<div class='alert alert-danger text-center offset-0'style='
                    padding:5px;width:28rem'>" . 
                   "Failed to submit report! Something went wrong." . "</div>" . "</center>", false);
                    echo ERROR;
                }
            }
        }
      ?>
    <div class="form-group">
    <input type="number" name="mobile" class="form-control form-control-lg" maxlength ="11" minlength="11"  placeholder="Your Mobile Number">
    <br>
    <textarea name="msg" id="" cols="30" rows="8" placeholder="Write Report" class="form-control" autofocus></textarea>
    <br>
    <!-- <span for="image" class="end-1">Sample Image (<b class="text-danger">Optional</b>)</span>
    <input type="file" class="form-control" name="image1">
    <br> -->
    <label for="image" class="float-start">Your student ID card (<b class="text-danger">Required*</b>)</label>
    <input type="file" class="form-control form-control-lg" name="image">
    </div>
    <br>
  
      <label for='tag' class="float-start">You may have an image sample of report (<b class='text-danger'>Optional</b>)</label>
      <input type='file' name='img' class='form-control form-control-lg'>
      <br>
     
     
               
    <input type="submit" name="submit" class="btn btn-primary fw-bold w-100 p-3">
    </form>
    </div>
    <div class="col-md-3"></div>
    </div>
    </div>
    </center>
    <br>
    


      
<br>
<br>
<br>
</body>
</html>