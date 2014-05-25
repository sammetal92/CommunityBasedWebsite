<?php
if (!isset($_COOKIE["user"]))
	die ("No user logged in!");

$db = mysqli_connect("localhost", "root", "", "thegamebook") or die (mysqli_connect_error());

$user = $_COOKIE["user"];

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES['file']["name"]);
$extension = end($temp);

$query = "SELECT id FROM users WHERE username='$user'";
$exec = mysqli_query($db, $query);
$result = mysqli_fetch_assoc($exec);

if ((($_FILES['file']["type"] == "image/gif") || ($_FILES['file']["type"] == "image/jpeg") ||
	($_FILES['file']["type"] == "image/jpg") || ($_FILES['file']["type"] == "image/png"))
	&& ($_FILES['file']["size"] < 40000) && in_array($extension, $allowedExts))
{
	move_uploaded_file($_FILES['file']["tmp_name"], "displaypics/" . $_FILES['file']["name"]);
	$query = "UPDATE users SET displaypic='displaypics/" . $_FILES['file']["name"] . "' WHERE id='" . $result["id"] . "'";
	$exec = mysqli_query($db, $query);
	if ($exec)
		header("Location:profile.php");
	else die("Error uploading file.");
}
else
	echo "The file type must be one of GIF, JPEG/JPG or PNG. The image file size must not be over 40kB.";
?>