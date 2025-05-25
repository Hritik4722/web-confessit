<?php
session_start();
require_once "Connectdb64.php";

if (!isset($_SESSION["sr_no"]) || !isset($_POST["id"])) {
  echo json_encode(["error" => "Unauthorized"]);
  exit();
}

$confession_id = $_POST["id"];
$user_sr_no = $_SESSION["sr_no"];


$check = "SELECT * FROM confession_likes WHERE confession_id = ? AND user_sr_no = ?";
$stmt = mysqli_prepare($conn, $check);
mysqli_stmt_bind_param($stmt, "ii", $confession_id, $user_sr_no);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($res) > 0) {

  $del = "DELETE FROM confession_likes WHERE confession_id = ? AND user_sr_no = ?";
  $stmt = mysqli_prepare($conn, $del);
  mysqli_stmt_bind_param($stmt, "ii", $confession_id, $user_sr_no);
  mysqli_stmt_execute($stmt);

  mysqli_query($conn, "UPDATE confession SET likes = likes - 1 WHERE id = $confession_id");
  $liked = false;
} else {

  $insert = "INSERT INTO confession_likes (confession_id, user_sr_no) VALUES (?, ?)";
  $stmt = mysqli_prepare($conn, $insert);
  mysqli_stmt_bind_param($stmt, "ii", $confession_id, $user_sr_no);
  mysqli_stmt_execute($stmt);

  mysqli_query($conn, "UPDATE confession SET likes = likes + 1 WHERE id = $confession_id");
  $liked = true;
}


$likes = mysqli_query($conn, "SELECT likes FROM confession WHERE id = $confession_id");
$count = mysqli_fetch_assoc($likes)["likes"];
echo json_encode(["liked" => $liked, "likes" => $count]);
?>



