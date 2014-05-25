<?php
include("top.php");
if (!isset($_COOKIE["user"]))
	die ("You do not have permission to view this page.");

$query = "SELECT * FROM users WHERE username='" . $_COOKIE["user"] . "' AND (rank='2' OR rank='3')";
$execute = mysqli_query($db, $query);
$adminArray = mysqli_fetch_assoc($execute);
if (mysqli_num_rows($execute) != 1)
	die ("You do not have permission to view this page.");

echo "<head><title>Post New Contest - The GameBook</title>
	<script>
		function validateForm()
		{
			if (document.forms[\"newCont\"][\"title\"].value == null || document.forms[\"newCont\"][\"title\"].value == \"\" ||
				document.forms[\"newCont\"][\"shortDesc\"].value == null || document.forms[\"newCont\"][\"shortDesc\"].value == \"\" ||
				document.forms[\"newCont\"][\"desc\"].value == null || document.forms[\"newCont\"][\"desc\"].value == \"\" ||
				document.forms[\"newCont\"][\"deadline\"].value == null || document.forms[\"newCont\"][\"deadline\"].value == \"\" ||
				document.forms[\"newCont\"][\"image\"].value == null || document.forms[\"newCont\"][\"image\"].value == \"\" ||)
			{
				alert(\"You need to fill in all fields!\");
				return false;
			}
		}
	</script>
	</head>
	<h1>Post New Contest - Administrator Panel</h1>";

echo "<table>
	<form name=\"newCont\" onsubmit=\"return validateForm();\" method=\"POST\" action=\"postContest.php\"  enctype=\"multipart/form-data\">
	<tr>
		<td><b>Title: </b></td><td><input type=\"text\" name=\"title\"></td>
	</tr>
	<tr>
		<td><b>Short Description: </b></td><td><textarea name=\"shortDesc\"></textarea></td>
	</tr>
	<tr>
		<td><b>Description: </b></td><td><textarea name=\"desc\"></textarea></td>
	</tr>
	<tr>
		<td><b>Deadline: </b></td><td><input type=\"date\" name=\"deadline\"></td>
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