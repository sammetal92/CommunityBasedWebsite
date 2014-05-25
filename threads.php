<?php
include("top.php");

if (!isset($_GET["forum"]))
	die("No forum selected.");

$query = "SELECT * FROM forums WHERE id='" . $_GET["forum"] . "'";
$execute = mysqli_query($db, $query);
$forumData = mysqli_fetch_assoc($execute);

if (mysqli_num_rows($execute) != 1)
	die("No threads for that Forum found.");

echo "<head><title>Forums - " . $forumData["title"] . " - The GameBook</title></head>
	<h1>" . $forumData["title"] . "</h1>";
	

if (!isset($_GET["thread"]))
{
	echo "<a href=\"forums.php\">Back To Forums Home</a><br />
	<a href=\"newThread.php?forum=" . $_GET["forum"] . "\">Post New Thread</a><br /><br />";
	$query = "SELECT * FROM threads WHERE forumId='" . $_GET["forum"] . "'";
	$execute = mysqli_query($db, $query);
	echo "<center><table width=75%>";
	while ($result = mysqli_fetch_assoc($execute))
	{
		$queryGetStartUser = "SELECT username FROM users WHERE id='" . $result["startUser"] . "'";
		$startUsername = mysqli_fetch_assoc(mysqli_query($db, $queryGetStartUser));
		echo "	<center><table style=\"border-collapse: collapse; border: 1px solid blue\">	
			<tr>
				<td width=100%><b><a href=\"threads.php?forum=" . $_GET["forum"] . "&thread=". $result["id"] ."\">" . $result["title"] . "</a></b></td><td>Posts: </td><td>" . $result["postCount"] . "</td><td>Thread Opener: </td><td>" . $startUsername["username"] . "</td>
			</tr>
			<tr>
				<td>" . $result["description"] . "</td><td colspan=4>Last Post: " . $result["lastPostDate"] . "</td>
			</tr>
		</table></center>";
	}
	echo "</table>
	</center>
	</html>";
}
else
{
	echo "<a href=\"threads.php?forum=" . $forumData["id"] . "\">Back to the Forum</a><br />";
	echo "<a href=\"reply.php?forum=" . $_GET["forum"] . "&thread=" . $_GET["thread"] . "\">Post a Reply</a><br /><br />";
	$query = "SELECT * FROM posts WHERE threadId='" . $_GET["thread"] . "'";
	$execute = mysqli_query($db, $query);
	echo "<center><table width=80%>";
	while ($postsArray = mysqli_fetch_assoc($execute))
	{
		$queryGetStartUser = "SELECT * FROM users WHERE id='" . $postsArray["userId"] . "'";
		$startUsername = mysqli_fetch_assoc(mysqli_query($db, $queryGetStartUser));
		echo "	<center><div id=#" . $postsArray["id"] . "><table style=\"border-collapse: collapse; border: 1px solid blue\">
			<tr style=\"border-collapse: collapse; border: 1px solid blue\">
				<td colspan=2>Posted: " . $postsArray["date"] . ", " . $postsArray["time"] . "</td>";

		if (isset($_COOKIE["user"]))
		{
			$getAdminStatus = "SELECT * FROM users WHERE username='" . $_COOKIE["user"] . "'";
			$adminExecute = mysqli_query($db, $getAdminStatus);
			$adminArray = mysqli_fetch_assoc($adminExecute);

			if ($adminArray["rank"] == 2 || $adminArray["rank"] == 3)
				echo "<td><a href=\"editPost.php?id=" . $postsArray["id"] . "\">Edit Post</a></td>";
		}

		else echo "<td></td>";

		echo "	</tr>
			<tr>
				<td style=\"border-collapse: collapse; border: 1px solid blue\">" . $startUsername["username"] . "<br /><br /><img src=\"" . $startUsername["displayPic"] . "\" height=210px width=210px></td><td width=80%>" . $postsArray["text"] . "</td><td></td>
			</tr>
			</table></div></center>";
	}
	echo "</table>";
	echo "</center>";
}
	include("bottom.php");
?>