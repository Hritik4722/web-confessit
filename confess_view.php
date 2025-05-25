<?php
session_start();
require_once "Connectdb64.php";

$isLoggedIn = isset($_SESSION["user"]);
$user_sr_no = $isLoggedIn ? $_SESSION["sr_no"] : null;


if (!isset($_GET["id"])) {
  echo "Confession not found!";
  exit();
}

$id = $_GET["id"];
$sql = "SELECT *, DATE_FORMAT(time, '%d %b %Y') AS date, DATE_FORMAT(time, '%H:%i:%s') AS time FROM confession WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
  $confession = htmlspecialchars($row["confession"]);
  $username = $row["username"];
  $category = $row["category"];
  $gender = $row["gender"];
  $date = $row["date"];
  $time = $row["time"];
  $views = $row["views"];
  $confessor_sr_no = $row["sr_no"];

  
  $updateViews = "UPDATE confession SET views = views + 1 WHERE id = ?";
  $stmtViews = mysqli_prepare($conn, $updateViews);
  mysqli_stmt_bind_param($stmtViews, "i", $id);
  mysqli_stmt_execute($stmtViews);


  $hasLiked = false;
  if ($isLoggedIn) {
    $liked_sql = "SELECT * FROM confession_likes WHERE confession_id = ? AND user_sr_no = ?";
    $liked_stmt = mysqli_prepare($conn, $liked_sql);
    mysqli_stmt_bind_param($liked_stmt, "ii", $id, $user_sr_no);
    mysqli_stmt_execute($liked_stmt);
    $liked_result = mysqli_stmt_get_result($liked_stmt);
    $hasLiked = mysqli_num_rows($liked_result) > 0;
  }


  $likeCountRes = mysqli_query($conn, "SELECT likes FROM confession WHERE id = $id");
  $likeCount = mysqli_fetch_assoc($likeCountRes)["likes"];
} else {
  echo "Confession not found!";
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Confession by <?= $username ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <?php include('faviconh.php'); ?>
  <link rel="stylesheet" href="css/confess_view.css">
  <link rel="stylesheet" href="css/foot_nav.css">
</head>

<body>
  <nav>
    <img src="img/back_btn.svg" alt="back" onclick="window.location.href='home.php';">
  </nav>

  <div class="container-con">
    <div class="confession-box">
      <div class="confession-header">
        <h2><?= $category ?> by <?= $username ?></h2>

        <?php if ($isLoggedIn): ?>
          <button id="like-btn" class="<?= $hasLiked ? 'liked' : '' ?>">
            <?= $hasLiked ? '<img src="img/like.svg" alt="like">' : '<img src="img/unlike.svg" alt="unlike">' ?>

          </button>
        <?php endif; ?>


      </div>

      <small><?= $date ?> at <?= $time ?> | <?= ucfirst($gender) ?></small>
      <div class="paragraph"><?= nl2br($confession) ?></div>

      <div class="reaction">
        <div class="like-section">
          <span id="like-count"><?= $likeCount ?></span> <img src="img/like.svg" alt="like">
        </div>
        <div class="view-section">
          <span id="view-count"><?= $views ?></span> 👁️
        </div>
        <div class="share-box">
          <img src="img/share.svg" width="20px" class="share-btn" onclick="nativeShare()">
        </div>
        <?php if ($isLoggedIn && $user_sr_no == $confessor_sr_no): ?>
          <form action="delete_confession.php" method="POST" style="display:inline;">
            <input type="hidden" name="confession_id" value="<?= $id ?>">
            <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this confession?')">Delete</button>
          </form>
        <?php endif; ?>

      </div>
    </div>

    <div class="comments">
      <?php if ($isLoggedIn): ?>
        <form method="POST" action="post_comment.php">
          <input type="hidden" name="confession_id" value="<?= $id ?>">
          <textarea name="comment" placeholder="Write your thoughts..." required></textarea>
          <input type="submit" value="Post your Thought">
        </form>
      <?php else: ?>
        <p>
          <center><em>Login to interact. <a href="login.php">Log in</a></em></center>
        </p>
      <?php endif; ?>
      <br>
      <h3>Thoughts</h3>
      <?php
      $sql_comments = "SELECT * FROM comments WHERE confession_id = ? ORDER BY time DESC";
      $stmt = mysqli_prepare($conn, $sql_comments);
      mysqli_stmt_bind_param($stmt, "i", $id);
      mysqli_stmt_execute($stmt);
      $comments_result = mysqli_stmt_get_result($stmt);

      while ($comment = mysqli_fetch_assoc($comments_result)) {
        $commentText = htmlspecialchars($comment["text"]);
        $commentUser = htmlspecialchars($comment["username"]);

        if (strlen($commentText) > 150) {
          $short = substr($commentText, 0, 150);
          echo "<div class='comment'>";
          echo "<strong>{$commentUser}</strong>: ";
          echo "<span class='comment-short'>{$short}...</span>";
          echo "<span class='comment-full' style='display:none;'>{$commentText}</span>";
          echo "<button class='read-more-btn'>Read more</button>";
          echo "</div>";
        } else {
          echo "<div class='comment'><strong>{$commentUser}</strong>: {$commentText}</div>";
        }
      }
      ?>
    </div>
  </div>

  <script src="js/confess_view.js"></script>
</body>

</html>