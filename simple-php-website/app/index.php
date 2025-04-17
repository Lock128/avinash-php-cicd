<?php
require 'db.php';
$users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">

<div class="card shadow-sm">
  <div class="card-body">
    <h2 class="mb-4">User Management</h2>
    <a href="create.php" class="btn btn-primary mb-3">Add New User</a>
    <table class="table table-bordered table-striped">
      <thead class="table-light">
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <?php if (count($users)): ?>
          <?php foreach ($users as $user): ?>
            <tr>
              <td><?= $user['id'] ?></td>
              <td><?= htmlspecialchars($user['name']) ?></td>
              <td><?= htmlspecialchars($user['email']) ?></td>
              <td>
                <a href="update.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
              </td>
            </tr>
          <?php endforeach ?>
        <?php else: ?>
          <tr><td colspan="4" class="text-center">No users found.</td></tr>
        <?php endif ?>
      </tbody>
    </table>
  </div>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
