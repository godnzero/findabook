<?php
$servername = "localhost";
$username = "root";
$password = "[kob&kim]";
$dbname = "findabook";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, found, not_found FROM tb_found";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<center><h1><u>REPORT</u></h1>";
    echo "<h4>Found Book: " . $row["found"]. "</h4>";
    echo "<h4>Not Found: " . $row["not_found"]."</h4></center>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>