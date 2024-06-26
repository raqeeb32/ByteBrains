
<?php
// Start the session if not already started
if(!isset($_SESSION)) {
    session_start();
}

// Include database connection
include("db_con.php");

// Check if session email is set
if(isset($_SESSION['stuLogin'])) {
    $stu_id = $_SESSION['stu_id'];

    // Include header once session is confirmed
    include_once("header.php");
    ?>
    <div class="right">
        <h2 style="text-align:center;">My courses</h2>
        <?php 
        // Prepare and execute query to get enrolled courses
        $getCourses = $conn->prepare("SELECT e.course_p_id, c.course_id, c.course_name, c.course_duration, c.course_desc, c.course_img, c.ins_id, c.language, c.course_org_price, c.course_price 
                                    FROM enrollment AS e 
                                    JOIN course AS c ON c.course_id = e.course_p_id 
                                    WHERE e.stu_id = :stu_id");
        $getCourses->bindParam(':stu_id', $stu_id, PDO::PARAM_INT);
        $getCourses->execute();
        
        // Check if there are any enrolled courses
        if($getCourses->rowCount() > 0) {
            while($row = $getCourses->fetch(PDO::FETCH_ASSOC)) {
                // Display course information
                ?>
                <div class="my-courses">
                  <div class="my_course">
                    <div class="c-img">
                    <img style="width:200px;height:200px" src="../instructor/<?php echo $row['course_img']; ?>" alt="<?php echo $row['course_name']; ?>" />
                    </div>
                    <div class="c-details">
                    <h3><?php echo $row['course_name']; ?></h3>
                    <p><b>Description:</b> <?php echo $row['course_desc']; ?></p>
                    <p><b>Duration:</b><?php echo $row['course_duration']; ?></p>
                    <p><b>Language:</b> <?php echo $row['language']; ?></p>
                    <p><b>Price:</b>Price: ₹<?php echo $row['course_price']; ?></p>
                   <br> <a id="watch-btn" href="stuInc/watchCourse.php?course_id=<?php echo $row['course_id']; ?>">Watch</a> 
                    </div>
                             
                </div>
              </div>                
                <?php
            }
        } else {
            echo "<p>No courses enrolled yet.</p>";
        }
        ?>
    </div>

    <?php
} else {
    // Redirect if session is not set
    echo "<script>window.open('index.php?my_courses','_self')</script>";  
}
?>
