<?php
include_once("db_con.php");
if(!isset($_SESSION)){
session_start();
}
if(isset($_SESSION["stuLogin"])){
    $stu_email = $_SESSION['email'];

    // Fetch student details from database
    $stmt = $conn->prepare("SELECT * FROM student WHERE stu_email = :stu_email");
    $stmt->bindParam(':stu_email', $stu_email);
    $stmt->execute();

    // Check if a record exists
    if($stmt->rowCount() > 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stu_img = $result['stu_img'];
        $stu_name=$result['stu_name'];
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../student\css\style.css">
</head>
<body>
<header>
    <div class="logo"><a href="#">SkillyEarn</a></div>
    <div class="panel">Student pannel</div>
    <div class="profile-img"><img src="<?php if(isset($stu_img)) echo $stu_img;?>" alt="<?php if(isset($stu_name)) echo $stu_name?>"></div>
    <a href="../logout.php">Logout</a>
</header>
</body>
</html>