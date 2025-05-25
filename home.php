


<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

//session_start();
//if (!isset($_SESSION["user"])) {
 // header("Location: login.php");
//}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyConfessions</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <?php include('faviconh.php'); ?>
  <link rel="stylesheet" href="css/foot_nav.css">
  <link rel="stylesheet" href="css/home.css">


</head>

<body>
  <nav>
    <img src="img/logo2.png" alt="logo">
  </nav>


  <div class="confession_home" id="confession-container">
    <?php
    require_once "Connectdb64.php";
    $sql = "SELECT *,DATE_FORMAT(time, '%d/%b/%y') AS formatted_date,DATE_FORMAT(time, '%H:%i:%s') AS formatted_time 
            FROM confession 
            WHERE type = 'public' 
            ORDER BY RAND() 
            LIMIT 15";
    $result = mysqli_query($conn, $sql);
    while ($roww = mysqli_fetch_assoc($result)) {
      $id = $roww["id"];
      $full = htmlspecialchars($roww["confession"]);
      $short = substr($full, 0, 200);

      echo "<div class='confession_d'>";
      echo "<a href='profile_view.php?user=" . urlencode($roww["username"]) . "'>";
      echo "<div class='prf_img'>";
      echo "<div class='prf_d1'>";
      if ($roww["gender"] === "male") {
        echo "<img src='img/avatar.png' alt='profile' width='100%'>";
      } else {
        echo "<img src='img/avatarf.png' alt='profile' width='100%'>";
      }
      echo "</div>";
      echo "<div class='header_con'>";
      echo "<div class='header_con2'>";
      echo "<p>{$roww["username"]}</p>";
      echo "<div class='header_con3'>";
      echo "<span style='font-size:0.7rem'>{$roww["category"]} |</span>";
      echo "<span class='time'>{$roww["formatted_time"]}</span>";
      echo "</div></div>";
      echo "<span>{$roww["formatted_date"]}</span>";
      echo "</div></div></a>";
      echo "<div class='con_mes'>";
      if (strlen($full) > 200) {
        echo "<a href='confess_view.php?id=$id' class='confess-link'><p2>$short... <strong style='color:#007bff'>Read more</strong></p2></a>";
      } else {
        echo "<a href='confess_view.php?id=$id' class='confess-link'><p2>$full</p2></a>";
      }
      echo "</div>";
      echo "<div class='reaction'>";
      echo "<div class='like'><span>❤️ {$roww['likes']}</span></div>";
      echo "<div class='views'><span>👁️ {$roww['views']} Reads</span></div>";
      echo "</div></div>";
    }
    mysqli_close($conn);
    ?>
  </div>

  <button id="load-more-btn">Show More</button>

  <div class="sidebar">
    <div class="opt btn_clicked" id="home">
      <img class="btm-icn" src="img/home.svg" alt="home icon" width="30px">
      <p class="pclr">HOME</p>
    </div>
    <div class="opt" id="search_tab">
      <img class="btm-icn" src="img/search.svg"  alt="virals icon" width="30px">
      <p>VIRALS</p>
    </div>
    <div class="opt" id="pencil">
      <img class="btm-icn" src="img/pencil.svg"  alt="confess icon" width="30px">
      <p>CONFESS</p>
    </div>
    <div class="opt" id="profile">
      <img class="btm-icn" src="img/profile.svg"  alt="profile icon" width="30px">
      <p>PROFILE</p>
    </div>
  </div>

  <script>
    let offset = 10;
    document.getElementById("load-more-btn").addEventListener("click", function() {
      const btn = this;
      btn.innerText = "Loading...";
      fetch("load_confessions.php?start=" + offset)
        .then(res => res.text())
        .then(data => {
          if (data.trim() === "") {
            btn.style.display = "none";
          } else {
            document.getElementById("confession-container").innerHTML += data;
            offset += 10;
            btn.innerText = "Show More";
          }
        });
    });
  </script>

  <script src="js/btmbtn.js"></script>
  <script src="js/home.js"></script>
</body>

</html>