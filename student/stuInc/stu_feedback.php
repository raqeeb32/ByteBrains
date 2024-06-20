<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['stuLogin']) && isset($_SESSION["email"])) {
    include_once("db_con.php");
    $email = $_SESSION["email"];

    // Prepare and execute SQL query to fetch student details
    $get_details = $conn->prepare("SELECT * FROM student WHERE stu_email=?");
    $get_details->execute([$email]);
    $details = $get_details->fetch(PDO::FETCH_ASSOC);

    // Check if details were fetched successfully
    if ($details) {
?>
        <div class="right">
            <h3>Feedback</h3>
            <form action="#" method="post">
                <div class="row" hidden>
                    <label>ID</label> <br />
                    <input type="text" name="stu_id" value="<?php echo isset($details['stu_id']) ? $details['stu_id'] : ''; ?>">
                </div>
                <div class="row">
                    <label>Feedback</label> <br />
                    <textarea name="feedback"></textarea>
                </div>
                <div class="btns">
                    <button type="submit" name="updateFeedback" id="updateFeedback">Submit</button>
                </div>
            </form>
        </div>
<?php
    }

    // Process form submission on update button click
    if (isset($_POST['updateFeedback'])) {
        $id = $_POST['stu_id'];
        $feedback = htmlspecialchars($_POST['feedback']); // Sanitize input

        // Prepare and execute SQL query to update feedback
        $up_feedback = $conn->prepare('INSERT INTO feedback(f_content, stu_id) VALUES(:feedback, :id)');
        $up_feedback->bindParam(':feedback', $feedback, PDO::PARAM_STR);
        $up_feedback->bindParam(':id', $id, PDO::PARAM_INT);

        if ($up_feedback->execute()) {
            // Redirect upon successful submission
            echo '<script>alert("Feedback  saved.");</script>';

            header("Location: index.php?feedback");
            exit();
        } else {
            // Handle errors
            $error_message = "Feedback not saved: " . $up_feedback->errorInfo()[2];
            // Log the error instead of showing to the user
            error_log($error_message);
            echo '<script>alert("Feedback not saved. Please try again later.");</script>';
        }
    }
} else {
    // Redirect if session variables are not set
    header("Location: index.php?feedback");
    exit();
}
?>
