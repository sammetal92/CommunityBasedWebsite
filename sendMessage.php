<?php
if (!isset($_COOKIE["user"]))
	die("No user logged in!");

$db = mysqli_connect("localhost", "root", "", "thegamebook") or die(mysqli_connect_error());

$user = $_COOKIE["user"];

$to = $_POST["to"];

$query = "SELECT * FROM users WHERE username='$to'";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) != 1)
	die("User with that username not found.<br /><input type=\"button\" onclick=\"history.go(-1)\" value=\"Go Back and Try Again\">");

$userArray = mysqli_fetch_assoc($result);
$query = "SELECT id FROM users WHERE username='$user'";
$result = mysqli_query($db, $query);
$fromUser = mysqli_fetch_assoc($result);
$fromUser = $fromUser["id"];

$toUser = $userArray["id"];
$sub = $_POST["subject"];
$text = $_POST["body"];
$query = "INSERT INTO messages(id, fromUser, toUser, date, time, text, state, subject) VALUES(NULL, '$fromUser', '$toUser', (SELECT CURDATE()), (SELECT CURTIME()), '$text', '0', '$sub')";
$result = mysqli_query($db, $query);

if ($result)
	header("Location:messaging.php");
else echo "Failed.";
?>