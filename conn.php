<?php
$conn = mysqli_connect('host', 'user', 'password', 'da_table');  
date_default_timezone_set("Europe/Rome");
if (! $conn) {  
         die("Connection failed" . mysqli_connect_error());  
}
?>
