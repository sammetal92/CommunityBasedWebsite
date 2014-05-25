<?php
$db = mysqli_connect("localhost", "root", "", "thegamebook") or die(mysqli_connect_error());

if (!isset($_POST["email"]))
	die ("No email given!");

$query = "SELECT password FROM users WHERE email='" . $_POST["email"] . "'";
$execute = mysqli_query($db, $query);

if (mysqli_num_rows($execute) != 1)
	die ("User for that email not found.");

$accountInfo = mysqli_fetch_assoc($execute);

mail($_POST["email"], "The GameBook Password Recovery", "Your password is: " . $accountInfo["password"]);
?>