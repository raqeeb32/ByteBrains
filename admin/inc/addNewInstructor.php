<?php
if(!isset($_SESSION)){
    session_start();
 }
 if(isset($_SESSION["adminLogin"])){
include("db_con.php");
if(isset($_POST['addInstBtn'])){
    if($_POST['inst_name']!= '' || $_POST['inst_email']!= '' || $_POST['inst_pass']!= '' || $_POST['bio']!= '' || $_POST['specialization']!= '' || $_POST['inst_Img']!= ''){
        $inst_name=$_POST['inst_name'];
        $inst_email=$_POST['inst_email'];
        $inst_pass=$_POST['inst_pass'];
        $bio=$_POST['bio'];
        $specialization=$_POST['specialization'];

        $inst_Img=$_FILES['inst_Img']['name'];//getting image
        $inst_Img_temp=$_FILES['inst_Img']['tmp_name'];//storing in temp var
        $img_folder = 'instIMG/'.$inst_Img; //folder to store
        move_uploaded_file($inst_Img_temp,$img_folder);//storing into the folder
        $img_select=$inst_Img;

        $sql = $conn->prepare('INSERT INTO instructor (name,email,password,bio,specialization,photo) VALUES (:inst_name, :inst_email,:inst_pass,:bio,:specialization,:img_folder);');
        $sql->bindParam(':inst_name', $inst_name);
        $sql->bindParam(':inst_email', $inst_email);
        $sql->bindParam(':inst_pass', $inst_pass);
        $sql->bindParam(':bio', $bio);
        $sql->bindParam(':specialization', $specialization);
        $sql->bindParam(':img_folder', $img_select);
        
        $result = $sql->execute();
        if ($result) {
            echo '<script>alert("Instructor added successfully");</script>';
            // header('location:../index.php?courses.php');
            echo "<script>window.open('../index.php?instructors','_self')</script>";
            exit();
        } else {
            echo '<script>alert("Error creating instructor");</script>';
            // Output the actual error message for debugging purposes
            echo "Error: " . $sql->errorInfo()[2];
        }
        
       
    }
    else{
        echo'<script>alert("Fill all details");</script>';

    }
}
 }
 else{
    header('location:../index.php');
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style2.css">
    <script src="https://kit.fontawesome.com/c25eb3470e.js" crossorigin="anonymous"></script>

</head>
<body>
<?php
// include_once("header.php");
// include_once("bodyLeft.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style2.css">
    <script src="https://kit.fontawesome.com/c25eb3470e.js" crossorigin="anonymous"></script>

</head>
<body>
<?php
// include_once("header.php");
// include_once("bodyLeft.php");
?>
<div class="right">
    <div class="addCourse">
    <h3>Add new Instructor</h3>
    <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <label>Name</label>
                <input type="text" name="inst_name">
            </div>
            <div class="row">
                <label>Email</label>
                <input type="email" name="inst_email">
            </div>
            <div class="row">
                <label>Password</label>
                <input type="password" name="inst_pass">
            </div>
            <div class="row">
                <label>Bio</label>
                <input type="text" name="bio">
            </div>
            <div class="row">
                <label>Specialization</label>
                <input type="text" name="specialization">
            </div>
            <div class="row">
                <label>Profile photo</label>
                <input type="file" name="inst_Img">
            </div>
            <div class="btns">
                <button name="addInstBtn" id="addCourse">Add</button>
                <button id="closebtn"><a href="../index.php?instructors">Close</a></button>
            </div>
         </form>
    </div>
    
</div>
</body>
</html>