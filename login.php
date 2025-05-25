<?php session_start();
if (isset($_SESSION["user"])) {
  header("Location: home.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <?php include('faviconh.php'); ?>
  <link rel="stylesheet" href="css/regn_login.css">
  
  <title>Confession</title>
</head>

<body>
  <nav>
  <img src="img/logo2.png" alt="logo">
  </nav>
  <?php

if (isset($_SESSION['success'])) {
  echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
  unset($_SESSION['success']);
}
?>
  <div class="parent">
    <form class="child" action="login.php" method="POST">
      <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
        $email = strtolower($_POST["email"]);
        $password = $_POST["password"];
        require_once "Connectdb64.php";
        $sql_exist = "SELECT * FROM user64 WHERE email = '$email'";
        $result = mysqli_query($conn, $sql_exist);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if (empty($email) or empty($password)) {
          echo "<div class='alert alert-danger'>All fields are required</div>";
        } elseif (empty($_POST['checkbox'])) {
          echo "<div class='alert alert-danger'>Click on the Checkbox</div>";
        } elseif ($user) {
          if (password_verify($password, $user['password'])) {
            $_SESSION["user"] = $user['username'];
            $_SESSION["sr_no"] = $user['sr_no'];
            $_SESSION["email"] = $user['email'];
            $_SESSION["gender"] = $user['gender'];
            echo "<script>window.location.href='home.php';</script>";
            exit();
          } else {
            echo "<div class='alert alert-danger'>Incorrect password!</div>";
          }
        } else {
          echo "<div class='alert alert-danger'>Email doesn't exist</div>";
        }
      } ?>

      <div>
        <input class="inp" type="email" placeholder="Enter Email" name="email">
      </div>
      <div>
        <input class="inp" type="password" placeholder="Enter Password" name="password">
      </div>

      <div class="chkdiv">
        <input class="chkbox" name="checkbox" type="checkbox">
        <label for="checkbox">Agree Terms and Conditions</label>
      </div>
      <div>
        <input class="btn" type="submit" value="Login" name="login">
      </div>

      <div>
        <p class="ptag">Doesn't have an account? <a href="index.php">Register.</a></p>
      </div>
    </form>
  </div>
 
</body>

</html>