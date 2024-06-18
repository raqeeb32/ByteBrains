<link rel="stylesheet" href="../css/style.css">
<?php
// include_once("header.php");
// include_once("left.php");
include_once("db_con.php");

if(isset($_GET['lessonId'])){
    $id = $_GET['lessonId'];
    $get_course = $conn->prepare("SELECT * FROM lessons WHERE l_id=?");
    $get_course->execute([$id]);
    $row = $get_course->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="right">
    <div class="addCourse">
        <h3>Edit Lesson</h3>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <label>Lesson Name</label>
                <input type="text" name="lesson_name" value="<?php echo $row['l_name']; ?>">
            </div>
            <div class="row">
                <label>Lesson link</label>
                <input type="text" name="lesson_link" value="<?php echo $row['l_link']; ?>">
            </div>
            <div class="row">
                <label>duration</label>
                <input type="text" name="lesson_duration" value="<?php echo $row['l_duration']; ?>">
            </div>

            <div class="row">
                <label>Course id</label>
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
                <button name="editLessonbtn" id="addCourse">Update</button>
                <button id="closebtn"><a href="../index.php?courses">Close</a></button>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST["editLessonbtn"])) {

    $lesson_name = $_POST["lesson_name"];
    $lesson_link = $_POST["lesson_link"];
    $lesson_duration = $_POST["lesson_duration"];
    $ch_id = $_POST["chapter_id"]; 
   
    $upCourse = $conn->prepare("UPDATE lessons SET l_name=?, l_link=?, l_duration=?, ch_id=? WHERE l_id=?");
    if ($upCourse->execute([$lesson_name, $lesson_link, $lesson_duration, $ch_id, $id])) {
        echo "<script>alert('Lesson updated successfully');</script>";
      
    } else {
        echo "<script>alert('Lesson could not be updated');</script>";
    }
    echo "<script>window.open('../index.php?courses','_self')</script>";
}
?>
