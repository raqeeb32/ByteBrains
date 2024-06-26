<?php
include_once("inc/db_con.php");

// Start session
session_start();

// Redirect if user is not logged in
if(!isset($_SESSION["stuLogin"])){
    header('location: courses.php');
    exit; // Always add exit or die after header redirection
}

// Process course purchase
if(isset($_GET["purchase_course_id"])){
    $purchase_course_id = $_GET["purchase_course_id"];
    $stud_id = $_SESSION['stu_id'];  
   echo '<script> alert(' . $purchase_course_id . '); </script>';
    // Get current timestamp
    $current_time = date("Y-m-d H:i:s");

    // Prepare SQL statement
    $enroll = $conn->prepare("INSERT INTO enrollment (stu_id, course_p_id, purchase_time) VALUES (:stud_id, :purchase_course_id, :time)");
    $enroll->bindParam(':stud_id', $stud_id);
    $enroll->bindParam(':purchase_course_id', $purchase_course_id);
    $enroll->bindParam(':time', $current_time);

    // Execute SQL statement
    if($enroll->execute()){
        echo '<script>alert("Course purchased successfully!");</script>';
        echo '<script>window.open("course_detail.php?course_id='.$purchase_course_id.'","_self");</script>';
    } else {
        echo '<script>alert("Failed to purchase course.");</script>';
        echo '<script>window.open("courses.php","_self");</script>';
    }
}
?>
