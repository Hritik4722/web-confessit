<?php
session_start();
require_once "Connectdb64.php";

if (!isset($_SESSION["user"]) || !isset($_POST["confession_id"])) {
  header("Location: home.php");
  exit();
}

$confession_id = $_POST["confession_id"];
$user_sr_no = $_SESSION["sr_no"];


$check_sql = "SELECT * FROM confession WHERE id = ? AND sr_no = ?";
$stmt = mysqli_prepare($conn, $check_sql);
mysqli_stmt_bind_param($stmt, "ii", $confession_id, $user_sr_no);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1'><title>Deleting...</title>";
echo "<link rel='stylesheet' href='css/foot_nav.css'>"; 
echo "</head><body>";

if (mysqli_num_rows($result) > 0) {
  
  mysqli_query($conn, "DELETE FROM comments WHERE confession_id = $confession_id");
  mysqli_query($conn, "DELETE FROM confession_likes WHERE confession_id = $confession_id");
  mysqli_query($conn, "DELETE FROM confession WHERE id = $confession_id");

  echo "<div class='alert alert-success'> Confession deleted successfully. Redirecting...</div>";
} else {
  echo "<div class='alert alert-danger'> Unauthorized or confession not found.</div>";
}

echo "<script>setTimeout(function() { window.location.href = 'home.php'; }, 1300);</script>";
echo "</body></html>";
exit();

