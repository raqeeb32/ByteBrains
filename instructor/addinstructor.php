<?php
include("inc/db_con.php");
?>
<?php
// Start or resume session
session_start();

function addinst() {
    global $conn;

    // Check if the form was submitted
    if (isset($_POST['ins-btn'])) {
        // Set a session variable to indicate that the form has been submitted
        $_SESSION['form_submitted'] = true;

        // Check if all required fields are set and not empty
        if (!empty($_POST['insName']) && !empty($_POST['insEmail']) && !empty($_POST['insPass'])) {
            $insName = $_POST['insName'];
            $insEmail = $_POST['insEmail'];
            $insPass = $_POST['insPass'];

            $sql = $conn->prepare("SELECT email FROM instructor WHERE email=:insEmail");
            $sql->bindParam(':insEmail', $insEmail);
            $sql->execute();
            $row = $sql->rowCount();
            if ($row != 0) {
                echo "<script> alert('Email already exists'); </script>";
            }
         else {
                try {
                    // Prepare the SQL statement
                    $sql = $conn->prepare("INSERT INTO instructor (name, email, password) VALUES (:insName, :insEmail, :insPass)");
                    $sql->bindParam(':insName', $insName);
                    $sql->bindParam(':insEmail', $insEmail);
                    $sql->bindParam(':insPass', $insPass);

                    // Execute the SQL statement
                    $result = $sql->execute();

                    // Check if the insertion was successful
                    if ($result) {
                        // Show alert
                        echo "<script> alert('Inserted'); </script>";
                        // Redirect to instructorSignup.php
                        echo "<script>window.location.href = '../instructorSignup.php';</script>";
                        exit(); // Stop script execution after redirection
                    } else {
                        echo "<script> alert('Not Inserted'); </script>";
                    }
                } catch (PDOException $e) {
                    // Handle database errors
                    echo "Error: " . $e->getMessage();
                }
            }
        } else {
            // Show error if required fields are not filled
            echo "<script> alert('All fields are required'); </script>";
        }
    } else {
        
            echo "<script> alert('All fields are required'); </script>";
        }
    
}
?>

