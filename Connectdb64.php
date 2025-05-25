<?php

// $hostName = "sql304.infinityfree.com";
// $dbUser = "if0_38711720";
// $dbPassword = "hritikdine4722";
// $dbName = "if0_38711720_confess472244";
// $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
// if (!$conn) {
//     die("Something went wrong");
// }

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "confessit";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong");
}
?>