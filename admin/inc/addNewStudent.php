<?php
if(!isset($_SESSION)){
    session_start();
 }
 if(isset($_SESSION["adminLogin"])){
include("db_con.php");
if(isset($_POST['addStuBtn'])){
    if($_POST['stud_name']!= '' || $_POST['stud_email']!= '' || $_POST['stud_pass']!= '' || $_POST['stud_Img']!= '' || $_POST['stud_occ']!= ''){
        $stud_name=$_POST['stud_name'];
        $stud_email=$_POST['stud_email'];
        $stud_pass=$_POST['stud_pass'];
        $stud_occ=$_POST['stud_occ'];
        $stud_Img=$_FILES['stud_Img']['name'];//getting image
        $stud_Img_temp=$_FILES['stud_Img']['tmp_name'];//storing in temp var
        $img_folder = 'stdIMG/'.$stud_Img; //folder to store
        move_uploaded_file($stud_Img_temp,$img_folder);//storing into the folder

        $sql = $conn->prepare('INSERT INTO student (stu_name,stu_email,stu_pass,stu_img,stu_occ) VALUES (:stud_name, :stud_email,:stud_pass,:img_folder,:stud_occ);');
        $sql->bindParam(':stud_name', $stud_name);
        $sql->bindParam(':stud_email', $stud_email);
        $sql->bindParam(':stud_pass', $stud_pass);
        $sql->bindParam(':img_folder', $img_folder);
        $sql->bindParam(':stud_occ', $stud_occ);
        
        $result = $sql->execute();
        if ($result) {
            echo '<script>alert("Student added successfully");</script>';
            // header('location:../index.php?courses.php');
            echo "<script>window.open('../index.php?students','_self')</script>";
            exit();
        } else {
            echo '<script>alert("Error creating student");</script>';
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
    <h3>Add new student</h3>
    <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <label for="courseName">Student Name</label>
                <input type="text" name="stud_name">
            </div>
            <div class="row">
                <label>Email</label>
                <input type="email" name="stud_email">
            </div>
            <div class="row">
                <label>Password</label>
                <input type="password" name="stud_pass">
            </div>
            <div class="row">
                <label>Profile photo</label>
                <input type="file" name="stud_Img">
            </div>
            <div class="row">
                <label>Occupation</label>
                <input type="text" name="stud_occ">
            </div>
            <div class="btns">
                <button name="addStuBtn" id="addCourse">Add</button>
                <button id="closebtn"><a href="../index.php?students">Close</a></button>
            </div>
         </form>
    </div>
    
</div>
</body>
</html>