<?php
<?php
$db = mysqli_connect("localhost", "root", "", "thegamebook") or die(mysqli_connect_error());

if (!isset($_COOKIE["user"]))
	die ("You do not have permission to view this page.");

$query = "SELECT * FROM users WHERE username='" . $_COOKIE["user"] . "' AND (rank='2' OR rank='3')";
$execute = mysqli_query($db, $query);
$adminArray = mysqli_fetch_assoc($execute);
if (mysqli_num_rows($execute) != 1)
	die ("You do not have permission to view this page.");

$title = $_POST["title"];
$headline = $_POST["headline"];
$description = $_POST["desc"];
$date = $_POST["date"];

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["image"]["name"]);
$extension = end($temp);

if ((($_FILES["image"]["type"] == "image/gif") || ($_FILES["image"]["type"] == "image/jpeg") ||
	($_FILES["image"]["type"] == "image/jpg") || ($_FILES["image"]["type"] == "image/png"))
	&& ($_FILES["image"]["size"] < 40000) && in_array($extension, $allowedExts))
{
	move_uploaded_file($_FILES["image"]["tmp_name"], "headlines/" . $_FILES["image"]["name"]);
	$image = "headlines/" . $_FILES["image"]["name"];
}

else die("File size must be below 40KB and file must be of image type.");

$query = "INSERT INTO news(id, title, description, date, image) VALUES(NULL, '$title', '$description', '$date', '$image')";
$execute = mysqli_query($db, $query);
$link = "news.php?id=" . mysqli_insert_id($db);
$query = "INSERT INTO headlines(id, title, description, date, image, link) VALUES(NULL, '$title', '$headline', '$date', '$image', '$link')";
$execute = mysqli_query($db, $query);

header("Location:adminTool.php");
?>
?>