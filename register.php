<?php
  include './partials/header.php';

?>

<main class="container w-100 mt-5 p-5">
  <form method="POST" action="./process/register_user.php">
    <h1 class="h3 mb-3 fw-normal">Register</h1>
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
    <div class="form-floating mb-3">
      <input type="text" class="form-control" name="username" id="floatingUsername" placeholder="username123">
      <label for="floatingUsername">Username</label>
    </div>

    <div class="form-floating mb-3">
      <input type="email" class="form-control" name="email" id="floatingEmail" placeholder="name@example.com">
      <label for="floatingEmail">Email address</label>
    </div>
    
    <div class="form-floating mb-3">
      <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="form-floating mb-3">
      <input type="password" class="form-control" name="confirmpassword" id="floatingConfirmPassword" placeholder="Password">
      <label for="floatingConfirmPassword">Confirm Password</label>
    </div>
    
    <button class="btn btn-primary w-100 py-2" type="submit">Register</button>
    <p class="mt-3"><a href="./login.php">Login</a> here!</p>
  </form>
</main>








<?php
  include './partials/footer.php';
?>