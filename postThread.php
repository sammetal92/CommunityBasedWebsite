<?php
$db = mysqli_connect("localhost", "root", "", "thegamebook") or die(mysqli_connect_error());

if (!isset($_COOKIE["user"]))
	die("No user logged in.");

$forum = $_POST["forum"];

$query = "SELECT id FROM users WHERE username='" . $_COOKIE["user"] . "'";
$execute = mysqli_query($db, $query);
$userArray = mysqli_fetch_assoc($execute);
$userId = $userArray["id"];

$title = $_POST["title"];
$post = $_POST["body"];
$subject = $_POST["subject"];

$queryThread = "INSERT INTO threads(id, forumId, title, description, startUser, postCount, startDate, lastPostDate) VALUES(NULL, '$forum', '$title', '$subject', '$userId', '1', (SELECT CURDATE()), (SELECT CURDATE()))";
$execute = mysqli_query($db, $queryThread);
$thread = mysqli_insert_id($db);

$postThread = "INSERT INTO posts(id, threadId, userId, text, date, time) VALUES(NULL, '$thread', '$userId', '$post', (SELECT CURDATE()), (SELECT CURTIME()))";
$execute = mysqli_query($db, $postThread);

$query = "SELECT * FROM forums WHERE id='$forum'";
$execute = mysqli_query($db, $query);
$forumArray = mysqli_fetch_assoc($execute);
$threadCount = $forumArray["threadCount"] + 1;

$query = "UPDATE forums SET threadCount='$threadCount' WHERE id='$forum'";
$execute = mysqli_query($db, $query);

$location = "Location:threads.php?forum=" . $forum . " &thread=" . $thread;

header($location);
?>