<link rel="stylesheet" href="css/style.css">
<?php
if(!isset($_SESSION)){
    session_start();
 }
 include_once("inc/db_con.php");
 if(isset($_SESSION['instlogin']) && isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
    
    // Prepare and execute SQL query to fetch student details
    $get_details = $conn->prepare("SELECT * FROM instructor WHERE email=?");
    $get_details->execute([$email]);
    $row = $get_details->fetch(PDO::FETCH_ASSOC);
    
    // Check if details were fetched successfully
    if($row) {
?>

<div class="right">
        <h3>My profile</h3>
        <div class="profile-img">
            <img style="width: 120px; height: 120px; border-radius: 50%; border: 1px solid blue;" src="<?php echo '../admin/inc/instIMG/'.$row['photo']; ?>" alt="<?php echo isset($details['stu_name']) ? $details['stu_name'] : 'Student photo'; ?>">
        </div>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="row" hidden>
                <label>ID</label> <br/>
                <input type="text" name="inst_id" value="<?php echo isset($details['id']) ? $row['id'] : ''; ?>">
            </div>
            <div class="row">
                <label>instructor Name</label>
                <input type="text" name="inst_name" value="<?php echo $row['name']; ?>">
            </div>
            <div class="row">
                <label>Email</label>
                <input readonly type="email" name="inst_email"value="<?php echo $row['email']; ?>">
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
                <?php if(isset($row['photo'])) { ?>
                    <!-- <img src="../admin/inc/instIMG/ -->
                    <?php echo "<small>".$row['photo']."</small>"; ?>
                    <!-- " alt="Instructor Image" style="max-width: 150px; max-height: 150px;"> -->
                <?php } ?>
            </div>
            <div class="btns">
                <button type="submit" name="editInstBtn" id="updateInstructor">Update</button>
            </div>
        </form>
    </div>   
 <?php 
    }
}
?>
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
        $inst_Img = '../admin/inc/instIMG/'. $_FILES["inst_Img"]["name"]; // Define the image path
        move_uploaded_file($tmp_name, $inst_Img); // Move the uploaded file to the specified path
        $img_select=$_FILES["inst_Img"]["name"];
    } else {
        // No new image selected, retain the existing one
        $inst_Img = $row['inst_Img'];
    }
    
    // Update student details including the image URL
    $upCourse = $conn->prepare("UPDATE instructor SET name=?,email=?, password=?,bio=?,specialization=?, photo=? WHERE id=? ");
    if ($upCourse->execute([$inst_name, $inst_email, $inst_pass,$inst_bio,$inst_specialization, $img_select, $id])) {
        echo "<script>alert('Instructor updated');</script>";
    } else {
        echo "<script>alert('Instructor could not be updated');</script>";
    }
    echo "<script>window.open('index.php?profile','_self')</script>";
}
?>