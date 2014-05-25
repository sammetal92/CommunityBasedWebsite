<?php
include("top.php");
if (!isset($_COOKIE["user"]))
	die ("You do not have permission to view this page.");

$query = "SELECT * FROM users WHERE username='" . $_COOKIE["user"] . "' AND (rank='2' OR rank='3')";
$execute = mysqli_query($db, $query);
$adminArray = mysqli_fetch_assoc($execute);
if (mysqli_num_rows($execute) != 1)
	die ("You do not have permission to view this page.");

echo "<head><title>Administrator Panel</title></head>
	<h1>Adminstrator Panel</h1>
	<a href=\"banunban.php\">Ban/UnBan users</a><br />
	<a href=\"newContest.php\">Post New Contest</a><br />
	<a href=\"newNews.php\">Post New News Post</a><br />
	<a href=\"editNews.php\">Edit News Post</a><br />
	<a href=\"editContest.php\">Edit Contest</a>";
if ($adminArray["rank"] == 3) echo "<br /><a href=\"editAdmins.php\">Edit Adminstrators</a>";
include("bottom.php");
?>