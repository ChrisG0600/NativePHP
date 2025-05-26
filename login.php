<?php
  include './partials/header.php';

?>
<?php if(isset($_SESSION['success'])) : ?>
  <div class="container d-flex align-items-center justify-content-end mt-5">
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
      <?= $_SESSION['success']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['success']); ?>
  </div>
<?php elseif(isset($_SESSION['login-error'])) : ?>
  <div class="container d-flex align-items-center justify-content-end mt-5">
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
      <?= $_SESSION['login-error']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['login-error']); ?>
  </div>
<?php endif ?>

<main class="container w-100 mt-5 p-5">
  <form method="POST" action="./process/login_user.php">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
    <div class="form-floating mb-3">
      <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    
    <div class="form-floating mb-3">
      <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    
    <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
    <p class="mt-3">Don't have an account? <a href="./register.php">Register</a> here.</p>
  </form>
</main>








<?php
  include './partials/footer.php';
?>