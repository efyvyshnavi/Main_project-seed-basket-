<?php
include(config.php);
$pid = $_POST["pid"];

$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT AVG(rating_value) AS average_rating FROM tbl_rating WHERE pid = $pid";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$average_rating = round($row["average_rating"], 1);

// Insert the new rating into the tbl_rating table
$rating_value = $_POST["rating"];
$sql = "INSERT INTO tbl_rating (pid, rating_value) VALUES ($item_id, $rating_value)";
$result = $conn->query($sql);

// Return the new average rating to the client
echo $average_rating;

$conn->close();
?>
