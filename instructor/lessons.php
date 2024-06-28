<?php
if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['instlogin'])){
    include_once("inc/db_con.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Lessons</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="right">
    <h3>Lessons</h3>
    <div class="course_table">
        <table>
            <tr>
                <th>Sl.no</th>
                <th>Name</th>
                <th>Video link</th>
                <th>Duration</th>
                <th>Actions</th>
            </tr>
            <?php
            if(isset($_GET['lessons'])){
                $chapter_id = $_GET['lessons'];
                $i = 1;
                $getCourse = $conn->prepare("SELECT * FROM `lessons` WHERE ch_id = ?");
                $getCourse->execute([$chapter_id]);
                $count = $getCourse->rowCount();
                if($count > 0){
                    while($row = $getCourse->fetch(PDO::FETCH_ASSOC)){
                        echo "
                        <tr>
                            <td>".$i++."</td>
                            <td>".$row['l_name']."</td>
                            <td>".$row['l_link']."</td>
                            <td>".$row['l_duration']."</td>
                            <td>
                                <a href='inc/editLesson.php?lessonId=".$row['l_id']."' title='Edit'>Edit</a>
                                <a style='color:red' href='lessons.php?lessons=".$chapter_id."&del_lesson=" . $row['l_id'] . "' title='Delete'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No lessons for this chapter.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No chapter selected.</td></tr>";
            }
            ?>
        </table>
    </div>
    <button class="addCbtn"><a href="inc/addLesson.php">+</a></button>
</div>
<?php
    if(isset($_GET["del_lesson"])){
        $id = $_GET['del_lesson'];  
        $del = $conn->prepare("DELETE FROM lessons WHERE l_id = ?");
        if ($del->execute([$id])) {
            echo "<script>alert('Lesson deleted successfully.');</script>";
        } else {
            echo "<script>alert('Failed to delete lesson.');</script>";
        }
        echo "<script>window.open('index.php?lessons=".$chapter_id."','_self')</script>";
    }
?>
</body>
</html>
<?php 
} else {
    echo '<script>alert("You are not authorized to view this page.");</script>';
    header('location: chapters.php');
}
?>
