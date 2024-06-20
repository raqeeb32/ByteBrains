<?php
// Start or resume session
if(!isset($_SESSION)){
session_start();
}

// Check if adminLogin session variable is set
if (isset($_SESSION['adminLogin'])) {
    // Include database connection
    include_once("inc/db_con.php");
    ?>

    <div id="bodyRight">
        <h3> Feedbacks</h3>
        <table class="feedback_table" cellspacing="0px">
            <thead>
            <tr>
                <th>Sl.no</th>
                <th>Feedback</th>
                <th>Student</th>
                <th>Action</th> 
            </tr>
            </thead>
          
            <?php
            // Prepare and execute SELECT query
            $get_feedbacks = $conn->prepare("SELECT * FROM feedback");
            $get_feedbacks->execute();
            $i = 1;
            while ($row = $get_feedbacks->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>
                    <td>'.$i++.'</td>
                    <td>'.$row["f_content"].'</td>
                    <td>'.$row["stu_id"].'</td>
                    <td><a href="index.php?feedbacks&del_feedback='.$row["f_id"].'">Delete</a></td></tr>'; // Changed button to a link for proper GET request
            }
            ?>
        </table>
    </div>

    <?php
}

if (isset($_GET["del_feedback"])) {
    $id = $_GET["del_feedback"];
    $query = $conn->prepare("DELETE FROM feedback WHERE f_id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($query->execute()) {
        echo "<script>alert('Feedback deleted successfully');</script>";
        echo '<script>window.open("index.php?feedbacks","_self");</script>';    } 
        else {
        echo "<script>alert('Feedback could not be deleted');</script>";
        echo '<script>window.open("index.php?feedbacks","_self");</script>';    }
}
?>
