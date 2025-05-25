<?php
session_start();
require_once "Connectdb64.php";

$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;
$limit = 10;

$sql = "SELECT *, DATE_FORMAT(time, '%d/%b/%y') AS formatted_date, DATE_FORMAT(time, '%H:%i:%s') AS formatted_time 
        FROM confession 
        WHERE type = 'public' 
        ORDER BY time DESC 
        LIMIT $limit OFFSET $start";

$result = mysqli_query($conn, $sql);
while ($roww = mysqli_fetch_assoc($result)) {
  $id = $roww["id"];
  $full = htmlspecialchars($roww["confession"]);
  $short = substr($full, 0, 200);

  echo "<div class='confession_d'>";
  echo "<a href='profile_view.php?user=" . urlencode($roww["username"]) . "'>";
  echo "<div class='prf_img'><div class='prf_d1'>";
  echo $roww["gender"] === "male"
    ? "<img src='img/avatar.png' width='100%'>"
    : "<img src='img/avatarf.png' width='100%'>";
  echo "</div><div class='header_con'><div class='header_con2'>";
  echo "<p>{$roww["username"]}</p><div class='header_con3'>";
  echo "<span style='font-size:0.7rem'>{$roww["category"]} |</span>";
  echo "<span class='time'>{$roww["formatted_time"]}</span>";
  echo "</div></div><span>{$roww["formatted_date"]}</span></div></div></a>";
  echo "<div class='con_mes'>";
  echo strlen($full) > 200
    ? "<a href='confess_view.php?id=$id' class='confess-link'><p2>$short... <strong style='color:#007bff'>Read more</strong></p2></a>"
    : "<a href='confess_view.php?id=$id' class='confess-link'><p2>$full</p2></a>";
  echo "</div><div class='reaction'><div class='like'><span>❤️ {$roww['likes']}</span></div>";
  echo "<div class='views'><span>👁️ {$roww['views']} Reads</span></div></div></div>";
}
?>
