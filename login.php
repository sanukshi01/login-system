<?php
  include_once 'header.php';
?>

<section class="signup-form">
  <h2>Log In</h2>

  <?php
if (isset($_GET['error'])) {
  $error = $_GET['error'];
  echo "<p class='error-msg' style='color: red; font-weight: bold; font-size: 20px;'>";
  switch ($error) {
    case 'emptyfields':
      echo "Please fill in all fields.";
      break;
    case 'nouser':
      echo "No account found with that username/email.";
      break;
    case 'wrongpassword':
      echo "Incorrect password.";
      break;
    case 'sqlerror':
      echo "Something went wrong. Please try again.";
      break;
    default:
      echo "Something went wrong. Please try again.";
  }
  echo "</p>";
}
?>

  <div class="signup-form-form">
    <form action="includes/login.inc.php" method="post">
      <input type="text" name="name" placeholder="Usernam/Email...">
      <input type="password" name="pwd" placeholder="Password...">
      <button type="submit" name="submit">Log In</button>
    </form>
  </div>
</section>

<?php
  include_once 'footer.php';
?>