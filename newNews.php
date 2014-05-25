<?php
include("top.php");
if (!isset($_COOKIE["user"]))
	die ("You do not have permission to view this page.");

$query = "SELECT * FROM users WHERE username='" . $_COOKIE["user"] . "' AND (rank='2' OR rank='3')";
$execute = mysqli_query($db, $query);
$adminArray = mysqli_fetch_assoc($execute);
if (mysqli_num_rows($execute) != 1)
	die ("You do not have permission to view this page.");

echo "<head><title>Post New News Post - The GameBook</title>
	<script>
		function validateForm()
		{
			if (document.forms[\"newNews\"][\"title\"].value == null || document.forms[\"newNews\"][\"title\"].value == \"\" ||
				document.forms[\"newNews\"][\"headline\"].value == null || document.forms[\"newNews\"][\"headline\"].value == \"\" ||
				document.forms[\"newNews\"][\"desc\"].value == null || document.forms[\"newNews\"][\"desc\"].value == \"\" ||
				document.forms[\"newNews\"][\"date\"].value == null || document.forms[\"newNews\"][\"date\"].value == \"\" ||
				document.forms[\"newNews\"][\"image\"].value == null || document.forms[\"newNews\"][\"image\"].value == \"\" ||)
			{
				alert(\"You need to fill in all fields!\");
				return false;
			}
		}
	</script>
	</head>
	<h1>Post New News Post - Administrator Panel</h1>";

echo "<table>
	<form name=\"newNews\" onsubmit=\"return validateForm();\" method=\"POST\" action=\"postNews.php\"  enctype=\"multipart/form-data\">
	<tr>
		<td><b>Title: </b></td><td><input type=\"text\" name=\"title\"></td>
	</tr>
	<tr>
		<td><b>Headline: </b></td><td><textarea name=\"headline\"></textarea></td>
	</tr>
	<tr>
		<td><b>Description: </b></td><td><textarea name=\"desc\"></textarea></td>
	</tr>
	<tr>
		<td><b>Date: </b></td><td><input type=\"date\" name=\"date\"></td>
	</tr>
	<tr>
		<td><b>Upload Image: </b></td><td><input type=\"file\" name=\"image\"></td>
	</tr>
	<tr>
		<td></td><td><input type=\"submit\"></td>
	</tr>
	</form>
	</table>";
include("bottom.php");
?>