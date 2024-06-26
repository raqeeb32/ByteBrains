<?php
include_once("inc/db_con.php");
if(!isset($_SESSION))
{
    session_start();
}
if(!isset($_SESSION["stuLogin"])){
    header('location:loginAndSignup.php');
}
if(isset($_GET["purchase_course_id"])){
$purchase_course_id=$_GET["purchase_course_id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>check out</title>
</head>
<body>
<h1 style="text-align:center;">Check Out</h1>
    <div class="payment_check">
        <span>Do you want to purchase this course?</span>
        <a class="btn yes-btn" href="purchaseSucess.php?purchase_course_id=<?php echo $purchase_course_id; ?>">Yes</a>
        <a class="btn no-btn" href="courses.php">No</a>
    </div>
</body>
</html>
<?php } ?>