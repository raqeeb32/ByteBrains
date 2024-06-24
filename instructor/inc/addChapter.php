<?php
include("db_con.php");

if(isset($_POST['addchapterbtn'])){
    // Check if all required fields are filled
    if($_POST['chapter_name'] != '' && $_POST['duration'] != '' && $_POST['course_id'] != ''){
        $chapter_name = $_POST['chapter_name'];
        $duration = $_POST['duration'];
        $course_id = $_POST['course_id'];
        
        // Prepare SQL statement with named parameters
        $sql = $conn->prepare('INSERT INTO chapter (ch_name, duration, course_id) VALUES (:chapter_name, :duration, :course_id)');
        $sql->bindParam(':chapter_name', $chapter_name);
        $sql->bindParam(':duration', $duration);
        $sql->bindParam(':course_id', $course_id);

        // Execute SQL query
        $result = $sql->execute();
        
        // Check if query was successful
        if ($result) {
            echo '<script>alert("Chapter created successfully");</script>';
            echo "<script>window.open('../index.php?courses','_self')</script>";
            exit();
        } else {
            // Output the actual error message for debugging purposes
            echo '<script>alert("Error creating chapter");</script>';
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
    <title>Add New Chapter</title>
</head>
<body>
    <div class="right">
        <div class="addCourse">
            <h3>Add new chapter</h3>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="row">
                    <label>Chapter Name</label>
                    <input type="text" name="chapter_name" required>
                </div>
                <div class="row">
                    <label>Duration</label>
                    <input type="text" name="duration" required>
                </div> 
                <div class="row">
                    <label>Course</label>
                    <select name="course_id" required>
                        <?php
                        // Fetch courses from database
                        $get_courses = $conn->prepare("SELECT * FROM course");
                        $get_courses->setFetchMode(PDO::FETCH_ASSOC);
                        $get_courses->execute();
                        // Display options for courses
                        while ($row = $get_courses->fetch()) {
                            echo "<option value='" . $row['course_id'] . "'>" . $row['course_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="btns">
                    <button type="submit" name="addchapterbtn" id="addCourse">Add</button>
                    <button id="closebtn"><a href="../index.php?courses">Close</a></button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
