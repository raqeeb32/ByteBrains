<?php
include("db_con.php");
if(isset($_POST['addchapterbtn'])){
    if($_POST['chapter_name']!= '' && $_POST['duration']!= ''&& $_POST['course_id']!= ''){
        $chapter_name=$_POST['chapter_name'];
        $duration=$_POST['duration'];
        $course_id=$_POST['course_id'];
        $sql = $conn->prepare('INSERT INTO chapter (ch_name, duration, course_id) VALUES (:chapter_name, :duration,:course_id);');
        $sql->bindParam(':chapter_name', $chapter_name);
        $sql->bindParam(':duration', $duration);
        $sql->bindParam(':course_id', $course_id); 

        
        $result = $sql->execute();
        if ($result) {
            echo '<script>alert("Chapter created successfully");</script>';
            // header('location:../index.php?courses.php');
            echo "<script>window.open('../index.php?courses','_self')</script>";
            exit();
        } else {
            echo '<script>alert("Error creating chapter");</script>';
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
    <h3>Add new chapter</h3>
    <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <label>Chapter Name</label>
                <input type="text" name="chapter_name">
            </div>
            <div class="row">
                <label>Duration</label>
                <input type="text" name="duration">
            </div> 
            <div class="row">
                <label>Course id</label>
            <select name="course_id">
                <?php
                    include_once("inc/db_con.php");
                    $get_cat = $conn->prepare("SELECT * FROM course");
                    $get_cat->setFetchMode(PDO::FETCH_ASSOC);
                    $get_cat->execute();
                    while ($row = $get_cat->fetch()) {
                        echo "<option value='" . $row['course_id'] . "'>" . $row['course_name'] . "</option>";
                    }
                 ?>
                
               </select>
            </div>
            <div class="btns">
                <button name="addchapterbtn" id="addCourse">Add</button>
                <button id="closebtn"><a href="../index.php?courses">Close</a></button>
            </div>
         </form>
    </div>
    
</div>
</body>
</html>

