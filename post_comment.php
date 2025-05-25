<?php
session_start();
require_once "Connectdb64.php";

if (!isset($_SESSION["user"]) || !isset($_POST["confession_id"]) || empty($_POST["comment"])) {
  header("Location: login.php");
  exit();
}

$user = $_SESSION["user"];
$confession_id = $_POST["confession_id"];
$comment = htmlspecialchars(trim($_POST["comment"]));
if (empty($comment)) {
  header("Location: confess_view.php?id=" . $confession_id);
  exit();
} else {
  $sql = "INSERT INTO comments (confession_id, username, text, time) VALUES (?, ?, ?, NOW())";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "iss", $confession_id, $user, $comment);
  mysqli_stmt_execute($stmt);

  header("Location: confess_view.php?id=" . $confession_id);
  exit();
}
