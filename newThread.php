<?php
include("top.php");

if (!isset($_COOKIE["user"]))
	die("You do not have permission to post because you are not logged in.");

if (!isset($_GET["forum"]))
	die("No forum selected.");

$forum = $_GET["forum"];
$query = "SELECT * FROM users WHERE username='" . $_COOKIE["user"] . "'";
$execute = mysqli_query($db, $query);
$userArray = mysqli_fetch_assoc($execute);

echo "<head>
	<title>Posting New Thread - The GameBook</title>
	<script>
		function validateForm()
		{
			if (document.forms[\"newThread\"][\"title\"].value == null || document.forms[\"newThread\"][\"title\"].value == \"\" ||
				document.forms[\"newThread\"][\"body\"].value == null || document.forms[\"newThread\"][\"body\"].value == \"\" ||
				document.forms[\"newThread\"][\"subject\"].value == null || document.forms[\"newThread\"][\"subject\"].value == \"\")
			{
				alert(\"You need to fill all fields!\");
				return false;
			}
		}
	</script>
	</head>
	<center>
	<table width=75%>
	<form name=\"newThread\" onsubmit=\"return validateForm();\" action=\"postThread.php\" method=\"POST\">
	<tr>
		<td><b>Thread Title: </b></td><td><input type=\"text\" name=\"title\"></td>
	</tr>
	<tr>
		<td><b>Subject: </b></td><td><input type=\"text\" name=\"subject\"></td>
	</tr>
	<tr>
		<td style=\"vertical-align: top;\"><b>Post: </b></td><td><textarea name=\"body\" rows=15 cols=70></textarea></td>
	</tr>
	<tr>
		<td></td><td><input type=\"submit\" value=\"Submit\"><input type=\"hidden\" name=\"forum\" value=\"" . $_GET["forum"] . "\"></td>
	</tr>
	</form>
	</table>
	</center>";
include("bottom.php");
?>