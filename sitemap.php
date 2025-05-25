<?php
// Connect to your database
require_once "Connectdb64.php";

// Set header to XML
header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

  
  <url>
    <loc>https://confessit.infy.uk/</loc>
    <priority>1.0</priority>
  </url>

 
  <url>
    <loc>https://confessit.infy.uk/login.php</loc>
    <priority>0.5</priority>
  </url>

  <url>
    <loc>https://confessit.infy.uk/register.php</loc>
    <priority>0.5</priority>
  </url>

  <url>
    <loc>https://confessit.infy.uk/search.php</loc>
    <priority>0.6</priority>
  </url>

  <url>
    <loc>https://confessit.infy.uk/home.php</loc>
    <priority>0.7</priority>
  </url>

<?php
// Now fetch confession IDs
$sql = "SELECT id, time FROM confession WHERE type = 'public'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $lastmod = date('Y-m-d', strtotime($row['time'])); // Last modified date

    echo "
  <url>
    <loc>https://confessit.infy.uk/confess_view.php?id=$id</loc>
    <lastmod>$lastmod</lastmod>
    <priority>0.8</priority>
  </url>";
}
?>

</urlset>
