<?php

function edit_course($id){
    include_once("db_con.php");
        $get_course = $conn->prepare("SELECT * FROM course WHERE course_id=?");
        $get_course->execute([$course_id]);
        $row = $get_course->fetch(PDO::FETCH_ASSOC);

        echo '
      <div class="addCourse">
    <h3>Edit course</h3>
    <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <label for="courseName">Course Name</label>
                <input type="text" name="course_name" value="'.$row['course_name'].'">
            </div>
           
            <div class="row">
                <label>Course Description</label>
               <textarea name="course_desc" value="'.$row['course_desc'].'"></textarea>
            </div>
            <div class="row">
                <label>Course Duration</label>
                <input type="text" name="course_duration" value="'.$row['course_duration'].'">
            </div>
            
            <div class="row">
                <label>Course original price</label>
                <input type="number" name="course_OP" value="'.$row['course_org_price'].'">
            </div>
            <div class="row">
                <label>Course selling price</label>
                <input type="number" name="course_SP" value="'.$row['course_price'].'">
            </div>
            <div class="row">
                <label>Course image</label>
                <input type="file" name="course_Img" value="'.$row['course_img'].'">
            </div>
            <div class="btns">
                <button name="editCoursebtn" name="editCoursebtn" id="editCourse">Update</button>
                <button id="closebtn"><a href="../index.php?courses">Close</a></button>
            </div>
         </form>
    </div>';

        if (isset($_POST["editCoursebtn"])) {
            $course_name = $_POST["course_name"];
            $course_desc = $_POST["course_desc"];
            $course_duration = $_POST["course_duration"];
            $course_OP = $_POST["course_OP"];
            $course_SP = $_POST["course_SP"];
            $course_Img = $_POST["course_Img"];
            
            $upCourse = $conn->prepare("UPDATE course SET course_name=?, course_desc=?,course_img=?,course_duration=?,course_price,course_org_price WHERE course_id=? ");
            if ($upCourse->execute([$course_name,$course_desc,$course_Img,$course_duration,$course_SP,$course_OP, $id])) {
                echo "<script>alert('Course updated successfully');</script>";
            } else {
                echo "<script>alert('Course could not be updated');</script>";
            }
            echo "<script>window.open('../index.php?courses','_self')</script>";
        }
}
?>
