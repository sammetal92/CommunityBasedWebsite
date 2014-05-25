<?php
include("top.php");
if (!isset($_COOKIE["user"]))
	die ("You do not have permission to view this page.");

$query = "SELECT * FROM users WHERE username='" . $_COOKIE["user"] . "' AND rank='3'";
$execute = mysqli_query($db, $query);
$adminArray = mysqli_fetch_assoc($execute);
if (mysqli_num_rows($execute) != 1)
	die ("You do not have permission to view this page.");

echo "<head><title>Edit Administrators - The GameBook</title>
	<script>
		function validateForm()
		{
			if (document.forms[\"admins\"][\"username\"].value == null || document.forms[\"admins\"][\"username\"].value == \"\")
			{
				alert(\"You need to fill in all fields!\");
				return false;
			}
		}
	</script>
	</head>";

echo "	<h1>Edit Administrators - Administrator Panel</h1>
	<h2>Make Administrator</h2>
	<form method=\"POST\" action=\"makeAdmin.php\" name=\"admins\" onsubmit=\"return validateForm();\">
	Enter Username To Make Administrator: <input type=\"text\" name=\"username\">
	<br /><input type=\"submit\" value=\"Done\">
	</form>";

echo "	<h2>Administrators</h2>Click on a username to remove administrator.<br /><br /><ul>";

$query = "SELECT * FROM users WHERE rank='2'";
$execute = mysqli_query($db, $query);

while ($userArray = mysqli_fetch_assoc($execute))
	echo "<li><a href=\"removeAdmin.php?id=" . $userArray["id"] . "\">" . $userArray["username"] . "</a></li>";

echo "</ul>";
include("bottom.php");
?>