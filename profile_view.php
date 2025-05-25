<?php
require_once "Connectdb64.php";

if (!isset($_GET["user"])) {
  echo "User not found!";
  exit();
}

$username = $_GET["user"];

$sql = "SELECT *, DATE_FORMAT(time, '%d/%b/%y') AS formatted_date, DATE_FORMAT(time, '%H:%i:%s') AS formatted_time 
        FROM confession 
        WHERE username = ? AND type = 'public' 
        ORDER BY time DESC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


$gender = "male";
if ($rowTemp = mysqli_fetch_assoc($result)) {
  $gender = $rowTemp["gender"];
  mysqli_data_seek($result, 0); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($username) ?>'s Confessions</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <?php include('faviconh.php'); ?>
  <link rel="stylesheet" href="css/profile_view.css">
</head>
<body>

  <div class="profile-header">
    <div class="back-btn">
      <img src="img/back_btn.svg" alt="back" onclick="window.location.href='home.php';">
    </div>
    <img class="img-prf" src="img/<?= $gender === 'female' ? 'avatarf.png' : 'avatar.png' ?>" alt="User">
    <div class="info">
      <h2>@<?= htmlspecialchars($username) ?></h2>
      <span><?= ucfirst($gender) ?></span>
    </div>
  </div>

  <div class="confession_home">
    <?php
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='confession_d'>";
        echo "<div class='con_mes'>";
        $id = $row["id"];
        $confession = htmlspecialchars($row["confession"]);
        $short = substr($confession, 0, 200);
        echo "<a href='confess_view.php?id=$id'><p2>";
        echo (strlen($confession) > 200) ? "$short... <strong style='color:#007bff'>Read more</strong>" : $confession;
        echo "</p2></a>";
        echo "</div>";
        echo "<div class='reaction'>";
        echo "<span>❤️ {$row['likes']}</span>";
        echo "<span>👁️ {$row['views']}</span>";
        echo "<span>{$row['formatted_date']} | {$row['formatted_time']}</span>";
        echo "</div>";
        echo "</div>";
      }
    } else {
      echo "<center>No public confessions by this user.</center>";
    }
    ?>
  </div>

</body>
</html>
