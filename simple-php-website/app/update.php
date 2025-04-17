<?php
require 'db.php';
$id = $_GET['id'];
$user = $pdo->query("SELECT * FROM users WHERE id=$id")->fetch(PDO::FETCH_ASSOC);
if ($_POST) {
    $stmt = $pdo->prepare("UPDATE users SET name=?, email=? WHERE id=?");
    $stmt->execute([$_POST['name'], $_POST['email'], $id]);
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">

<div class="card shadow-sm">
  <div class="card-body">
    <h2 class="mb-4">Edit User</h2>
    <form method="post">
      <div class="mb-3">
        <label class="form-label">Name</label>
        <input name="name" type="text" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input name="email" type="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
