<?php
include("top.php");

if (!isset($_GET["thread"]))
	die("No thread selected.");

if (!isset($_COOKIE["user"]))
	die("You do not have permission to post because you are not logged in.");

$query = "SELECT * FROM threads WHERE id='" . $_GET["thread"] . "'";
$execute = mysqli_query($db, $query);
$threadArray = mysqli_fetch_assoc($execute);

echo "<head>
	<title>Posting Reply - The GameBook</title>
	<script>
		function validateForm()
		{
			if(document.forms[\"reply\"][\"body\"].value == null || document.forms[\"reply\"][\"body\"].value == \"\")
			{
				alert(\"You need to write something in the body of the post!\");
				return false;
			}
		}
	</script>
	</head>
	<h1>Posting Reply To " . $threadArray["title"] . "</h1>

	<form name=\"reply\" action=\"replyPost.php?forum=" . $threadArray["forumId"] . "&thread=". $threadArray["id"] ."\" method=\"POST\" onsubmit=\"return validateForm();\">
	<table>
	<tr>
		<td style=\"vertical-align: top;\">Post Message: <td><textarea rows=\"12\" cols=\"70\" name=\"body\"></textarea></td>
	</tr>
	<tr>
		<td></td><td><input type=\"submit\"></td>
	</tr>
	</form>
	</table>
	</html>";
include("bottom.php");

?>