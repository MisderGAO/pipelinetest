<html>
<body>

<h1><br><br><br>Web page test for SITE 2<br><br><br></h1>

<p>showing the result of connecting mysql</p>


<?php
$servername = "192.168.0.33";
$username = "root";
$password = "root";
 
// establish connection
$conn = new mysqli($servername, $username, $password);
 
// test connection
if ($conn->connect_error) {
    die("connection aborted: " . $conn->connect_error);
} 
echo "<br>sql connection successful";
?>

</body>
</html>