<?php
require 'conn.php';
$sql = "SELECT * FROM esp_data WHERE 1 ORDER BY id DESC";
$result = $conn->query($sql);
if (!$result) {
  { echo "Error: " . $sql . "<br>" . $conn->error; }
}
$row = $result->fetch_assoc();
echo json_encode($row);
?>