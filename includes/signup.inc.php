
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {

  require_once 'dbh.inc.php';

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmpassword = $_POST['confirmpassword'];

  if (empty($username) || empty($email) || empty($password) || empty($confirmpassword)) {
    header("Location: ../signup.php?error=emptyfields");
    exit();
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invalidemail");
    exit();
  }

  if ($password !== $confirmpassword) {
    header("Location: ../signup.php?error=passwordmismatch");
    exit();
  }

  $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $sql);
  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) > 0) {
    header("Location: ../signup.php?error=userexists");
    exit();
  }

  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

  $sql2 = "INSERT INTO users (username, email, password) VALUES (?, ?, ?);";
  $stmt2 = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt2, $sql2);
  mysqli_stmt_bind_param($stmt2, "sss", $username, $email, $hashedPwd);
  mysqli_stmt_execute($stmt2);

  header("Location: ../login.php?signup=success");
  exit();

} else {
  header("Location: ../signup.php");
  exit();
}