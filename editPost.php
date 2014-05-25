<?php
include("top.php");
if (!isset($_COOKIE["user"]))
	die ("You do not have permission to view this page.");

$query = "SELECT * FROM users WHERE username='" . $_COOKIE["user"] . "' AND (rank='2' OR rank='3')";
$execute = mysqli_query($db, $query);
$adminArray = mysqli_fetch_assoc($execute);
if (mysqli_num_rows($execute) != 1)
	die ("You do not have permission to view this page.");

if (!isset($_GET["id"]))
	die ("No post set to edit.");

$postId = $_GET["id"];
$query = "SELECT * FROM posts WHERE id=" . $_GET["id"];
$execute = mysqli_query($db, $query);

if (mysqli_num_rows($execute) != 1)
	die("Post for that ID not found.");

$postArray = mysqli_fetch_assoc($execute);

$q = "SELECT * FROM threads WHERE id=" . $postArray["threadId"];
$e = mysqli_query($db, $q);
$parentThread = mysqli_fetch_assoc($e);

if (!isset($_POST["body"]))
{
	echo "<head>
		<title>Editing Post - The GameBook</title>
		<script>
			function validateForm()
			{
				if(document.forms[\"editing\"][\"body\"].value == null || document.forms[\"editing\"][\"body\"].value == \"\")
				{
					alert(\"You need to enter text!\");
					return false;
				}
			}
		</script>
		</head>
		<table>
		<form name=\"editing\" method=\"POST\" action=\"editPost.php?id=" . $postId . "\" onsubmit=\"return validateForm();\">
		<tr>
			<b><td style=\"vertical-align: top;\">Post Text: </td></b><td><textarea rows=\"12\" cols=\"70\" name=\"body\">" . $postArray["text"] . "</textarea></td>
		</tr>
		<tr>
			<td></td><td><input type=\"submit\"></td>
		</tr>
		</form>
		</table>
		</html>";
}

else
{
	$body = $_POST["body"];

	$query = "UPDATE posts SET text='$body' WHERE id='$postId'";
	$execute = mysqli_query($db, $query);

	$loc = "Location:threads.php?forum=" . $parentThread["forumId"] . "&thread=" . $parentThread["id"];
	header($loc);
}
?>