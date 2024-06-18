<?php
if(!isset($_SESSION)){
    session_start();
 }
 if(isset($_SESSION['instlogin'])){
    include_once("inc/db_con.php");
    // include_once("inc/header.php");
    // include_once("inc/left.php");
    ?>
    <link rel="stylesheet" href="css/style.css">
<div class="right">
<h3>Lessons</h3>
<div class="course_table">
            <table>
                <tr>
                    <th>Sl.no</th>
                    <th>Name</th>
                    <th>Video link</th>
                    <th>Duration</th>
                    <th>Actions</th>
                </tr>
               
                <?php
                if(isset($_GET['lessons'])){
                    $chapter_id=$_GET['lessons'];
                    $i=1;
                    $getCourse=$conn->prepare("SELECT * FROM `lessons` WHERE ch_id=$chapter_id");     
                    $getCourse->setFetchMode(PDO::FETCH_ASSOC);
                    $getCourse->execute();
                    $count=$getCourse->rowCount();
                    if($count>0){
                        while($row=$getCourse->fetch()){
                            echo "
                            <tr>
                                <td>".$i++."</td>
                                <td>".$row['l_name']."</td>
                                <td> ".$row['l_link']."</td>
                                <td>".$row['l_duration']."</td>
                      
                                <td>
                                    <a href='inc/editLesson.php?lessonId=".$row['l_id']."' title='Edit'>Edit</a>
                                    <a style='color:red' href='index.php?chapters&del_lesson=" . $row['l_id'] . "' title='Delete'>Delete</a>
                                </td>
                            </tr>";
                        }
                    }else{
                        echo "<script>alert('No lessons for this chapter');</script>";
                    }
                   
                }
               else{
                        echo "<script>alert('You havent selected any lesson');</script>";
                        echo "<script>window.open('../index.php?courses','_self');</script>";
                   }               
              
                ?>
            </table>
        </div>
        <button class="addCbtn"><a href="inc/addLesson.php">+</a></button>
</div>
<?php
    if(isset($_GET["del_lesson"])){
        $id = $_GET['del_lesson'];  
        echo "Lesson ID to delete: " . $id;
        $del = $conn->prepare("DELETE FROM lessons WHERE l_id=?");
        if ($del->execute([$id])) {
            echo "<script>alert('lesson deleted successfully');</script>";
        } else {
            echo "<script>alert('lesson could not be deleted');</script>";
        }
        echo "<script>window.open('index.php?courses','_self')</script>";
    }
    ?>
<?php } 
else{
   echo' <script> alert("No chapters");</script>';
   header('location:chapters.php');
}
?>