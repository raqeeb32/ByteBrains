<?php
include("db_con.php");

if(isset($_POST['addcoursebtn'])) {
    // Check if all required fields are filled
    if($_POST['course_name'] != '' && $_POST['course_desc'] != '' && $_POST['course_duration'] != '' &&
       $_POST['course_OP'] != '' && $_POST['course_SP'] != '' && $_POST['course_language'] != '' &&
       !empty($_FILES['course_Img']['name']) && $_POST['what_will_you_learn'] != '' && $_POST['requirements'] != '') {

        // Fetch form data
        $course_name = $_POST['course_name'];
        $course_desc = $_POST['course_desc'];
        $course_duration = $_POST['course_duration'];
        $course_OP = $_POST['course_OP'];
        $course_SP = $_POST['course_SP'];
        $language = $_POST['course_language'];
        $what_will_you_learn = $_POST['what_will_you_learn'];
        $requirements = $_POST['requirements'];

        // File upload handling
        $course_Img = $_FILES['course_Img']['name']; // Getting image name
        $course_Img_temp = $_FILES['course_Img']['tmp_name']; // Storing in temp var
        $img_folder = '../images/courseimg/' . $course_Img; // Folder to store
        $img_select = 'images/courseimg/' . $course_Img;
        
        // Move uploaded file to destination folder
        move_uploaded_file($course_Img_temp, $img_folder);

        // Prepare SQL statement to insert course information
        $sql = $conn->prepare('INSERT INTO course (course_name, course_desc, course_img, course_duration, course_price, course_org_price,language,what_will_you_learn,requirements) 
                               VALUES (:course_name, :course_desc, :img_select, :course_duration, :course_SP, :course_OP, :language,:what_will_you_learn,:requirements)');
        $sql->bindParam(':course_name', $course_name);
        $sql->bindParam(':course_desc', $course_desc);
        $sql->bindParam(':img_select', $img_select); 
        $sql->bindParam(':course_duration', $course_duration);
        $sql->bindParam(':course_SP', $course_SP);
        $sql->bindParam(':course_OP', $course_OP);
        $sql->bindParam(':language', $language);
        $sql->bindParam(':what_will_you_learn', $what_will_you_learn);
        $sql->bindParam(':requirements', $requirements);
        
        // Execute the SQL statement
        $result = $sql->execute();     
        // Check if everything was inserted successfully
        if ($result) {
            echo '<script>alert("Course created successfully");</script>';
            echo "<script>window.open('../index.php?courses','_self')</script>";
            exit();
        } else {
            echo '<script>alert("Error creating course");</script>';
            // Output the actual error message for debugging purposes
            echo "Error: " . $sql->errorInfo()[2];
        }
    } else {
        echo '<script>alert("Fill all details");</script>';
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
        <form action="#" method="post" enctype="multipart/form-data" id="courseForm">
            <div class="row">
                <label for="courseName">Course Name</label>
                <input type="text" name="course_name" required>
            </div>
           
            <div class="row">
                <label>Course Description</label>
                <textarea name="course_desc"required></textarea>
            </div>
            <div class="row">
                <label>Course Duration</label>
                <input type="text" name="course_duration"required>
            </div>
            
            <div class="row">
                <label>Course original price</label>
                <input type="number" name="course_OP"required>
            </div>
            <div class="row">
                <label>Course selling price</label>
                <input type="number" name="course_SP"required>
            </div>
            <div class="row">
                <label>Course image</label>
                <input type="file" name="course_Img"required>
            </div>
            <div class="row">
                <label>Language</label>
                <input type="text" name="course_language"required>
            </div>
            <div class="row">
                <label>What will they learn</label>
                    <textarea name="what_will_you_learn"required></textarea>
            </div>
            <div class="row">
                <label>Requirements</label>             
                 <textarea name="requirements" required></textarea>
            </div>
            <div class="btns">
                <button name="addcoursebtn">Add</button>
                <button id="closebtn"><a href="../index.php?courses">Close</a></button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

