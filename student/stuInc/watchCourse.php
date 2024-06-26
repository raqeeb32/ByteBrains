<?php
include_once("db_con.php");
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION["stuLogin"])){
    echo "<script>window.open('../index.php?my_courses','_self')</script>"; 
}
?>
<?php
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
    <title>watch course</title>
    <link rel="stylesheet" href="../css/watchCourse.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" /> 
</head>
<body>
<header>
    <div class="logo"><a href="../index.php?my_courses">SkillyEarn</a></div>
    <div class="panel">Student pannel</div>
    <a href="../logout.php">Logout</a>
</header>
<div class="wc_left">
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

</script>
<script src="../js/jquery.min.js"></script>
   <script src="js/ajaxrequest.js"></script>
</body>
</html>