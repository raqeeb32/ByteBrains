<!-- <link rel="stylesheet" href="css/style.css"> -->
<link rel="stylesheet" href="css/style2.css">
<?php
if(!isset($_SESSION)){
    session_start();
 }
 if(isset($_SESSION['adminLogin'])){
    include_once("inc/db_con.php")
    ?>

    <div class="right">
        <h3>List of students</h3>
        <div class="course_table">
            <table>
                <tr>
                    <th>Sl.no</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <?php
                $i=1;
                $getCourse=$conn->prepare("SELECT * FROM student");     
                $getCourse->setFetchMode(PDO::FETCH_ASSOC);
                $getCourse->execute();
                while($row=$getCourse->fetch()){
                    echo "
                    <tr>
                        <td>".$i++."</td>
                        <td>".$row['stu_name']."</td>
                        <td>".$row['stu_email']."</td>
                        <td>
                            <a href='inc/editStudent.php?id=".$row['stu_id']."' title='Edit'>Edit</a>
                            <a style='color:red' href='index.php?students&del_student=" . $row['stu_id'] . "' title='Delete'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </table>
        </div>
        <button class="addCbtn" name="addStuBtn"><a href="inc/addNewStudent.php">+</a></button>
    </div>
    <?php
    if(isset($_GET["del_student"])){
        $id = $_GET['del_student'];
        $get_image_path = $conn->prepare("SELECT course_img FROM course WHERE course_id=?");
        $get_image_path->execute([$id]);
        $image_row = $get_image_path->fetch(PDO::FETCH_ASSOC);
        $image_path = $image_row['course_img'];
        
        // Delete the image file if it exists
        if (file_exists($image_path)) {
            unlink($image_path); // Delete the file
        }
        
        $del = $conn->prepare("DELETE FROM student WHERE stu_id=?");
        if ($del->execute([$id])) {
            echo "<script>alert('student deleted successfully');</script>";
        } else {
            echo "<script>alert('student could not be deleted');</script>";
        }
        echo "<script>window.open('index.php?students','_self')</script>";
    }
    ?>
 <?php }
 else{
    header("location:../index.php");
 }
 ?>