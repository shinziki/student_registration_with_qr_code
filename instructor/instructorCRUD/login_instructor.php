<?php
require_once "db.php";

// Get POST data
$username = $_POST['username'];
$password = $_POST['password'];

// Insert into database
$sql = "SELECT * FROM instructors WHERE username = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $instructor = $result->fetch_assoc();
    // Verify password using password_verify since passwords are hashed
    if (password_verify($password, $instructor['password'])) {
        session_start();
        $_SESSION['instructor_id'] = $instructor['id'];
        $_SESSION['username'] = $instructor['username'];
        $_SESSION['first_name'] = $instructor['first_name'];
        $_SESSION['last_name'] = $instructor['last_name'];

        // Redirect to instructor dashboard or home page
        // header("Location: ../instructorDashboard.html");
        // exit();
        echo "<script>
            alert('Successfully Logged On!');
            window.location.href = '../instructorIndex.php';
        </script>";
    } else {
        echo "<script>
            alert('Invalid username or password.');
            window.history.back();
        </script>";
    }
} else {
    echo "<script>
        alert('Username not found.');
        window.history.back();
    </script>";
}

$stmt->close();
$conn->close();
?>
