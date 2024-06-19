<?php
// Start or resume session
if(!isset($_SESSION)){
    session_start();
}
// Include database connection
include("db_con.php");

// Check if session email is set
if(isset($_SESSION['stuLogin'])){
    if(isset($_SESSION["email"])) {
        $email = $_SESSION["email"];
        
        // Prepare and execute SQL query to fetch student details
        $get_details = $conn->prepare("SELECT * FROM student WHERE stu_email=?");
        $get_details->execute([$email]);
        $details = $get_details->fetch(PDO::FETCH_ASSOC);
        
        // Assign fetched values to variables
        if($details) {

    ?>
    
    <div class="right">
        <h3>My profile</h3>
        <div class="profile-img">
        <img style="width: 100px; height: 100px; border-radius: 50%; border: 1px solid blue;" src="<?php echo '../admin/inc/'.$details['stu_img']; ?>" alt="<?php echo isset($details['stu_name']) ? $details['stu_name'] : 'Student photo'; ?>">
        </div>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <label>Student Name</label>
                <input type="text" name="stud_name" value="<?php echo isset($details['stu_name']) ? $details['stu_name'] : ''; ?>">
            </div>
            <div class="row">
                <label>Email</label>
                <input type="email" name="stud_email" value="<?php echo isset($details['stu_email']) ? $details['stu_email'] : ''; ?>" readonly>
            </div>
           
            <div class="row">
                <label>Profile photo</label>
                <input class="fileInp" type="file" name="stud_img">
                <?php if(isset($stu_img)) { ?>
                    <img src="<?php echo $details['stu_img']; ?>" alt="student Image" style="max-width: 200px; max-height: 200px;">
                <?php } ?>
            </div>
            <div class="btns">
                <button type="submit" name="updateStuBtn" id="updateStudent">Update</button>
            </div>
        </form>
    </div>
 <?php  
     }
    }
 
}
