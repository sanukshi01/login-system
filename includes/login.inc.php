<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  

  $username = $_POST['name'];
  $password = $_POST['pwd'];

  login ($conn, $username, $password);

} else {
  header("Location: ../login.php");
  exit();
}