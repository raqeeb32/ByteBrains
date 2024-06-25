<?php
include("db_con.php");
if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['instlogin'])){
    $ins_id = $_SESSION['inst_id'];

    $get_inst_name = $conn->prepare("SELECT * FROM instructor WHERE id=:ins_id");
    $get_inst_name->bindParam(':ins_id', $inst_id, PDO::PARAM_STR);
    $get_inst_name->execute();
    $row = $get_inst_name->fetch(PDO::FETCH_ASSOC);
    // Check if a row was returned (assuming email is unique in the instructor table)
    if($row){
        $inst_name = $row['name']; // Replace 'inst_name' with your actual column name
        // Now $inst_name contains the instructor's name
    } else {
        // Handle case where no instructor found for the given email
        $inst_name = "Instructor Name Not Found";
    }
    if(isset($_POST['addcoursebtn'])) {
        // Check if all required fields are filled
        if($_POST['course_name'] != ''  && $_POST['category_id'] != '' && $_POST['course_desc'] != '' && $_POST['course_duration'] != '' &&
           $_POST['course_OP'] != '' && $_POST['course_SP'] != '' && $_POST['course_language'] != '' &&
           !empty($_FILES['course_Img']['name']) && $_POST['what_will_you_learn'] != '' && $_POST['requirements'] != '') {
    
            // Fetch form data
            $course_name = $_POST['course_name'];
            $category_id = $_POST['category_id']; // Ensure this matches an existing category_ID in the categories table
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
            $sql = $conn->prepare('INSERT INTO course (course_name, category_ID, course_desc, course_img, course_duration, course_price, course_org_price, language, what_will_you_learn, requirements,ins_id) 
                                   VALUES (:course_name, :category_id, :course_desc, :course_img, :course_duration, :course_SP, :course_OP, :language, :what_will_you_learn, :requirements,:inst_id)');
            $sql->bindParam(':course_name', $course_name);
            $sql->bindParam(':category_id', $category_id);
            $sql->bindParam(':course_desc', $course_desc);
            $sql->bindParam(':course_img', $img_select); 
            $sql->bindParam(':course_duration', $course_duration);
            $sql->bindParam(':course_SP', $course_SP);
            $sql->bindParam(':course_OP', $course_OP);
            $sql->bindParam(':language', $language);
            $sql->bindParam(':what_will_you_learn', $what_will_you_learn);
            $sql->bindParam(':requirements', $requirements);
            $sql->bindParam(':inst_id', $ins_id);
            
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
}
else{
    header('location:../loginAndSignup.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/c25eb3470e.js" crossorigin="anonymous"></script>
    <title>Add New Course</title>
</head>
<body>
    <div class="right">
        <div class="addCourse">
            <h3>Add new course</h3>
            <form action="#" method="post" enctype="multipart/form-data" id="courseForm">
                <div class="row" hidden>
                    <label>Instructor name</label>
                    <input type="text" name="inst_name" value="<?php echo $ins_id; ?>">
                </div>
                <div class="row">
                    <label for="courseName">Course Name</label>
                    <input type="text" name="course_name" required>
                </div>
                <div class="row">
                    <label>Category</label>
                    <select name="category_id" required>
                    <?php
                    $get_categories = $conn->prepare("SELECT * FROM categories");
                    $get_categories->setFetchMode(PDO::FETCH_ASSOC);
                    $get_categories->execute();
                    while ($row = $get_categories->fetch()) {
                        echo "<option value='" . $row['category_ID'] . "'>" . $row['categoryName'] . "</option>";                    }
                    ?>    
                    </select>
                </div>
                <div class="row">
                    <label>Course Description</label>
                    <textarea name="course_desc" required></textarea>
                </div>
                <div class="row">
                    <label>Course Duration</label>
                    <input type="text" name="course_duration" required>
                </div>
                <div class="row">
                    <label>Course original price</label>
                    <input type="number" name="course_OP" required>
                </div>
                <div class="row">
                    <label>Course selling price</label>
                    <input type="number" name="course_SP" required>
                </div>
                <div class="row">
                    <label>Course image</label>
                    <input type="file" name="course_Img" required>
                </div>
                <div class="row">
                    <label>Language</label>
                    <select name="course_language" required>
                    <?php
                    $get_lang = $conn->prepare("SELECT * FROM lang");
                    $get_lang->setFetchMode(PDO::FETCH_ASSOC);
                    $get_lang->execute();
                    while ($row = $get_lang->fetch()) {
                        echo "<option value='" . $row['lang_name'] . "'>" . $row['lang_name'] . "</option>";
                    }
                    ?>    
                    </select>
                </div>
                <div class="row">
                    <label>What will they learn</label>
                    <textarea name="what_will_you_learn" required></textarea>
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
