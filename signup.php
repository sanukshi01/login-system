<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign Up - PHP Project 01</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

    <nav>
      <div class="wrapper">
        <a href="index.php" class="logo">Blogs</a>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="discover.php">About Us</a></li>
          <li><a href="blog.php">Find Blogs</a></li>
          <li><a href="signup.php">Sign up</a></li>
          <li><a href="login.php">Log in</a></li>
        </ul>
      </div>
    </nav>

    <section class="form-section">
      <div class="wrapper">
        <h1>Create an Account</h1>

        <?php
        // Show error message if any
        if (isset($_GET['error'])) {
          $error = $_GET['error'];
          echo "<p class='error-msg'>";
          if ($error == 'emptyfields') {
            echo "Please fill in all fields.";
          } elseif ($error == 'invalidemail') {
            echo "Please enter a valid email address.";
          } elseif ($error == 'passwordmismatch') {
            echo "Passwords do not match.";
          } elseif ($error == 'userexists') {
            echo "Username or email already exists.";
          } elseif ($error == 'sqlerror') {
            echo "Something went wrong. Please try again.";
          }
          echo "</p>";
        }
        ?>

        <form action="includes/signup.inc.php" method="post" class="auth-form">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" placeholder="Enter your username">

          <label for="email">Email</label>
          <input type="email" name="email" id="email" placeholder="Enter your email">

          <label for="password">Password</label>
          <input type="password" name="password" id="password" placeholder="Enter your password">

          <label for="confirmpassword">Confirm Password</label>
          <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Re-enter your password">

          <button type="submit" name="submit">Sign Up</button>
        </form>

        <p class="form-footer">Already have an account? <a href="login.php">Log in here</a></p>
      </div>
    </section>

  </body>
</html>