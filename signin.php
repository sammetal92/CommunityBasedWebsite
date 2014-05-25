<?php
$db = mysqli_connect("localhost", "root", "", "thegamebook");

if (mysqli_connect_errno())
	die(mysqli_connect_error());

$login = $_POST["login"];
$pass = $_POST["pass"];

$userQuery = "SELECT * FROM users WHERE username='$login' AND password='$pass'";
$emailQuery = "SELECT * FROM users WHERE email='$login' AND password='$pass'";

$uq = mysqli_query($db, $userQuery);
$eq = mysqli_query($db, $emailQuery);

if (mysqli_num_rows($uq) == 1 || mysqli_num_rows($eq) == 1)
{
	$name = mysqli_num_rows($uq) == 1 ? mysqli_fetch_assoc($uq) : mysqli_fetch_assoc($eq);
	if ($name["banStatus"] == 1) die("You have been banned.");
	setcookie("user", $name["username"], time()+(3600*24));
	header("Location:index.php");
}
else echo "failed.";
?>