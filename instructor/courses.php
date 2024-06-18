<?php
if(!isset($_SESSION)){
    session_start();
 }
 if(isset($_SESSION['instlogin'])){
    include_once("inc/db_con.php")
    ?>

    <div class="right">
        <h3>courses</h3>
        <div class="course_table">
            <table>
                <tr>
                    <th>Sl.no</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <?php
                $i=1;
                $getCourse=$conn->prepare("SELECT * FROM course");     
                $getCourse->setFetchMode(PDO::FETCH_ASSOC);
                $getCourse->execute();
                while($row=$getCourse->fetch()){
                    echo "
                    <tr>
                        <td>".$i++."</td>
                        <td>".$row['course_name']."</td>
                        <td>
                            <a href='inc/editCourse.php?id=".$row['course_id']."' title='Edit'>Edit</a>
                            <a style='color:red' href='index.php?courses&del_course=" . $row['course_id'] . "' title='Delete'>Delete</a>
                            <a style='color:green' href='chapters.php?course=" . $row['course_id'] . "' title='View chapters'>chapters</a>
                        </td>
                    </tr>";
                }
                ?>
            </table>
        </div>
        <button class="addCbtn"><a href="inc/addCourse.php">+</a></button>
    </div>
    <?php
    if(isset($_GET["del_course"])){
        $id = $_GET['del_course'];
        $get_image_path = $conn->prepare("SELECT course_img FROM course WHERE course_id=?");
        $get_image_path->execute([$id]);
        $image_row = $get_image_path->fetch(PDO::FETCH_ASSOC);
        $image_path = $image_row['course_img'];
        
        // Delete the image file if it exists
        if (file_exists($image_path)) {
            unlink($image_path); // Delete the file
        }
        
        $del = $conn->prepare("DELETE FROM course WHERE course_id=?");
        if ($del->execute([$id])) {
            echo "<script>alert('Course deleted successfully');</script>";
        } else {
            echo "<script>alert('Course could not be deleted');</script>";
        }
        echo "<script>window.open('index.php?courses','_self')</script>";
    }
    ?>
 <?php }
 else{
    header("location:../index.php");
 }
 ?>

