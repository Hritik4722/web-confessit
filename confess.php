<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MyConfessions</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/foot_nav.css">
  <link rel="stylesheet" href="css/confess.css">
</head>

<body>
  <nav>
    <img src="img/logo2.png" height="40px">
  </nav>
  <form class="confess-container" action="confess.php" method="POST">

    <div>
      <div class="bcg_clr">
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confess"])) {
          $confession = $_POST["confession"];
          $sr_no = $_SESSION["sr_no"];
          $userr = $_SESSION["user"];
          $gender = $_SESSION["gender"];
          $type = $_POST["visibility"];
          $category = $_POST["category"];

          require_once "Connectdb64.php";
          if (!empty($confession)) {

            if (strlen($confession) < 100) {
              echo "<div class='alert alert-danger'>Confession must be at least 100 characters long.</div>";
            } else {
              $sql_confess = "INSERT INTO confession (sr_no, username, type, category, confession, gender) VALUES (?, ?, ?, ?, ?, ?)";
              $stmt = mysqli_prepare($conn, $sql_confess);
              mysqli_stmt_bind_param($stmt, "isssss", $sr_no, $userr, $type, $category, $confession, $gender);

              if (mysqli_stmt_execute($stmt)) {
                echo "<div class='alert alert-success'>Successfully shared your {$_POST['category']}</div>";
                echo "<script>setTimeout(function() {window.location.href='home.php';}, 1300);</script>";
                exit();
              } else {
                echo "<p>Unsuccessful {$_POST['category']}.</p>";
                echo "Error: " . mysqli_stmt_error($stmt);
              }

              mysqli_stmt_close($stmt);
            }
          } else {
            echo "<div class='alert alert-danger'>Write Something!</div>";
          }
        } ?>



        <textarea name="confession" id="confession" placeholder="Write something here..." oninput="countChar(this)" maxlength="10000"><?php echo isset($_POST['confession']) ? htmlspecialchars($_POST['confession']) : ''; ?></textarea>


        <div class="type_post">
          <select name="category" id="category">
            <option value="Confession">Confession</option>
            <option value="Story">Story</option>
            <option value="Confusion">Confusion</option>
          </select>

          <p id="charCount">Atleast 100 Character Required</p>

          <select name="visibility" id="visibility">
            <option value="public">Public</option>
            <option value="private">Private</option>
          </select>

        </div>
      </div>
      <div class="button">
        <input class="btn2" type="submit" value="Confess it!" name="confess">
      </div>

    </div>
  </form>
  <div class="sidebar">
    <div class="opt " id="home">
      <img class="btm-icn" src="img/home.svg" width="30px">
      <p class="pclr">HOME</p>
    </div>
    <div class="opt" id="search_tab">
      <img class="btm-icn" src="img/search.svg" width="30px">
      <p>VIRALS</p>
    </div>
    <div class="opt btn_clicked" id="pencil">
      <img class="btm-icn" src="img/pencil.svg" width="30px">
      <p>CONFESS</p>
    </div>
    <div class="opt" id="profile">
      <img class="btm-icn" src="img/profile.svg" width="30px">
      <p>PROFILE</p>
    </div>
  </div>
  <script src="js/btmbtn.js"></script>

  <script>
    const textarea = document.getElementById("confession");
    const charCount = document.getElementById("charCount");

    textarea.addEventListener("input", () => {
      const currentLength = textarea.value.length;
      if (currentLength <= 0) {
        charCount.textContent = "Atleast 100 Character Required";

      } else {
        charCount.textContent = `${currentLength} characters`;
      }

      if (currentLength < 100) {
        charCount.style.color = "red";
      } else {
        charCount.style.color = "green";
      }
    });

    window.onload = function() {
      const textarea = document.getElementById("confession");
      if (textarea) {
        countChar(textarea);
      }
    };
  </script>
</body>

</html>