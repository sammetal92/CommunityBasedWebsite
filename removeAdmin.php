<?php
$db = mysqli_connect("localhost", "root", "", "thegamebook") or die(mysqli_connect_error());

if (!isset($_COOKIE["user"]))
	die ("You do not have permission to view this page.");

$query = "SELECT * FROM users WHERE username='" . $_COOKIE["user"] . "' AND (rank='2' OR rank='3')";
$execute = mysqli_query($db, $query);
$adminArray = mysqli_fetch_assoc($execute);
if (mysqli_num_rows($execute) != 1)
	die ("You do not have permission to view this page.");

if (!isset($_GET["id"]))
	die ("No user set.");

$query = "SELECT * FROM users WHERE id='" . $_GET["id"] . "' AND rank='2'";
$execute = mysqli_query($db, $query);

if (mysqli_num_rows($execute) != 1)
	die ("User with that ID not found or user is not administrator.");

$query = "UPDATE users SET rank='1' WHERE id='" . $_GET["id"] . "'";
$execute = mysqli_query($db, $query);
header("Location:editAdmins.php");
?>