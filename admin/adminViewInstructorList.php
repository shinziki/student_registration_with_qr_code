<?php if (isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
  <div class="alert alert-success text-center" role="alert">
    Instructor info successfully updated!
  </div>
<?php endif; ?>

<?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
  <div class="alert alert-danger text-center" role="alert">
    Instructor data deleted successfully.
  </div>
<?php endif; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Instructors List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
  <div class="container mt-5">

    <h2 class="text-center mb-4">Instructors List</h2>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No.</th>
            <th>Full Name</th>
            <th>Age</th>
            <th>Birthday</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once "adminCRUD/db.php";

          $sql = "
            SELECT 
                id, 
                CONCAT(first_name, ' ', last_name) AS fullName, 
                age, 
                birthday, 
                email,
                contact_number
            FROM 
                instructors";

          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>{$row['id']}</td>
                      <td>{$row['fullName']}</td>
                      <td>{$row['age']}</td>
                      <td>{$row['birthday']}</td>
                      <td>{$row['email']}</td>
                      <td>{$row['contact_number']}</td>
                      <td>
                        <a href='adminEditInstructorInfo.php?id={$row['id']}' class='btn btn-sm btn-warning me-2'>Edit</a>
                        <a href='adminCRUD/delete_instructor.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this instructor data?\")'>Delete</a>
                      </td>
                    </tr>"; 
            }
          } else {
            echo "<tr><td colspan='7'>No attendance records found.</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>

    <div class="mt-4 text-center">
            <button onclick="backToAdminPanel()" class="btn btn-info mt-2">Go Back to Admin Panel</button>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

<script>
  function backToAdminPanel() {
      window.location.href = "adminIndex.html";
  }
</script>
</html>