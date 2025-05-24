<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get instructor_id from session instead of POST
    $instructor_id = $_SESSION['instructor_id'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Debug information - display on screen
    // echo "Debug Information:<br>";
    // echo "Instructor ID: " . $instructor_id . "<br>";
    // echo "Old Password Entered: " . $old_password . "<br>";

    // Get instructor's current password
    $stmt = $conn->prepare("SELECT * FROM instructors WHERE id = ?");
    $stmt->bind_param("i", $instructor_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $instructor = $result->fetch_assoc();

    // More debug information
    // echo "Instructor found: " . ($instructor ? "Yes" : "No") . "<br>";
    // echo "Hashed password from DB: " . $instructor['password'] . "<br>";
    // echo "Password verify result: " . (password_verify($old_password, $instructor['password']) ? "Match" : "No Match") . "<br>";

    // Add a delay to see the debug info
    // sleep(5);

    // Verify if old password matches
    if (password_verify($old_password, $instructor['password'])) {
        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        $update_stmt = $conn->prepare("UPDATE instructors SET password = ? WHERE id = ?");
        $update_stmt->bind_param("si", $hashed_new_password, $instructor_id);
        
        if ($update_stmt->execute()) {
            echo "<script>
                alert('Password updated successfully!');
                window.location.href = '../instructorIndex.php';
            </script>";
        } else {
            echo "<script>
                alert('Failed to update password.');
                window.history.back();
            </script>";
        }
        $update_stmt->close();
    } else {
        echo "<script>
            setTimeout(function() {
                alert('Current password is incorrect!');
                window.history.back();
            }, 5000);
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
