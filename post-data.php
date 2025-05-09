<?php
include ('conn.php');
// If you change this value, the ESP32 sketch needs to match
$api_key_value = "123456789";

$api_key= $temperature = $humidity = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = pst_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $temperature = pst_input($_POST["temperature"]);
        $humidity = pst_input($_POST["humidity"]);
        
        $sql = "INSERT INTO esp_data (temperature, humidity, created_date)
        VALUES ('" . $temperature . "', '" . $humidity . "', '".date("Y-m-d H:i:s")."')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function pst_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
