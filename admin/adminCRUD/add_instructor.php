<?php
require_once "db.php";

// Get POST data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$contact_number = $_POST['contact_number'];
$age = $_POST['age'];
$birthday = $_POST['birthday'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insert into database
$sql = "INSERT INTO instructors (first_name, last_name, age, birthday, email, contact_number, username, password)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisssss", $first_name, $last_name, $age, $birthday, $email, $contact_number, $username, $password);

if ($stmt->execute()) {
    echo "<script>
        alert('Instructor added successfully.');
        window.location.href = '../adminIndex.html';
    </script>";
} else {
    echo "<script>
        alert('Failed to add instructor. Try again.');
        window.history.back();
    </script>";
}

$stmt->close();
$conn->close();
?>
