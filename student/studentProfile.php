<?php
include("stuInc/db_con.php");
if(!isset($_SESSSION)){
    session_start();
}
include("stuInc/header.php");
include("stuInc/side.php");
if(isset($_SESSION["stuLogin"])){
    $stu_email = $_SESSION['email'];

    // Fetch student details from database
    $stmt = $conn->prepare("SELECT * FROM student WHERE stu_email = :stu_email");
    $stmt->bindParam(':stu_email', $stu_email);
    $stmt->execute();

    // Check if a record exists
    if($stmt->rowCount() == 1) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stu_img = $result['stu_img'];
        
        // Additional variables from $result can be accessed here
    } else {
        // Handle case where no record was found for the logged in student
        echo '<script>location.href="../index.php";</script>';
        exit; // Exit to prevent further execution
    }
} else {
    // Redirect if student is not logged in
    echo '<script>location.href="../index.php";</script>';
    exit; // Exit to prevent further execution
}
?>