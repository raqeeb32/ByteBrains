<?php
include("db_con.php");
if(isset($_POST['addcoursebtn'])){
    if($_POST['course_name']!= '' || $_POST['course_desc']!= '' || $_POST['course_duration']!= '' || $_POST['course_OP']!= '' || $_POST['course_SP']!= '' || $_POST['course_Img']!= ''){
        $course_name=$_POST['course_name'];
        $course_desc=$_POST['course_desc'];
        $course_duration=$_POST['course_duration'];
        $course_OP=$_POST['course_OP'];
        $course_SP=$_POST['course_SP'];

        $course_Img=$_FILES['course_Img']['name'];//getting image
        $course_Img_temp=$_FILES['course_Img']['tmp_name'];//storing in temp var
        $img_folder = '../images/courseimg/'.$course_Img; //folder to store
        $img_select='images/courseimg/'.$course_Img;
        move_uploaded_file($course_Img_temp,$img_folder);//storing into the folder

        $sql = $conn->prepare('INSERT INTO course (course_name, course_desc, course_img, course_duration, course_price, course_org_price) VALUES (:course_name, :course_desc,:img_select, :course_duration, :course_SP, :course_OP);');
        $sql->bindParam(':course_name', $course_name);
        $sql->bindParam(':course_desc', $course_desc);
        $sql->bindParam(':img_select', $img_select); 
        $sql->bindParam(':course_duration', $course_duration);
        $sql->bindParam(':course_SP', $course_SP);
        $sql->bindParam(':course_OP', $course_OP);
        
        $result = $sql->execute();
        if ($result) {
            echo '<script>alert("Course created successfully");</script>';
            // header('location:../index.php?courses.php');
            echo "<script>window.open('../index.php?courses','_self')</script>";
            exit();
        } else {
            echo '<script>alert("Error creating course");</script>';
            // Output the actual error message for debugging purposes
            echo "Error: " . $sql->errorInfo()[2];
        }
        
       
    }
    else{
        echo'<script>alert("Fill all details");</script>';

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/c25eb3470e.js" crossorigin="anonymous"></script>

</head>
<body>
<?php
// include_once("header.php");
// include_once("left.php");
?>
<div class="right">
    <div class="addCourse">
    <h3>Add new course</h3>
    <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <label for="courseName">Course Name</label>
                <input type="text" name="course_name">
            </div>
           
            <div class="row">
                <label>Course Description</label>
               <textarea name="course_desc"></textarea>
            </div>
            <div class="row">
                <label>Course Duration</label>
                <input type="text" name="course_duration">
            </div>
            
            <div class="row">
                <label>Course original price</label>
                <input type="number" name="course_OP">
            </div>
            <div class="row">
                <label>Course selling price</label>
                <input type="number" name="course_SP">
            </div>
            <div class="row">
                <label>Course image</label>
                <input type="file" name="course_Img">
            </div>
            <div class="btns">
                <button name="addcoursebtn" id="addCourse">Add</button>
                <button id="closebtn"><a href="../index.php?courses">Close</a></button>
            </div>
         </form>
    </div>
    
</div>
</body>
</html>

