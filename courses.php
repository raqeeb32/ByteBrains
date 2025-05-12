<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/c25eb3470e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php 
        include("inc/header.php");
        
    ?>
    <section>
    <h2>All courses</h2>
    <div class="Pcourses-container">
        <?php 
            include("inc/db_con.php");
            $get_course=$conn->prepare("SELECT * FROM course");
            // $get_course->setFetchMode(PDO::FETCH_ASSOC);
            $get_course->execute();
            if($get_course->rowCount()> 0){
                while($row=$get_course->fetch(PDO::FETCH_ASSOC)){
                    $course_id=$row["course_id"];
                    echo'
                          <div class="course">
            <div class="courseImg">
                <img class="cImg" src="instructor/'.$row["course_img"].'" alt="course">
            </div>
            <div class="courseDesc">
                <div class="aboutCourse">
                    <p>by Raqeeb</p>
                    <h4>'.$row["course_name"].'</h4>
                </div>
                <div class="courseDuration">
                    <img src="images/c-duraction.svg" alt=""> <span>'.$row["course_duration"].'</span>
                    <img src="images/students.svg" alt=""> <span>30 Students</span>
                </div>
                <!-- <hr/> -->
                <div class="coursePrice">
                    <div class="price">
                        <span> ₹ <del>'.$row["course_org_price"].'</del></span>
                        <span>₹'.$row["course_price"].'</span>
                    </div>
                    <a href="./course_detail.php?course_id='.$row["course_id"].'" class="view_more">view more</a>
                </div>
            </div>
        </div>                                     
                    ';
                }
            }
        ?>
    </div>
    </section>
    <br><br><br>
    <footer>
    <?php
    include("inc/footer.php"); 
    ?> 
    </footer>
    
</body>
</html>