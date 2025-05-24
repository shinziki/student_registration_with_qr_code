<?php
session_start();
if (!isset($_SESSION['instructor_id'])) {
    header("Location: instructorlogin.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instructor Panel</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">

    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
      <div class="text-center mb-4">
        <h1 class="fw-bold">Hello, <?php echo $_SESSION['first_name'].' '.$_SESSION['last_name']; ?></h1>
      </div>

      <div class="d-grid gap-3 col-6 mx-auto">
        <button class="btn btn-primary btn-lg" onclick="addInstructor()">Change Password</button>
        <button class="btn btn-success btn-lg" onclick="scanQRCode()">Scan QR Code</button>
        <button class="btn btn-dark btn-lg" onclick="adminLogout()">Logout</button>
      </div>
    </div>

    <!-- Bootstrap JS Bundle (if you need JS for any components later) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function addInstructor() {
            window.location.href = "instructorPasswordChange.php";
        }

        function adminLogout() {
            window.location.href = "../index.html";
        }

        function scanQRCode() {
            window.location.href = "scanQRCode.html";
        }
    </script>
  </body>
</html>
