<link rel="stylesheet" href="../css/style2.css">
<link rel="stylesheet" href="../css/style.css">
<?php
// include_once("header.php");
// include_once("bodyLeft.php");
include_once("db_con.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $get_course = $conn->prepare("SELECT * FROM instructor WHERE id=?");
    $get_course->execute([$id]);
    $row = $get_course->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="right">
    <div class="addCourse">
        <h3>Edit instructor</h3>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <label>instructor Name</label>
                <input type="text" name="inst_name" value="<?php echo $row['name']; ?>">
            </div>
            <div class="row">
                <label>Email</label>
                <input type="email" name="inst_email"value="<?php echo $row['email']; ?>">
            </div>
            <div class="row">
                <label>Password</label>
                <input type="password" name="inst_pass" value="<?php echo $row['password']; ?>">
            </div>
            <div class="row">
                <label>Bio</label>
                <input type="text" name="inst_bio" value="<?php echo $row['bio']; ?>">
            </div>
            <div class="row">
                <label>Specialization</label>
                <input type="text" name="inst_specialization" value="<?php echo $row['specialization']; ?>">
            </div>
            <div class="row">
                <label>Profile photo</label>
                <input type="file" name="inst_Img">
                <?php if(isset($row['inst_img'])) { ?>
                    <img src="<?php echo $row['photo']; ?>" alt="Instructor Image" style="max-width: 200px; max-height: 200px;">
                <?php } ?>
            </div>
            <div class="btns">
                <button name="editInstBtn" id="addCourse">Update</button>
                <button id="closebtn"><a href="../index.php?instructors">Close</a></button>
            </div>
         </form>
    </div>
</div>

<?php
if (isset($_POST["editInstBtn"])) {
    $inst_name = $_POST["inst_name"];
    $inst_email = $_POST["inst_email"];
    $inst_pass = $_POST["inst_pass"];
    $inst_bio = $_POST["inst_bio"];
    $inst_specialization = $_POST["inst_specialization"];
    $inst_Img=$_FILES["inst_Img"];
    // Handle file upload if a new image is selected
    if ($_FILES['inst_Img']['error'] == UPLOAD_ERR_OK) {
        // $stud_Img=''.$_FILES['stud_Img']['name'];
        $tmp_name = $_FILES["inst_Img"]["tmp_name"];
        $inst_Img = '../images/instructorIMG/'. $_FILES["inst_Img"]["name"]; // Define the image path
        move_uploaded_file($tmp_name, $inst_Img); // Move the uploaded file to the specified path
    } else {
        // No new image selected, retain the existing one
        $inst_Img = $row['inst_Img'];
    }
    
    // Update student details including the image URL
    $upCourse = $conn->prepare("UPDATE instructor SET name=?,email=?, password=?,bio=?,specialization=?, photo=? WHERE id=? ");
    if ($upCourse->execute([$inst_name, $inst_email, $inst_pass,$inst_bio,$inst_specialization, $inst_Img, $id])) {
        echo "<script>alert('Instructor updated successfully');</script>";
    } else {
        echo "<script>alert('Instructor could not be updated');</script>";
    }
    echo "<script>window.open('../index.php?instructors','_self')</script>";
}
?>
