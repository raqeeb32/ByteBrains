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
        <h3>List of Instructors</h3>
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
                $getCourse=$conn->prepare("SELECT * FROM instructor");     
                $getCourse->setFetchMode(PDO::FETCH_ASSOC);
                $getCourse->execute();
                while($row=$getCourse->fetch()){
                    echo "
                    <tr>
                        <td>".$i++."</td>
                        <td>".$row['name']."</td>
                        <td>".$row['email']."</td>
                        <td>
                            <a href='inc/editinstructor.php?id=".$row['id']."' title='Edit'>Edit</a>
                            <a style='color:red' href='index.php?instructors&del_instructor=" . $row['id'] . "' title='Delete'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </table>
        </div>
        <button class="addCbtn" name="addInstBtn"><a href="inc/addNewInstructor.php">+</a></button>
    </div>
    <?php
    if(isset($_GET["del_instructor"])){
        $id = $_GET['del_instructor'];
        // $get_image_path = $conn->prepare("SELECT course_img FROM course WHERE course_id=?");
        // $get_image_path->execute([$id]);
        // $image_row = $get_image_path->fetch(PDO::FETCH_ASSOC);
        // $image_path = $image_row['course_img'];
        
        // // Delete the image file if it exists
        // if (file_exists($image_path)) {
        //     unlink($image_path); // Delete the file
        // }
        
        $del = $conn->prepare("DELETE FROM instructor WHERE id=?");
        if ($del->execute([$id])) {
            echo "<script>alert('Instructor deleted successfully');</script>";
        } else {
            echo "<script>alert('Instructor could not be deleted');</script>";
        }
        echo "<script>window.open('index.php?instructors','_self')</script>";
    }
    ?>
 <?php }
 else{
    header("location:../index.php");
 }
 ?>