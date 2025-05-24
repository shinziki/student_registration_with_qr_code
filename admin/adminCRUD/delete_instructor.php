<?php
require_once "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM instructors WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../adminViewInstructorList.php?msg=deleted");
    } else {
        echo "Error deleting attendance record.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No attendance ID provided.";
}
?>
