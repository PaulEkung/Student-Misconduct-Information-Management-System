                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta http-equiv="X-UA-Compatible" content="ie=edge">
                        <title>Student_Registration</title>
                        <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
                        <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">
                        <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap-icons.css">
                        <style type="text/css">

                        input[type="password"]:placeholder-shown{
                            border:3px solid red !important;
                        }

                        /* input[type="checkbox"]{
                            cursor: pointer;
                        } */
                        ::placeholder{
                            color:#fff;
                        }
                            
                        </style>
                    </head>
                    <body>
                        <!-- header section -->
                    <section class="p-1 text-center text-light" style="background:rgb(63, 5, 5);">
                    <div class="container p-0">
                    <div class="d-sm-flex justify-content-between align-items-center p-0">
                    <img src="Images/aifpu.jpg" style="width:80px" class="w-15 mt-3" alt="">
                    <h2 class="ms-auto"><b>AKANU IBIAM FEDERAL POLYTECHNIC UNWANA</b></h2>

                    </div>
                    </div>
                    </section>
                    <!-- body section -->
                    <section>
                    <section class="p-3 px-5 text-center shadow-1-strong" 
                    style="background-image:linear-gradient(rgba(0,0,0,0.8),rgba(0,0,0,0.8)),
                    url('Images/about.jpg'); background-size: cover;
                        background-repeat: no-repeat;height: 79vh; background-attachment: fixed">

                        <div class="container">
                        <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">

                    <!-- posting students information to database -->
                        <?php 
                        session_start();
                        require 'connection.php';
                        
                        if(isset($_POST["proceed"]) && isset($_FILES['Image']['name'])){

                            $name = $_POST["name"];
                            $department = $_POST["department"];
                            $regNumber = $_POST["regNumber"];
                            $category = $_POST["category"];
                            $password = $_POST["password"];

                            $img_name = $_FILES['Image']['name'];     
                            $tmp_name = $_FILES['Image']['tmp_name'];   
                            $img_error = $_FILES['Image']['error']; 
                            if($img_error === 0){
                            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                            $img_ex_to_lc = strtolower($img_ex);
                            $allowed_exs = array('jpg','png','jpeg');
                            if(in_array($img_ex_to_lc, $allowed_exs)){
                            $new_img_name = uniqid("$name", true).'.'.$img_ex_to_lc;
                            $img_upload_path = './uploads/'.$new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path); 
                        
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
                        
                        

                            // Pritection against SQL injections.
                            $name = stripslashes($name);
                            $department = stripslashes($department);
                            $regNumber = stripslashes($regNumber);
                            $category = stripslashes($category);
                            $name = mysqli_real_escape_string($conn, $name);
                            $department = mysqli_real_escape_string($conn, $department);
                            $regNumber = mysqli_real_escape_string($conn, $regNumber);
                            $category = mysqli_real_escape_string($conn, $category);
                            $password = mysqli_real_escape_string($conn, $password);

                            if(empty($name) || empty($department) || empty($regNumber) || empty($category) || empty($password) || empty($img_name)){

                            echo "<center>" . "<div class='alert alert-danger'
                            style='background:transparent;border:2px solid red; color:red;padding:7px'>" . 
                            "All input fields are required!." . "</div>" . "</center>";

                            }elseif($password = "password"){

                                    $query = "SELECT regNumber FROM `student` WHERE regNumber = ?";
                                    $stmt = mysqli_stmt_init($conn);
                                    if(!mysqli_stmt_prepare($stmt, $query)) {

                                        die("Failed to connect");

                                    }else{

                                        mysqli_stmt_bind_param($stmt, "s", $regNumber);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_store_result($stmt);
                                        $rowCount = mysqli_stmt_num_rows($stmt);
                                        if($rowCount > 0) {

                                        echo "<center>" . "<div class='alert alert-danger'
                                        style='background:transparent;border:2px solid red; color:red;padding:7px'>" . 
                                        "The registration number `".$regNumber."` already exist." . "</div>" . "</center>";
                                            
                                    }else{

                                    $sql = "INSERT INTO `student` (studentName, department, regNumber, category, Image, password)
                                    VALUES ('$name', '$department', '$regNumber', '$category','$new_img_name', '$password')";
                                    
                                // redirecting to login
                                    $result = mysqli_query($conn, $sql);
                                    echo "<script type=\"text/javascript\">
                                    window.alert(\"Student registered successfull!\")
                                    </script>";

                                        }

                                    }
                            
                                
                                
                                    mysqli_stmt_close($stmt);
                                    mysqli_close($conn);
                                }else{

                                    echo "<center>" . "<div class='alert alert-danger'
                                    style='background:transparent;border:2px solid red; color:red;padding:7px'>" . 
                                    " Default password for student must only be  \"password\" " . "</div>" . "</center>";
                                }
                        
                            
                        }
                        ?>
                        <br>
                        <br>

                        <form action="student_register.php" method="post" enctype="multipart/form-data">
                        
                        <div class="form-group">

                        
                        <input type="text" class="form-check form-control bg-transparent text-light"
                        placeholder="Student's name" style="border: 3px solid blue" name="name"> 
                        <br>
                        <input type="text" class="form-check form-control bg-transparent text-light"
                        placeholder="Department" style="border: 3px solid blue" name="department"> 
                        <br>

                        <input type="text" class="form-check form-control bg-transparent text-light"
                        placeholder="Reg Number" style="border: 3px solid blue" name="regNumber"> 
                        
                        <br>
                        <input type="text" class="form-check form-control bg-transparent text-light"
                        placeholder="Category" style="border: 3px solid blue" name="category"> 
                        <br>
                        <input type="password" class="form-check form-control bg-transparent text-light"
                        placeholder="Password" style="border: 3px solid blue" name="password"> 
                        <br>
                    <label for="image" class="text-light" style="margin-left: -28rem">Upload Student's Image</label>
                    <br>
                    <br>
                        <input type="file" class="form-check form-control" name="Image"> 
                        <br>
                        
                        <input type="submit" value="Add Student" class="btn btn-primary w-50" name="proceed">
                        <br>
                        <br>
                        <p class="lead text-light">Back to 
                        
                        <a href="Staffs_Dashboard.php" class="text-decoration-none">Staff Dashboard</a>
                        </p>
                        
                        </div>
                        
                        </form>
                        
                        </div>
                        <div class="col-md-3"></div>
                        </div>
                        </div>
                        
                        
                        </form>

                        <div>
                    </section>

                    </section> 
                    <!-- footer section -->
                    <section> 
                    <footer class="text-center text-light p-2" style="background:rgb(63, 5, 5);">
                    <p class="">Copyright &copy; 2022 Alrights reserved</p>
                    </footer>
                    </section> 

                    </body>
                    </html>