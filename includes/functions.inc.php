<?php

function signup($conn, $username, $email, $password, $confirmpassword) {

  // Check empty fields
  if (empty($username) || empty($email) || empty($password) || empty($confirmpassword)) {
    header("Location: ../signup.php?error=emptyfields");
    exit();
  }

  // Check valid email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invalidemail");
    exit();
  }

  // Check username length (3-20 characters)
  if (strlen($username) < 3 || strlen($username) > 20) {
    header("Location: ../signup.php?error=invalidusernamelength");
    exit();
  }

  // Check username only contains letters, numbers, underscores
  if (!preg_match("/^[a-zA-Z0-9_]*$/", $username)) {
    header("Location: ../signup.php?error=invalidusername");
    exit();
  }

  // Check password length (at least 8 characters)
  if (strlen($password) < 8) {
    header("Location: ../signup.php?error=passwordtooshort");
    exit();
  }

  // Check password has at least one number
  if (!preg_match("/[0-9]/", $password)) {
    header("Location: ../signup.php?error=passwordnonumber");
    exit();
  }

  // Check password has at least one uppercase letter
  if (!preg_match("/[A-Z]/", $password)) {
    header("Location: ../signup.php?error=passwordnouppercase");
    exit();
  }

  // Check passwords match
  if ($password !== $confirmpassword) {
    header("Location: ../signup.php?error=passwordmismatch");
    exit();
  }

  // Check if username or email already exists
  $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../signup.php?error=sqlerror");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row['username'] === $username) {
      header("Location: ../signup.php?error=usernametaken");
    } else {
      header("Location: ../signup.php?error=emailtaken");
    }
    exit();
  }

  // Hash password and insert into database
  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

  $sql2 = "INSERT INTO users (username, email, password) VALUES (?, ?, ?);";
  $stmt2 = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt2, $sql2)) {
    header("Location: ../signup.php?error=sqlerror");
    exit();
  }
  mysqli_stmt_bind_param($stmt2, "sss", $username, $email, $hashedPwd);
  mysqli_stmt_execute($stmt2);

  header("Location: ../login.php?signup=success");
  exit();
}

function login($conn, $username, $password) {

  // Check empty fields
  if (empty($username) || empty($password)) {
    header("Location: ../login.php?error=emptyfields");
    exit();
  }

  // Check if username or email exists
  $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../login.php?error=sqlerror");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ss", $username, $username);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

  if (mysqli_num_rows($result) < 1) {
    header("Location: ../login.php?error=nouser");
    exit();
  }

  // Verify password against stored hash
  $hashedPwdCheck = password_verify($password, $row['password']);

  if ($hashedPwdCheck === false) {
    header("Location: ../login.php?error=wrongpassword");
    exit();
  } elseif ($hashedPwdCheck === true) {
    session_start();
    $_SESSION['userId'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    header("Location: ../index.php?login=success");
    exit();
  }
}