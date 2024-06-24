<?php
include_once("inc/db_con.php");
if(isset($_GET["course_id"])){
    $course_id=$_GET["course_id"];    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <!-- Google Fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    include("inc/header.php");
    ?>
    <div class="course-detail-head">
        <div class="course-detail">
            <h1>The ultimate web development course</h1>
            <br>
                <div class="courseDuration">
                    <img src="images/c-duraction.svg" alt=""> <span>2 weeks</span>
                    <img src="images/students.svg" alt=""> <span>30 Students</span>
                    <!-- <img src="images/level.svg" alt=""> <span>Beginner</span> -->
                    <!-- <img src="images/language.svg" alt=""> <span>English</span> -->
                </div>
            <br>
            <div class="course-desc">
             <span>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates quod placeat libero numquam. Iusto ipsam repellendus voluptates ducimus suscipit sapiente quis, accusamus libero est sunt molestias ipsum, optio, quas perferendis.
                Nulla expedita, eveniet rerum velit dicta tempore vel officiis reiciendis quos recusandae, optio quo! Nisi quasi illum ea harum. Voluptatibus earum harum impedit fuga dolor iste doloribus aspernatur corrupti veritatis.
             </span>
            </div>
        </div>
        <div class="course-cd">
        <?php 
            include("inc/db_con.php");
            $get_course=$conn->prepare("SELECT * FROM course where course_id=$course_id");
            // $get_course->setFetchMode(PDO::FETCH_ASSOC);
            $get_course->execute();
            if($get_course->rowCount()> 0){
                while($row=$get_course->fetch(PDO::FETCH_ASSOC)){
                    $course_id=$row["course_id"];
                    echo'
        <div class="courseImg">
                <img class="cImg" src="instructor/'.$row["course_img"].'" alt="course">
            </div>
        <div class="course-enroll-c">
            <h2>Price: ₹ '.$row["course_price"].'</h2>
            <button id="enroll-btn">Enroll now</button>
        </div>
            ';
                }
            }
            ?>       
        </div>        
    </div>
 <section>
            <div class="course-content">
            <style>
      h2 {
        margin-bottom: 10px;
    }
</style>
<section>
    <div id="faqContainer">
        <h2>Course content</h2>
    <?php include ("inc/db_con.php");
    $get_chaps = $conn->prepare("SELECT * FROM chapter where course_id=$course_id");
    $get_chaps->setFetchMode(PDO::FETCH_ASSOC);
    $get_chaps->execute();

   
    while ($row = $get_chaps->fetch()) {
        $chap_id=$row["ch_id"];
       
    echo "
    <button class='accordion'>".$row['ch_name']."</button>";
        $get_lessons = $conn->prepare("SELECT * FROM lessons where ch_id=$chap_id");
        $get_lessons->setFetchMode(PDO::FETCH_ASSOC);
        $get_lessons->execute();
        while ($lesn = $get_lessons->fetch(PDO::FETCH_ASSOC)) {
   echo" <div class='panel'>
        <p>".$lesn['l_name']."</p>
    </div>
          ";
      }
      } 
    ?>
    </div>

</section>
<script>
var acc = document.getElementsByClassName("accordion");
    var i;
    
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
</script>
            </div>
 </section>  
</body>
</html>