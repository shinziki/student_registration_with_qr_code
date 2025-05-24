<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">

    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
      <div class="text-center mb-4">
        <h2 class="mb-4">Change Password</h2>
      </div>

      <form action="instructorCRUD/update_password.php" method="post" class="w-100" style="max-width: 400px;">
        <div class="mb-3">
          <label class="form-label">Old Password</label>
          <input type="password" name="old_password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">New Password</label>
          <input type="password" name="new_password" class="form-control" required>
        </div> 

        <button type="submit" class="btn btn-primary w-100 mb-2">Update Password</button>
        <a href="instructorIndex.php" class="btn btn-secondary w-100">Cancel</a>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
