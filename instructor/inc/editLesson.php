<link rel="stylesheet" href="../css/style.css">
<?php
include_once("db_con.php");

if(isset($_GET['lessonId'])){
    $id = $_GET['lessonId'];
    $get_lesson = $conn->prepare("SELECT * FROM lessons WHERE l_id=?");
    $get_lesson->execute([$id]);
    $row = $get_lesson->fetch(PDO::FETCH_ASSOC);
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
                <label>Lesson Link</label>
                <input type="file" name="lesson_link">
                <?php if(isset($row['l_link'])) { ?>
                    <?php echo $row['l_link']; ?>
                <?php } ?>
            </div>
            <div class="row">
                <label>Duration</label>
                <input type="text" name="lesson_duration" value="<?php echo $row['l_duration']; ?>">
            </div>
            <div class="row">
                <label>Chapter</label>
                <select name="chapter_id" required>
                    <?php
                    $get_chapters = $conn->prepare("SELECT * FROM chapter");
                    $get_chapters->setFetchMode(PDO::FETCH_ASSOC);
                    $get_chapters->execute();
                    while ($chapter_row = $get_chapters->fetch()) {
                        $selected = ($chapter_row['ch_id'] == $row['ch_id']) ? 'selected' : '';
                        echo "<option value='" . $chapter_row['ch_id'] . "' $selected>" . $chapter_row['ch_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="btns">
                <button type="submit" name="editLessonbtn" id="addCourse">Update</button>
                <button id="closebtn"><a href="../index.php?courses">Close</a></button>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST["editLessonbtn"])) {
    $lesson_name = $_POST["lesson_name"];
    $lesson_duration = $_POST["lesson_duration"];
    $chapter_id = $_POST["chapter_id"];
    $lesson_link=$_FILES["lesson_link"]["name"];
    // Handle file upload if a new video file is selected
    if ($_FILES['lesson_link']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["lesson_link"]["tmp_name"];
        $file_name = $_FILES["lesson_link"]["name"];
        $file_path = '../assets/lessonVideos/' . $file_name;
        // $link_select = $file_name;
        move_uploaded_file($tmp_name, $file_path); // Move the uploaded file to the specified path
    } else {
        // No new file selected, retain the existing one
        $link_select = $row['l_link'];
    }

    // Update lesson details in the database
    $updateLesson = $conn->prepare("UPDATE lessons SET l_name=?, l_link=?, l_duration=?, ch_id=? WHERE l_id=?");
    if ($updateLesson->execute([$lesson_name, $lesson_link, $lesson_duration, $chapter_id, $id])) {
        echo "<script>alert('Lesson updated successfully');</script>";
    } else {
        echo "<script>alert('Failed to update lesson');</script>";
    }
    echo "<script>window.open('../index.php?courses','_self')</script>";
}
?>
