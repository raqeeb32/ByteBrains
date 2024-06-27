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
<h3>chapters</h3>
<div class="course_table">
            <table>
                <tr>
                    <th>Sl.no</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
               
                <?php
                if(isset($_GET['course'])){
                    $course_id=$_GET['course'];
                    $i=1;
                    $getCourse=$conn->prepare("SELECT * FROM `chapter` WHERE course_id=$course_id");     
                    $getCourse->setFetchMode(PDO::FETCH_ASSOC);
                    $getCourse->execute();
                    $count=$getCourse->rowCount();
                    while($row=$getCourse->fetch()){
                        echo "
                        <tr>
                            <td>".$i++."</td>
                            <td>".$row['ch_name']."</td>
                            <td>
                                <a href='inc/editChapter.php?id=".$row['ch_id']."' title='Edit'>Edit</a>
                                <a style='color:red' href='chapters.php?chapters&del_chapter=" . $row['ch_id'] . "' title='Delete'>Delete</a>
                                <a href='lessons.php?lessons=".$row['ch_id']."' title='lessons'>View lessons</a>

                                </td>
                        </tr>";
                    }
                }
            //    else{
            //             echo "<script>alert('You havent selected any chapter');</script>";
            //             echo "<script>window.open('index.php?courses','_self');</script>";
            //        }
                
              
                ?>
            </table>
        </div>
        <button class="addCbtn"><a href="inc/addChapter.php">+</a></button>
</div>
<?php
    if(isset($_GET["del_chapter"])){
        $id = $_GET['del_chapter'];  
        $del = $conn->prepare("DELETE FROM chapter WHERE ch_id=?");
        if ($del->execute([$id])) {
            echo "<script>alert('chapter deleted successfully');</script>";
        } else {
            echo "<script>alert('chapter could not be deleted');</script>";
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