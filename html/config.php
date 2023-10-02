<?php
$secure = true; // Use true if your site uses HTTPS, otherwise use false
$http_only = true; // Set HttpOnly flag to true
session_set_cookie_params([
	'lifetime' => time() + 3600, // Session cookie will expire when the browser is closed
	'path' => '/', // The path for which the session cookie is valid
	'domain' => '', // The domain for which the session cookie is valid
	'secure' => $secure, // Set to true if using HTTPS
	'httponly' => $http_only // Set HttpOnly flag
]);

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobjet"; //database

// Set a cookie with the SameSite attribute
// $cookieName = 'PHPSESSID';
// $cookieValue = ' ';
// $expire = time() + 3600; // Set the expiration time (1 hour from now)

// // Specify SameSite attribute as 'Strict' or 'Lax' or 'None' depending on your needs
// $sameSite = 'Lax'; // You can change this to 'Strict' or 'None' as needed

// setcookie($cookieName, $cookieValue, $expire, '/', '', false, true); // Setting HttpOnly flag to true
// setcookie($cookieName . '_samesite', $sameSite, $expire, '/', '', false, false); // Setting SameSite attribute

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

/*user validation part*/
$validuser = NULL;
$validation = 0;
if (!empty($_SESSION['mailP'])) {
	$mail = $validuser = $_SESSION['mailP'];
}



$sql = "SELECT * FROM employee WHERE mail LIKE '$validuser' ";
mysqli_query($conn, $sql);
if ((mysqli_affected_rows($conn) > 0) and ($validuser != NULL)) {
	$validation = 2;
}

$sql = "SELECT * FROM employer WHERE email LIKE '$validuser'";
mysqli_query($conn, $sql);

if ((mysqli_affected_rows($conn) > 0) and ($validuser != NULL)) {
	$validation = 1;
}

if (!empty($_SESSION['nameP'])) {
	$user = $_SESSION['nameP'];
} else {
	$user = "user";
}