<?php
// To make sure admin does not get direct access to profile without logging in. 
require 'connection.php';

 function check_admin_login($conn) //checks if the database connection is set.
{
    if(!isset($_SESSION['sessionAdminId']))
    {
        header("Location: Admin_login.php");
        exit();
        
    }
        
  }

  function check_staff_Login($conn) //checks if the database connection is set.
 {
    if(!isset($_SESSION['sessionStaffId']))
    {
        header("Location: Staff_login.php");
        exit();
        
    }
        
}

function check_student_Login($conn) //checks if the database connection is set.
{
    if(!isset($_SESSION['sessionStudentId']))
    {
        header("Location: Student_login.php");
        exit();
        
    }
        
}


