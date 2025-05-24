<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $contactNumber = $_POST['contact_number'];

    $stmt = $conn->prepare("UPDATE 
                                instructors
                            SET 
                                first_name = ?, 
                                last_name = ?, 
                                age = ?, 
                                birthday = ?, 
                                email = ?, 
                                contact_number = ?
                            WHERE 
                                id = ?");
    $stmt->bind_param("ssisssi", $firstName, $lastName, $age, $birthday, $email, $contactNumber, $id);

    if ($stmt->execute()) {
        header("Location: ../adminViewInstructorList.php?msg=updated");
    } else {
        echo "Failed to update record.";
    }

    $stmt->close();
    $conn->close();
}
?>
