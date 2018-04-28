/*
The following code connects a the database to a server named travis. This server is a local server that was created using a program named xampp.
*/

<?php 
$servername = "localhost";
$username = "travis";
$password = "gator123";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>