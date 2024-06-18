<link rel="stylesheet" href="../css/style.css">
<?php
// include_once("header.php");
// include_once("left.php");
include_once("db_con.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $get_course = $conn->prepare("SELECT * FROM chapter WHERE ch_id=?");
    $get_course->execute([$id]);
    $row = $get_course->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="right">
    <div class="addCourse">
        <h3>Edit chapter</h3>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <label>Chapter Name</label>
                <input type="text" name="chapter_name" value="<?php echo $row['ch_name']; ?>">
            </div>
            <div class="row">
                <label>Duration</label>
                <input type="text" name="duration" value="<?php echo $row['duration']; ?>">
            </div>

            <div class="row">
                <label>Course id</label>
            <select name="course_id" required>
                <?php
                    include_once("db_con.php");
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
                <button name="editChapterbtn" id="addCourse">Update</button>
                <button id="closebtn"><a href="../index.php?courses">Close</a></button>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST["editChapterbtn"])) {
    $chapter_name = $_POST["chapter_name"];
    $duration = $_POST["duration"];
    $course_id = $_POST["course_id"]; 
   
    $upCourse = $conn->prepare("UPDATE chapter SET ch_name=?, duration=?, course_id=? WHERE ch_id=? ");
    if ($upCourse->execute([$chapter_name,$duration,$course_id, $id])) {
        echo "<script>alert('chapter updated successfully');</script>";
    } else {
        echo "<script>alert('chapter could not be updated');</script>";
    }
    echo "<script>window.open('../index.php?courses','_self')</script>";
}
?>
