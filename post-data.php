<!DOCTYPE html>
<html><body>
<?php
include ('conn.php');

$sql = "SELECT id, temperature, humidity, created_date FROM GS_fridge ORDER BY id DESC";

echo '<table cellspacing="5" cellpadding="5">
      <tr> 
        <td>ID</td> 
        <td>Value 1</td> 
        <td>Value 2</td>
        <td>Timestamp</td> 
      </tr>';
 
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row["id"];
        $row_value1 = $row["temperature"];
        $row_value2 = $row["humidity"]; 
        $row_reading_time = $row["created_date"];
      
        echo '<tr> 
                <td>' . $row_id . '</td> 
                <td>' . $row_value1 . '</td> 
                <td>' . $row_value2 . '</td>
                <td>' . $row_reading_time . '</td> 
              </tr>';
    }
    $result->free();
}

$conn->close();
?> 
</table>
</body>
</html>
