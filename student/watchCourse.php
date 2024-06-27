<?php
include_once("stuInc/db_con.php");
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION["stuLogin"])){
    echo "<script>window.open('../index.php?my_courses','_self')</script>"; 
}

if(isset($_GET["course_id"])) {
    $course_id = $_GET["course_id"];
    
}

$get_course = $conn->prepare("SELECT * FROM course WHERE course_id = :course_id");
$get_course->bindParam(':course_id', $course_id, PDO::PARAM_INT);
$get_course->execute();

// Check if course exists
if($get_course->rowCount() > 0){
    $row = $get_course->fetch(PDO::FETCH_ASSOC);
    $course_name = $row["course_name"];
    // Fetch chapters and lessons for the course
    $get_chaps = $conn->prepare("SELECT * FROM chapter WHERE course_id = :course_id");
    $get_chaps->bindParam(':course_id', $course_id, PDO::PARAM_INT);
    $get_chaps->execute();

    // Initialize chapters array
    $chapters = [];
    
    while ($row = $get_chaps->fetch(PDO::FETCH_ASSOC)) {
        $chapter_id = $row["ch_id"];
        $chapter_name = $row["ch_name"];

        // Fetch lessons for each chapter
        $get_lessons = $conn->prepare("SELECT * FROM lessons WHERE ch_id = :chapter_id");
        $get_lessons->bindParam(':chapter_id', $chapter_id, PDO::PARAM_INT);
        $get_lessons->execute();

        // Initialize lessons and lesson links arrays
        $lessons = [];
        $lesson_links = [];

        while ($lesson = $get_lessons->fetch(PDO::FETCH_ASSOC)) {
            $lessons[] = $lesson['l_name'];
            $lesson_links[] = $lesson['l_link'];
        }

        // Store chapters with lessons and lesson links
        $chapters[] = [
            'chapter_name' => $chapter_name,
            'lessons' => $lessons,
            'lesson_links' => $lesson_links
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch Course</title>
    <link rel="stylesheet" href="css/watchCourse.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" /> 
    <script src="https://kit.fontawesome.com/c25eb3470e.js" crossorigin="anonymous"></script>
    <!-- Include jQuery before your script -->
    <script src="../js/jquery.min.js"></script>
</head>
<body>
<header>
    <div class="logo"><a href="index.php?my_courses">SkillyEarn</a></div>
    <div class="panel">Student panel</div>
    <a href="../logout.php">Logout</a>
</header>
<div class="wc_left">
    <div id="chapters-accordain">
        <h2>Course Content</h2>
        <?php foreach ($chapters as $chapter): ?>
            <button class="accordion"><?php echo $chapter['chapter_name']; ?></button>
            <ul class="panel">
                <?php foreach ($chapter['lessons'] as $key => $lesson): ?>
                    <li style="cursor:pointer;" movieURL="<?php echo $chapter['lesson_links'][$key]; ?>"><?php echo $lesson; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    </div>
</div> 
<div class="wc_right">
    <video id="videoarea" src="" controls></video>
</div> 

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

// Use jQuery after ensuring it's loaded
$(document).ready(function(){
    $(".panel li").on("click", function(){
        $("#videoarea").attr("src", "../instructor/assets/lessonVideos/" + $(this).attr("movieURL"));
    });
});
</script>
</body>
</html>

