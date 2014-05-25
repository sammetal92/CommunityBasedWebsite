<?php
if (!isset($_COOKIE["user"]))
	die("No user logged in!");

$db = mysqli_connect("localhost", "root", "", "thegamebook") or die(mysqli_connect_error());

$user = $_COOKIE["user"];
$forum = $_GET["forum"];
$thread = $_GET["thread"];

$query = "SELECT * FROM threads WHERE id='" . $_GET["thread"] . "'";
$execute = mysqli_query($db, $query);
$threadArray = mysqli_fetch_assoc($execute);

$postCount = $threadArray["postCount"] + 1;

$query = "SELECT id FROM users WHERE username='" . $_COOKIE["user"] . "'";
$execute = mysqli_query($db, $query);
$userId = mysqli_fetch_assoc($execute);
$userId = $userId["id"];
$text = $_POST["body"];

$insertPostQuery = "INSERT INTO posts(id, threadId, userId, text, date, time) VALUES(NULL, '$thread', '$userId', '$text', (SELECT CURDATE()), (SELECT CURTIME()))";
$execute = mysqli_query($db, $insertPostQuery);

$updateThread = "UPDATE threads SET postCount='" . $postCount . "', lastPostDate=(SELECT CURDATE()) WHERE id='" . $_GET["thread"] . "'";
$executeSecond = mysqli_query($db, $updateThread);

if ($execute)
	header("Location:threads.php?" . $_SERVER["QUERY_STRING"]);
else die("Failed.");
?>