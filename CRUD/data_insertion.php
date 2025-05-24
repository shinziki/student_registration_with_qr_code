<?php
require_once "db.php";

// Count entries and generate student_id
$result = $conn->query("SELECT COUNT(*) AS total FROM data");
$row = $result->fetch_assoc();
$ID = $row['total'] + 1;

$student_id = "2025-" . str_pad($ID, 4, "0", STR_PAD_LEFT);
$fullName = $_POST['fullName'];

// Insert into DB
$sql = "INSERT INTO data (student_id, fullName) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $student_id, $fullName);

if ($stmt->execute()) {
    // // QR Code Generation (embed the student ID or URL/data in it)
    // $qrData = urlencode($student_id);
    // $qrCodeURL = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={$qrData}";

    // QR Code Generation (save to server)
    $qrData = $student_id;
    $qrFilename = "../qrcodes/{$student_id}.png"; // specify save location
    
    // Generate QR code and save locally
    file_put_contents($qrFilename, file_get_contents("https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={$qrData}"));

    // echo "<h3>Registration Successful!</h3>";
    // echo "<p><strong>Student ID:</strong> $student_id</p>";
    // echo "<p><strong>Name:</strong> $fullName</p>";
    // echo "<p><strong>QR Code:</strong></p>";
    // echo "<img src='../qrcodes/{$student_id}.png' alt='QR Code'>";

    // echo "<br>";
    // echo "<a href='download_qr.php?file={$student_id}.png' class='btn btn-success'>Download QR Code</a>";

    // echo "<br>";
    // echo "<br>";
    // echo "<a href='../index.html'>Go Back To Register</a>";

    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Registration Successful</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <div class="card-body text-center">
                <h3 class="card-title text-success mb-4">🎉 Registration Successful!</h3>
                <p class="fs-5"><strong>Student ID:</strong> ' . $student_id . '</p>
                <p class="fs-5"><strong>Name:</strong> ' . htmlspecialchars($fullName) . '</p>
                <p class="mt-4"><strong>QR Code:</strong></p>
                <img src="../qrcodes/' . $student_id . '.png" alt="QR Code" class="mb-3" style="width: 150px; height: 150px;">
                
                <div class="d-grid gap-2 col-6 mx-auto mt-4">
                    <a href="download_qr.php?file=' . $student_id . '.png" class="btn btn-success">📥 Download QR Code</a>
                    <a href="../index.html" class="btn btn-primary">🔙 Go Back To Register</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    ';
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
