<?php
include("db_con.php");
if(isset($_POST['addLessonbtn'])){

    if($_POST['lesson_name']!= '' && $_FILES['lesson_link']!= '' && $_POST['lesson_duration']!= '' && $_POST['chapter_id']!= ''){
        $lesson_name = $_POST['lesson_name'];
        $lesson_duration = $_POST['lesson_duration'];
        $chapter_id = $_POST['chapter_id'];
        $lesson_link = $_FILES['lesson_link']['name'];

        $lesson_link_temp = $_FILES['lesson_link']['tmp_name'];
        $lesson_folder = '../assets/lessonVideos/'.$lesson_link;
        move_uploaded_file($lesson_link_temp, $lesson_folder);

        $sql = $conn->prepare('INSERT INTO lessons (l_name, l_link, l_duration, ch_id) VALUES (:lesson_name, :lesson_link, :lesson_duration, :chapter_id)');
        $sql->bindParam(':lesson_name', $lesson_name);
        $sql->bindParam(':lesson_link', $lesson_link);
        $sql->bindParam(':lesson_duration', $lesson_duration); 
        $sql->bindParam(':chapter_id', $chapter_id);
        
        if ($sql->execute()) {
            header('Location: ../index.php?courses');
            exit();
        } else {
            echo '<script>alert("Error creating lesson");</script>';
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
<div class="right">
    <div class="addCourse">
    <h3>Add new lesson</h3>
    <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <label>Lesson Name</label>
                <input type="text" name="lesson_name">
            </div>
            <div class="row">
                <label>Lesson link</label>
                <input type="file" name="lesson_link">
            </div>
            <div class="row">
                <label>Lesson Duration</label>
                <input type="text" name="lesson_duration">
            </div>
            
            <div class="row">
                <label>Chapter</label>
                <select name="chapter_id" required>
                    <?php
                        include_once("db_con.php");
                        $get_cat = $conn->prepare("SELECT * FROM chapter");
                        $get_cat->setFetchMode(PDO::FETCH_ASSOC);
                        $get_cat->execute();
                        while ($row = $get_cat->fetch()) {
                            echo "<option value='" . $row['ch_id'] . "'>" . $row['ch_name'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="btns">
                <button type="submit" name="addLessonbtn" id="addCourse">Add</button>
                <button id="closebtn"><a href="../index.php?courses">Close</a></button>
            </div>
         </form>
    </div>
</div>
</body>
</html>
