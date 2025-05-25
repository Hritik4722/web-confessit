<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
require_once "Connectdb64.php";


$searchTerm = "";
$searchSql = "";

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $searchTerm = trim($_GET['search']);
    $searchTermEscaped = mysqli_real_escape_string($conn, $searchTerm);
    $searchSql = " AND (confession LIKE '%$searchTermEscaped%' OR username LIKE '%$searchTermEscaped%')";

    $sql = "SELECT *, DATE_FORMAT(time, '%d/%b/%y') AS formatted_date, DATE_FORMAT(time, '%H:%i:%s') AS formatted_time 
          FROM confession 
          WHERE type='public' $searchSql 
          ORDER BY time DESC
          LIMIT 50";
} else {
    
    $sql = "SELECT *, DATE_FORMAT(time, '%d/%b/%y') AS formatted_date, DATE_FORMAT(time, '%H:%i:%s') AS formatted_time 
          FROM confession 
          WHERE type='public' 
          ORDER BY likes DESC, views DESC 
          LIMIT 20";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Virals</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <?php include('faviconh.php'); ?>
    <link rel="stylesheet" href="css/foot_nav.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/search.css">


</head>

<body>

    <!-- Top Nav -->
    <nav>
        <a href="home.php"><img src="img/logo2.png" alt="logo"></a>
        <div class="search-bar">

            <form method="GET" action="search.php" onsubmit="return keepCursorAtEnd()">

                <input type="search" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($searchTerm); ?>" autofocus>

            </form>

        </div>
    </nav>

    <!-- Confession Results -->
    <div class="confession_home">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $full = htmlspecialchars($row["confession"]);
                $short = substr($full, 0, 200);

                echo "<div class='confession_d'>";
                echo "<a href='profile_view.php?user=" . urlencode($row["username"]) . "'>";
                echo "<div class='prf_img'><div class='prf_d1'>";
                echo "<img src='img/" . ($row["gender"] === "male" ? "avatar.png" : "avatarf.png") . "' width='100%'>";
                echo "</div><div class='header_con'><div class='header_con2'><p>{$row["username"]}</p>";
                echo "<div class='header_con3'><span style='font-size:0.7rem'>{$row["category"]} |</span>";
                echo "<span class='time'>{$row["formatted_time"]}</span></div></div>";
                echo "<span>{$row["formatted_date"]}</span></div></div></a>";
                echo "<div class='con_mes'>";
                echo "<a href='confess_view.php?id=$id' class='confess-link'><p2>" . (strlen($full) > 200 ? "$short... <strong style='color:#007bff'>Read more</strong>" : $full) . "</p2></a>";
                echo "</div><div class='reaction'><div class='like'><span>❤️ {$row['likes']}</span></div>";
                echo "<div class='views'><span>👁️ {$row['views']} Reads</span></div></div></div>";
            }
        } else {
            echo "<p class='no-results'>No confessions found.</p>";
        }
        mysqli_close($conn);
        ?>
    </div>
    <div class="sidebar">
        <div class="opt" id="home">
            <img class="btm-icn" src="img/home.svg" width="30px">
            <p class="pclr">HOME</p>
        </div>
        <div class="opt  btn_clicked" id="search_tab">
            <img class="btm-icn" src="img/search.svg" width="30px">
            <p>VIRALS</p>
        </div>
        <div class="opt" id="pencil">
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
        window.addEventListener("load", function() {
            const input = document.querySelector('input[name="search"]');
            if (input && input.value.length > 0) {
                const val = input.value;
                input.focus();
                input.setSelectionRange(val.length, val.length); // Move cursor to the end
            }
        });
    </script>


</body>

</html>