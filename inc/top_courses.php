<section class="category courses_section">

    <div class="popular-courses-heading">
        <div class="p-c-h-l">
            <h2>Featured courses</h2>
            <p>Explore our popular courses</p>
        </div>
        <div>
            <button class="all-courses-btn">All courses </button>
        </div>
    </div>

    <div class="Pcourses-container">
        <?php 
            include("db_con.php");
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
                    <p>by Matheen</p>
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
                    <a href="#" class="view_more">view more</a>
                </div>
            </div>
        </div>                                     
                    ';
                }
            }
        ?>
    </div>
</section>