<?php
 if(!isset($_SESSION)){
    session_start();
 }
 ?>
<link rel="stylesheet" href="../css/style2.css">
<link rel="stylesheet" href="../css/style.css">
<?php
// include_once("header.php");
// include_once("bodyLeft.php");
if($_SESSION['adminLogin']){

}else{
    echo "<script>window.open('../index.php?students','_self')</script>";
}
include_once("db_con.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $get_course = $conn->prepare("SELECT * FROM student WHERE stu_id=?");
    $get_course->execute([$id]);
    $row = $get_course->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="right">
    <div class="addCourse">
        <h3>Edit Student</h3>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <label>Student Name</label>
                <input type="text" name="stud_name" value="<?php echo $row['stu_name']; ?>">
            </div>
            <div class="row">
                <label>Email</label>
                <input type="email" name="stud_email"value="<?php echo $row['stu_email']; ?>">
            </div>
            <div class="row">
                <label>Password</label>
                <input type="password" name="stud_pass" value="<?php echo $row['stu_pass']; ?>">
            </div>
            <div class="row">
                <label>Profile photo</label>
                <input type="file" name="stud_Img">
                <?php if(isset($row['stu_img'])) { ?>
                    <img src="<?php echo $row['stu_img']; ?>" alt="student Image" style="max-width: 200px; max-height: 200px;">
                <?php } ?>
            </div>
            <div class="btns">
                <button name="editStudBtn" id="addCourse">Update</button>
                <button id="closebtn"><a href="../index.php?students">Close</a></button>
            </div>
         </form>
    </div>
</div>

<?php
if (isset($_POST["editStudBtn"])) {
    $stud_name = $_POST["stud_name"];
    $stud_email = $_POST["stud_email"];
    $stud_pass = $_POST["stud_pass"];
    $stud_Img=$_POST["stud_Img"];
    // Handle file upload if a new image is selected
    if ($_FILES['stud_Img']['error'] == UPLOAD_ERR_OK) {
        // $stud_Img=''.$_FILES['stud_Img']['name'];
        $tmp_name = $_FILES["stud_Img"]["tmp_name"];
        $stud_Img = 'stdIMG/'.$_FILES["stud_Img"]["name"]; // Define the image path
        move_uploaded_file($tmp_name, $stud_Img); // Move the uploaded file to the specified path
    } else {
        // No new image selected, retain the existing one
        $stud_Img = $row['stud_Img'];
    }
    
    // Update student details including the image URL
    $upCourse = $conn->prepare("UPDATE student SET stu_name=?, stu_email=?, stu_pass=?, stu_img=? WHERE stu_id=? ");
    if ($upCourse->execute([$stud_name, $stud_email, $stud_pass, $stud_Img, $id])) {
        echo "<script>alert('Student updated successfully');</script>";
    } else {
        echo "<script>alert('Student could not be updated');</script>";
    }
    echo "<script>window.open('../index.php?students','_self')</script>";
}
?>
