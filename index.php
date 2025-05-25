<?php
session_start();
if (isset($_SESSION["user"])) {
  header("Location: home.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="default-src 'self'; style-src 'self' https://cdn.jsdelivr.net; script-src 'self' https://cdn.jsdelivr.net;">

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
  <div class="parent">
  <?php

require_once "Connectdb64.php";
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
  $username = strtolower(trim($_POST["username"]));
  $email = strtolower(trim($_POST["email"]));
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
  $gender = $_POST["gender"];
  $agree = isset($_POST['checkbox']);


  if (empty($username) || empty($password) || empty($cpassword) || empty($email)) {
    $error = "All fields are required";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid Email";
  } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $error = "Username can contain only letters and numbers";
  } elseif ($password !== $cpassword) {
    $error = "Passwords do not match";
  } elseif (!$agree) {
    $error = "You must agree to the terms";
  } elseif (!in_array($gender, ["male", "female", "other"])) {
    $error = "Invalid gender selected";
  } else {
    
    $stmt_email = $conn->prepare("SELECT * FROM user64 WHERE email = ?");
    $stmt_email->bind_param("s", $email);
    $stmt_email->execute();
    $result_email = $stmt_email->get_result();

    $stmt_user = $conn->prepare("SELECT * FROM user64 WHERE username = ?");
    $stmt_user->bind_param("s", $username);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    if ($result_email->num_rows > 0) {
      $error = "Email already exists!";
    } elseif ($result_user->num_rows > 0) {
      $error = "Username already exists!";
    } else {
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);

      $stmt_insert = $conn->prepare("INSERT INTO user64 (username, password, email, gender) VALUES (?, ?, ?, ?)");
      $stmt_insert->bind_param("ssss", $username, $passwordHash, $email, $gender);

      if ($stmt_insert->execute()) {
        $_SESSION['success'] = "Registered successfully!";
        header("Location: login.php");
        exit();
      } else {
        $error = "Something went wrong. Please try again.";
      }
    }

    $stmt_email->close();
    $stmt_user->close();
    $stmt_insert->close();
  }

  $conn->close();
}
?>

<form class="child" action="index.php" method="POST">
  <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
  <?php if (!empty($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

  <div>
    <input class="inp" type="text" placeholder="Enter Username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
  </div>
  <div>
    <input class="inp" type="email" placeholder="Enter Email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
  </div>
  <div>
    <input class="inp" type="password" placeholder="Enter Password" name="password">
  </div>
  <div>
    <input class="inp" type="password" placeholder="Confirm Your Password" name="cpassword">
  </div>
  <div>
    <select name="gender" id="gender">
      <option value="male" <?php if (isset($_POST['gender']) && $_POST['gender'] == "male") echo "selected"; ?>>Male</option>
      <option value="female" <?php if (isset($_POST['gender']) && $_POST['gender'] == "female") echo "selected"; ?>>Female</option>
      <option value="other" <?php if (isset($_POST['gender']) && $_POST['gender'] == "other") echo "selected"; ?>>Other</option>
    </select>
  </div>
  <div class="chkdiv">
    <input class="chkbox" id="checkbox" name="checkbox" type="checkbox" <?php if (isset($_POST['checkbox'])) echo "checked"; ?>>
    <label for="checkbox">Agree Terms and Conditions</label>
  </div>
  <div>
    <input class="btn" type="submit" value="Register" name="register">
  </div>

  <div>
    <p class="ptag">Already registered? <a href="login.php">Log In.</a></p>
  </div>
</form>

  </div>
  
</body>

</html>