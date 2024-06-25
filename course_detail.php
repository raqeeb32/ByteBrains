<?php
include_once("inc/db_con.php");

// Fetch course ID from GET parameter
if(isset($_GET["course_id"])){
    $course_id = $_GET["course_id"];    
}

// Fetch course details from database
$get_course = $conn->prepare("SELECT * FROM course WHERE course_id = :course_id");
$get_course->bindParam(':course_id', $course_id, PDO::PARAM_INT);
$get_course->execute();

// Check if course exists
if($get_course->rowCount() > 0){
    $row = $get_course->fetch(PDO::FETCH_ASSOC);
    $course_name = $row["course_name"];
    $course_img = $row["course_img"];
    $course_OP=$row["course_org_price"];
    $course_price = $row["course_price"];
    $course_desc=$row["course_desc"];
    $course_duration=$row["course_duration"];
    $what_will_you_learn=$row["what_will_you_learn"];
    $requirements=$row["requirements"];
    $inst_id=$row["ins_id"];
    // Fetch chapters and lessons for the course
    $get_chaps = $conn->prepare("SELECT * FROM chapter WHERE course_id = :course_id");
    $get_chaps->bindParam(':course_id', $course_id, PDO::PARAM_INT);
    $get_chaps->execute();

    // Fetch lessons for each chapter
    $chapters = [];
    while ($row = $get_chaps->fetch(PDO::FETCH_ASSOC)) {
        $chapter_id = $row["ch_id"];
        $chapter_name = $row["ch_name"];

        $get_lessons = $conn->prepare("SELECT * FROM lessons WHERE ch_id = :chapter_id");
        $get_lessons->bindParam(':chapter_id', $chapter_id, PDO::PARAM_INT);
        $get_lessons->execute();

        $lessons = [];
        while ($lesson = $get_lessons->fetch(PDO::FETCH_ASSOC)) {
            $lessons[] = $lesson['l_name'];
        }

        // Store chapters with lessons
        $chapters[] = [
            'chapter_name' => $chapter_name,
            'lessons' => $lessons
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $course_name; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        .panel {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
}
#chapters-accordain{
    margin-top: 12%;
}
.accordion.active + .panel {
    max-height: 500px; /* Adjust the max-height based on your content */
}
    </style>
</head>
<body>
<?php include("inc/header.php"); ?>

<div class="course-detail-head">
    <div class="course-detail">
        <h1><?php echo $course_name; ?></h1>
        
        <div class="course-desc">
            <span>
               <?php echo $course_desc;?>
            </span>
        </div>
        <br>
        <div class="courseDuration" >
            <!-- Display course details -->
            <span><img src="images/c-duraction.svg" alt="">  <?php echo $course_duration;?></span>
            <span><img src="images/students.svg" alt=""> 30 Students</span>
        </div>
    </div>
    <div class="course-cd">
        <div class="courseImg">
            <img class="cImg" src="instructor/<?php echo $course_img; ?>" alt="course">
        </div>
        <div class="course-enroll-c">
         <h2>Price: ₹ <strike> <small><?php echo $course_OP; ?></small></strike></h2> <h2> ₹<?php echo $course_price; ?></h2>
            <button id="enroll-btn">Enroll now</button>
        </div>
    </div>
</div>

<section class="course-content">
<div class="wwul">
        <h2>What you will learn</h2>
        <div class="wwul-content">
        <?php
            echo $what_will_you_learn;
        ?>  
        </div>     
    </div>

    <div class="requirements wwul">
            <h2>Requirements</h2>
            <div class="wwul-content">
        <?php
            echo $requirements;
        ?>  
        </div> 
    </div>
    <div id="chapters-accordain">
        <h2>Course Content</h2>
        <?php foreach ($chapters as $chapter): ?>
    <button class="accordion"><?php echo $chapter['chapter_name']; ?></button>
    <div class="panel">
        <?php foreach ($chapter['lessons'] as $lesson): ?>
            <p><?php echo $lesson; ?></p>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>
    </div>

<div class="inst-details">
<h2>About instructor</h2>
<div class="inst-detail">
<?php
$ins_detail = $conn->prepare("SELECT * FROM instructor WHERE id = :ins_id");
$ins_id = $inst_id; // Replace with the actual instructor ID you want to fetch

// Bind parameters and execute query
$ins_detail->bindParam(':ins_id', $ins_id, PDO::PARAM_INT);
$ins_detail->execute();

// Fetch the instructor details
$ins_detail = $ins_detail->fetch(PDO::FETCH_ASSOC);

echo '<img class="instructor_img" style="width:10%;height:10%;border-radius:80%;padding-top:1%;" src="admin/inc/instIMG/'.$ins_detail["photo"].'" alt="Instructor image">';
echo '<span>' . htmlspecialchars($ins_detail["name"]) . '</span>';
echo '<span>' . htmlspecialchars($ins_detail["email"]) . '</span>';
echo '<span>' . htmlspecialchars($ins_detail["specialization"]) . '</span>';
echo '<span>' . htmlspecialchars($ins_detail["bio"]) . '</span>';

?>
</div>

</div>  
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var acc = document.getElementsByClassName("accordion");

    for (var i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
});
</script>

</body>
</html>
