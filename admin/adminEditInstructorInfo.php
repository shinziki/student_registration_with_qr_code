<?php
require_once "adminCRUD/db.php";

$instructorId = isset($_GET['id']) ? $_GET['id'] : '';

if ($instructorId === '') {
    die("No student ID provided.");
}

// Fetch student details
$stmt = $conn->prepare("SELECT * FROM instructors WHERE id = ?");
$stmt->bind_param("i", $instructorId);
$stmt->execute();
$result = $stmt->get_result();
$instructor = $result->fetch_assoc();
$stmt->close();

if (!$instructor) {
    die("Instructor not found.");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Edit Instructor</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body class="bg-light">
        <div class="container mt-5">
            <h1 class="text-center mb-4">Edit Instructor</h1>
            <div class="row justify-content-center">
                <div class="col-md-6">
                  <form action="adminCRUD/update_instructor.php" method="post">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($instructor['id']) ?>">

                    <div class="mb-3">
                      <label class="form-label">First Name</label>
                      <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($instructor['first_name']) ?>" required>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Last Name</label>
                      <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($instructor['last_name']) ?>" required>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Age</label>
                      <input type="number" name="age" class="form-control" value="<?= htmlspecialchars($instructor['age']) ?>" required>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Birthday</label>
                      <input type="date" name="birthday" class="form-control" value="<?= htmlspecialchars($instructor['birthday']) ?>" required>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($instructor['email']) ?>" required>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Contact Number</label>
                      <input type="text" name="contact_number" class="form-control" value="<?= htmlspecialchars($instructor['contact_number']) ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="adminViewInstructorList.php" class="btn btn-secondary">Cancel</a>
                  </form>
                </div>
            </div>
        </div>
    </body>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function openQRCodeScanner() {
            window.location.href = "scanQRCode.html";
        }

        function openAttendance() {
            window.location.href = "recordAttendance.php";
        }
    </script>
</html>