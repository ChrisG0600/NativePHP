<?php
  include './partials/header.php';

  if(!isset($_SESSION['user_id'])) {
    header('Location: ./login.php');
    exit();
  }

?>


<?php if(isset($_SESSION['success'])) : ?>
  <div class="container d-flex align-items-center justify-content-end mt-5">
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
      <?= $_SESSION['success']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['success']); ?>
  </div>
<?php endif ?>

<?php if(isset($_SESSION['user_id'])) :?>
  <div class="container d-flex align-items-center justify-content-end mt-5">
    <a href="./login.php" role="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Logout</a>
  </div>
<?php endif ?>
  <!-- Button trigger modal -->
  <div class="container">
    <div class="d-flex align-items-center justify-content-end mt-5">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Addd New User
      </button>    
    </div>

    <table class="table mt-5 table-hover">
      <thead class="table-secondary">
        <tr>
          <th scope="col">No</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Age</th>
          <th scope="col">Email</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $query = "SELECT * FROM users";
          $result = mysqli_query($connection, $query);
        ?>
        <?php if(mysqli_num_rows($result) > 0) : ?>
          <?php while($user = mysqli_fetch_assoc($result)) : ?>
            <tr class="table-light">
              <td><?= $user['id']?></td>
              <td><?= $user['firstName']?></td>
              <td><?= $user['lastName']?></td>
              <td><?= $user['age']?></td>
              <td><?= $user['email']?></td>
              <td>
                <div class="d-flex gap-2">
                  <a href="./user-edit.php?id=<?= $user['id']?>" class="btn btn-sm btn-primary">Edit</a>
                  <form action="./process/delete_user.php" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="id" value="<?= $user['id']?>">
                    <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                  </form>
                </div>
              </td>
            </tr>            
          <?php endwhile ?>
        <?php else : ?>
          <tr>
            <td colspan="6" class="text-center">No users found</td>
          </tr>
        <?php endif ?>
      </tbody>
    </table>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add New User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="./process/create_user.php">
          <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
            <div class="mb-3">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" class="form-control" name="firstName" id="firstName" required>
            </div>
            <div class="mb-3">
              <label for="lastName" class="form-label">Last Name</label>
              <input type="text" class="form-control" name="lastName" id="lastName" required>
            </div>
            <div class="mb-3">
              <label for="age" class="form-label">Age</label>
              <input type="number" class="form-control" name="age" min="0" max="100" id="age" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>




<?php
  include './partials/footer.php';
?>