<?php
include("top.php");
if (!isset($_COOKIE["user"]))
	die ("You do not have permission to view this page.");

$query = "SELECT * FROM users WHERE username='" . $_COOKIE["user"] . "' AND (rank='2' OR rank='3')";
$execute = mysqli_query($db, $query);
$adminArray = mysqli_fetch_assoc($execute);
if (mysqli_num_rows($execute) != 1)
	die ("You do not have permission to view this page.");

echo "<head><title>Ban/UnBan Users - The GameBook</title>
	<script>
		function validateForm()
		{
			if (document.forms[\"banuser\"][\"username\"].value == null || document.forms[\"banuser\"][\"username\"].value == \"\")
			{
				alert(\"You need to fill in all fields!\");
				return false;
			}
		}
	</script>
	</head>";

echo "	<h1>Ban/UnBan Users - Administrator Panel</h1>
	<h2>Ban User</h2>
	<form method=\"POST\" action=\"ban.php\" name=\"banuser\" onsubmit=\"return validateForm();\">
	Enter Username To Ban: <input type=\"text\" name=\"username\">
	<br /><input type=\"submit\" value=\"Ban\">
	</form>";

echo "	<h2>Banned Users</h2>Click on a username to unban.<br /><br /><ul>";

$query = "SELECT * FROM users WHERE banStatus='1'";
$execute = mysqli_query($db, $query);

while ($userArray = mysqli_fetch_assoc($execute))
	echo "<li><a href=\"unban.php?id=" . $userArray["id"] . "\">" . $userArray["username"] . "</a></li>";

echo "</ul>";
include("bottom.php");
?>