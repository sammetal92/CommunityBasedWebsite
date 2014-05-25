<?php
$db = mysqli_connect("localhost", "root", "", "thegamebook") or die(mysqli_connect_error());

if (!isset($_COOKIE["user"]))
	die ("You do not have permission to view this page.");

$query = "SELECT * FROM users WHERE username='" . $_COOKIE["user"] . "' AND (rank='2' OR rank='3')";
$execute = mysqli_query($db, $query);
$adminArray = mysqli_fetch_assoc($execute);
if (mysqli_num_rows($execute) != 1)
	die ("You do not have permission to view this page.");

$query = "SELECT * FROM users WHERE username='" . $_POST["username"] . "' AND banStatus='0' AND rank='1'";
$execute = mysqli_query($db, $query);

if (mysqli_num_rows($execute) != 1)
	die ("User with that username not found or user is already banned.");

$query = "UPDATE users SET banStatus='1' WHERE username='" . $_POST["username"] . "'";
$execute = mysqli_query($db, $query);
header("Location:banunban.php");
?>