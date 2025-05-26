<?php
  include './partials/header.php';
  $user_id = $_GET['id'] ?? null;

  if (!$user_id || !is_numeric($user_id)) {
    header("Location: index.php");
    exit();
  }

  $query = "SELECT * FROM users WHERE id = $user_id";
  $result = mysqli_query($connection, $query);
  $user = mysqli_fetch_assoc($result);

  if (!$user) {
    header("Location: index.php");
    exit();
  }
?>

<div class="container mt-5">
  <h5 class="mb-3">Edit User Info</h5>
  <form method="POST" action="./process/edit_user.php">
  <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id'])?>">
    <div class="mb-3">
      <label for="firstName" class="form-label">First Name</label>
      <input type="text" class="form-control" name="firstName" id="firstName" value="<?= htmlspecialchars($user['firstName'])?>" required>
    </div>
    <div class="mb-3">
      <label for="lastName" class="form-label">Last Name</label>
      <input type="text" class="form-control" name="lastName" id="lastName" value="<?= htmlspecialchars($user['lastName'])?>" required>
    </div>
    <div class="mb-3">
      <label for="age" class="form-label">Age</label>
      <input type="number" class="form-control" name="age" min="0" max="100" id="age" value="<?= htmlspecialchars($user['age'])?>" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($user['email'])?>" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Save</button>
  </form>  
</div>



<?php
  include './partials/footer.php';
?>