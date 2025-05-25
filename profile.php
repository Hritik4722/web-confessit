<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("Location: login.php");
}
$gender_id = true;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MyConfessions</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <?php include('faviconh.php'); ?>
  <link rel="stylesheet" href="css/foot_nav.css">
  <link rel="stylesheet" href="css/profile.css">


</head>

<body>
  <nav>

    <h3>@<?php echo "{$_SESSION["user"]}"; ?></h3>
    <a href="logout.php" class="btn btn-warning">Logout</a>
  </nav>

  <div class="parentp">
    <div class="img_profile">
      <?php
      if ($_SESSION['gender'] === 'male') {
        echo "<img src='img/avatar.png'>";
        $gender_id = true;
      } else {
        echo "<img src='img/avatarf.png'>";
        $gender_id = false;
      }
      ?>
      <?php echo "<p class='email_p' >{$_SESSION["email"]}</p>"; ?>
    </div>
    <div class="co_parent">
      <div class="public_btn clicked_btn" id="public_b">
        <p class="c_btn">Public</p>
      </div>
      <div class="private_btn" id="private_b">
        <p class="c_btn">Private</p>
      </div>
    </div>
  </div>
  <div class="Public_confess " id="Public_con">
    <?php
    $sr_num = $_SESSION["sr_no"];
    require_once "Connectdb64.php";
    //$sql = "SELECT * FROM Confession WHERE type = 'public' AND sr.no = '$sr_num'";
    $sql = "SELECT *,DATE_FORMAT(time, '%d/%b/%y') AS formatted_date,DATE_FORMAT(time, '%H:%i:%s') AS formatted_time FROM confession WHERE type = 'public' AND sr_no = '$sr_num'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
      }
      $rev_rows = array_reverse($rows);
      foreach ($rev_rows as $roww) {
        echo "<div class='confession_d'>";
        echo "<div class='prf_img'>";
        if ($gender_id) {
          echo "<img src='img/avatar.png' width='50px'>";
        } else {
          echo "<img src='img/avatarf.png' width='50px'>";
        }
        echo "</div>";
        echo "<div class='con_message'>";
        echo "<div class='con_message_d2'>";
        echo "<p> {$_SESSION["user"]}</p>";
        echo "<div class='con_message_d3'>";
        echo "<span>{$roww["formatted_date"]} |</span>";
        echo "<span style='padding-left:3px;'>{$roww["formatted_time"]}</span>";
        echo "</div>";
        echo "</div>";

        $id = $roww["id"];
        $full = htmlspecialchars($roww["confession"]);
        $short = substr($full, 0, 200);

        if (strlen($full) > 200) {
          echo "<a href='confess_view.php?id=$id' class='confess-link'><p2>$short... <strong style='color:#007bff'>Read more</strong></p2></a>";
        } else {
          echo "<a href='confess_view.php?id=$id' class='confess-link'><p2>$full</p2></a>";
        }



        echo "<div class='reaction'>";
        echo "<div class='like'>";
        echo "<span>❤️ " . $roww['likes'] . "</span>";
        echo "</div>";
        echo "<div class='views'>";
        echo "<span>👁️ " . $roww['views'] . " Reads</span>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        echo "</div>";
      }
    } else {
      echo "<center>No confessions yet!.</center>";
    }

    ?>
  </div>
  <div class="private_confess confess_h" id="private_con">
    <?php
    //$sql_p = "SELECT * FROM Confession WHERE type = 'private' AND sr.no = '$sr_num'";
    $sql_p = "SELECT *,DATE_FORMAT(time, '%d/%b/%y') AS formatted_date,DATE_FORMAT(time, '%H:%i:%s') AS formatted_time FROM confession WHERE type = 'private' AND sr_no = '$sr_num'";

    $result_p = mysqli_query($conn, $sql_p);
    if ($result_p->num_rows > 0) {
      while ($row_p = mysqli_fetch_assoc($result_p)) {
        $row_pp[] = $row_p;
      }
      $rev_rowp = array_reverse($row_pp);
      foreach ($rev_rowp as $row_) {
        echo "<div class='confession_d'>";
        echo "<div class='prf_img'>";
        if ($gender_id) {
          echo "<img src='img/avatar.png' width='50px'>";
        } else {
          echo "<img src='img/avatarf.png' width='50px'>";
        }
        echo "</div>";
        echo "<div class='con_message'>";
        echo "<div class='con_message_d2'>";
        echo "<p> {$_SESSION["user"]}</p>";
        echo "<div class='con_message_d3'>";
        echo "<span>{$row_["formatted_date"]} |</span>";
        echo "<span style='padding-left:3px;'>{$row_["formatted_time"]}</span>";
        echo "</div>";
        echo "</div>";


        $id_p = $row_["id"];
        $full_p = htmlspecialchars($row_["confession"]);
        $short_p = substr($full_p, 0, 200);

        if (strlen($full_p) > 200) {
          echo "<a href='confess_view.php?id=$id_p' class='confess-link'><p2>$short_p... <strong style='color:#007bff'>Read more</strong></p2></a>";
        } else {
          echo "<a href='confess_view.php?id=$id_p' class='confess-link'><p2>$full_p</p2></a>";
        }


        echo "</div>";
        echo "</div>";
      }
    } else {
      echo "<center>No confessions yet!.</center>";
    }
    mysqli_close($conn);
    ?>
  </div>
  <div class="sidebar">
    <div class="opt" id="home">
      <img class="btm-icn" src="img/home.svg" width="30px">
      <p class="pclr">HOME</p>
    </div>
    <div class="opt" id="search_tab">
      <img class="btm-icn" src="img/search.svg" width="30px">
      <p>VIRALS</p>
    </div>
    <div class="opt" id="pencil">
      <img class="btm-icn" src="img/pencil.svg" width="30px">
      <p>CONFESS</p>
    </div>
    <div class="opt btn_clicked" id="profile">


      <img class="btm-icn" src="img/profile.svg" width="30px">

      <p>PROFILE</p>
    </div>
  </div>


  <script src="js/btmbtn.js"></script>
  <script src="js/profile.js"></script>
</body>

</html>