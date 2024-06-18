<?php
include_once("../inc/db_con.php"); ?>
<?php
//checking email already exists
if (isset($_POST["checkemail"]) && $_POST['stuemail']) {
    $stuemail = $_POST['stuemail'];
    $sql = $conn->prepare("SELECT stu_email FROM student WHERE stu_email=:stuemail");
    $sql->bindParam(':stuemail', $stuemail);
    $sql->execute();
    $row = $sql->rowCount();
    echo json_encode($row);
}

//insert student
if (isset($_POST['stuname']) && isset($_POST['stuemail']) && isset($_POST['stupass'])) {
    $stuname = $_POST['stuname'];
    $stuemail = $_POST['stuemail'];
    $stupass = $_POST['stupass'];
    $sql = $conn->prepare("INSERT INTO student (stu_name, stu_email, stu_pass) VALUES (:stuname, :stuemail, :stupass)");
    $sql->bindParam(':stuname', $stuname);
    $sql->bindParam(':stuemail', $stuemail);
    $sql->bindParam(':stupass', $stupass);
    if ($sql->execute()) {
        echo json_encode('inserted');
    } else {
        echo json_encode('failed');
    }
}
// check student
if(isset($_POST['checkLogEmail']) && isset($_POST['stuLogEmail']) && isset($_POST['stuLogPass'])) {
    $stuLogEmail = $_POST['stuLogEmail'];
    $stuLogPass= $_POST['stuLogPass'];
    $sql = $conn->prepare("SELECT stu_email, stu_pass FROM student WHERE stu_email='$stuLogEmail' AND 'stu_pass=$stuLogPass'");
    $sql->execute();
    $row = $sql->rowCount();
    if ($row == 1) {
        echo json_encode($row);
    }
    else if ($row == 0) {
        echo json_encode($row);
    }
}
?>

