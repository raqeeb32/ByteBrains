<link rel="stylesheet" href="../css/style.css">
<?php
include_once("db_con.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $get_course = $conn->prepare("SELECT * FROM course WHERE course_id=?");
    $get_course->execute([$id]);
    $row = $get_course->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="right">
    <div class="addCourse">
        <h3>Edit course</h3>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <label for="courseName">Course Name</label>
                <input type="text" name="course_name" value="<?php echo $row['course_name']; ?>" required>
            </div>
            <div class="row">
                <label>Category</label>
                <select name="category_id" required>
                    <?php
                    $get_categories = $conn->prepare("SELECT * FROM categories");
                    $get_categories->setFetchMode(PDO::FETCH_ASSOC);
                    $get_categories->execute();
                    while ($cat_row = $get_categories->fetch()) {
                        $selected = ($cat_row['category_ID'] == $row['category_ID']) ? 'selected' : '';
                        echo "<option value='" . $cat_row['category_ID'] . "' $selected>" . $cat_row['categoryName'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row">
                <label>Course Description</label>
                <textarea name="course_desc" required><?php echo $row['course_desc']; ?></textarea>
            </div>
            <div class="row">
                <label>Course Duration</label>
                <input type="text" name="course_duration" value="<?php echo $row['course_duration']; ?>" required>
            </div>
            <div class="row">
                <label>Course original price</label>
                <input type="number" name="course_OP" value="<?php echo $row['course_org_price']; ?>" required>
            </div>
            <div class="row">
                <label>Course selling price</label>
                <input type="number" name="course_SP" value="<?php echo $row['course_price']; ?>" required>
            </div>
            <div class="row">
                <label>Course image</label>
                <input type="file" name="course_Img">
                <?php if(isset($row['course_img'])) { ?>
                    <img src="../<?php echo $row['course_img']; ?>" alt="Course Image" style="max-width: 200px; max-height: 200px;">
                <?php } ?>
            </div>
            <div class="row">
                <label>Language</label>
                <select name="course_language" required>
                    <?php
                    $get_languages = $conn->prepare("SELECT * FROM lang");
                    $get_languages->setFetchMode(PDO::FETCH_ASSOC);
                    $get_languages->execute();
                    while ($lang_row = $get_languages->fetch()) {
                        $selected = ($lang_row['lang_name'] == $row['language']) ? 'selected' : '';
                        echo "<option value='" . $lang_row['lang_name'] . "' $selected>" . $lang_row['lang_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row">
                <label>What will they learn</label>
                <textarea name="what_will_you_learn" required><?php echo $row['what_will_you_learn']; ?></textarea>
            </div>
            <div class="row">
                <label>Requirements</label>
                <textarea name="requirements" required><?php echo $row['requirements']; ?></textarea>
            </div>
            <div class="btns">
                <button type="submit" name="editCoursebtn" id="addCourse">Update</button>
                <button id="closebtn"><a href="../index.php?courses">Close</a></button>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST["editCoursebtn"])) {
    $course_name = $_POST["course_name"];
    $category_id = $_POST['category_id'];
    $course_desc = $_POST["course_desc"];
    $course_duration = $_POST["course_duration"];
    $course_OP = $_POST["course_OP"];
    $course_SP = $_POST["course_SP"];
    $language = $_POST['course_language'];
    $what_will_you_learn = $_POST['what_will_you_learn'];
    $requirements = $_POST['requirements'];
    
    // Handle file upload if a new image is selected
    if ($_FILES['course_Img']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["course_Img"]["tmp_name"];
        $course_img = '../images/courseimg/'. $_FILES["course_Img"]["name"]; // Define the image path
        $img_select = 'images/courseimg/'. $_FILES["course_Img"]["name"];
        move_uploaded_file($tmp_name, $course_img); // Move the uploaded file to the specified path
    } else {
        // No new image selected, retain the existing one
        $img_select = $row['course_img'];
    }
    
    // Update course details including the image URL
    $upCourse = $conn->prepare("UPDATE course SET course_name=?, category_ID=?, course_desc=?, course_duration=?, course_org_price=?, course_price=?, course_img=?, language=?, what_will_you_learn=?, requirements=? WHERE course_id=?");
    if ($upCourse->execute([$course_name, $category_id, $course_desc, $course_duration, $course_OP, $course_SP, $img_select, $language, $what_will_you_learn, $requirements, $id])) {
        echo "<script>alert('Course updated successfully');</script>";
    } else {
        echo "<script>alert('Course could not be updated');</script>";
    }
    echo "<script>window.open('../index.php?courses','_self')</script>";
}
?>
