<?php
// Start or resume session
if(!$_SESSION){
    session_start();
}
if(!isset($_GET["my_courses"]) && !isset($_GET["feedback"]) ){

// Include database connection
include("db_con.php");

// Check if session email is set
if(isset($_SESSION['stuLogin']) && isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
    
    // Prepare and execute SQL query to fetch student details
    $get_details = $conn->prepare("SELECT * FROM student WHERE stu_email=?");
    $get_details->execute([$email]);
    $details = $get_details->fetch(PDO::FETCH_ASSOC);
    
    // Check if details were fetched successfully
    if($details) {
?>
    
    <div class="right">
        <h3>My profile</h3>
        <div class="profile-img">
            <img style="width: 120px; height: 120px; border-radius: 50%; border: 1px solid blue;" src="<?php echo '../admin/inc/'.$details['stu_img']; ?>" alt="<?php echo isset($details['stu_name']) ? $details['stu_name'] : 'Student photo'; ?>">
        </div>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="row" hidden>
                <label>ID</label> <br/>
                <input type="text" name="stud_id" value="<?php echo isset($details['stu_id']) ? $details['stu_id'] : ''; ?>">
            </div>
            <div class="row">
                <label>Student Name</label> <br/>
                <input type="text" name="stud_name" value="<?php echo isset($details['stu_name']) ? $details['stu_name'] : ''; ?>">
            </div>
            <div class="row">
                <label>Email</label> <br/>
                <input type="email" name="stud_email" value="<?php echo isset($details['stu_email']) ? $details['stu_email'] : ''; ?>" readonly>
            </div>
            <div class="row">
                <label>Password</label> <br/>
                <input type="text" name="stud_pass" value="<?php echo isset($details['stu_pass']) ? $details['stu_pass'] : ''; ?>">
            </div>
           
            <div class="row">
                <label>Profile photo</label> <br/>
                <input class="fileInp" type="file" name="stud_Img">
                <!-- <?php if(isset($details['stu_img'])) { ?>
                    <img src="<?php echo '../admin/inc/'.$details['stu_img']; ?>" alt="student Image" style="max-width: 200px; max-height: 200px;">
                <?php } ?> -->
            </div>
            <div class="row">
                <label>Student Name</label> <br/>
                <input type="text" name="stud_occ" value="<?php echo isset($details['stu_occ']) ? $details['stu_occ'] : ''; ?>">
            </div>
            <div class="btns">
                <button type="submit" name="updateStuBtn" id="updateStudent">Update</button>
            </div>
        </form>
    </div>

<?php  
    } // end if($details)
} // end if session check

// Process form submission on update button click
if(isset($_POST['updateStuBtn'])) {
    if(isset($_POST['stud_pass']) && !empty($_POST['stud_pass'])) {
        $id = $_POST['stud_id'];
        $stud_pass = $_POST['stud_pass'];
        $stud_occ = $_POST['stud_occ'];
        $stud_Img = $details['stu_img']; // Default to current image path
        
        // Handle file upload if a new image is selected
        if ($_FILES['stud_Img']['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["stud_Img"]["tmp_name"];
            $stud_Img = 'stdIMG/'.$_FILES["stud_Img"]["name"]; // Define the image path
            move_uploaded_file($tmp_name, '../admin/inc/'.$stud_Img); // Move the uploaded file to the specified path
        }
        
        // Update student details including the image URL
        $upCourse = $conn->prepare("UPDATE student SET stu_pass=?, stu_img=?,stu_occ=? WHERE stu_id=? ");
        if ($upCourse->execute([$stud_pass, $stud_Img,$stud_occ, $id])) {
            echo "<script>alert('Student updated successfully');</script>";
        } else {
            echo "<script>alert('Student could not be updated');</script>";
        }
        echo "<script>window.open('index.php?my_profile','_self')</script>";
    } else {
        echo "<script>alert('Fill all details');</script>";
        echo "<script>window.open('index.php?my_profile','_self')</script>";
    }
}
}
?>
