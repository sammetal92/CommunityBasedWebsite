<?php
if (!isset($_COOKIE["user"]))
	die("No user logged in!");

include("top.php");
echo "<head><title>Message - The GameBook</title>
	<script>
		function validateForm()
		{
			if (document.forms[\"msg\"][\"to\"].value == \"\" || document.forms[\"msg\"][\"to\"].value == null ||
				document.forms[\"msg\"][\"subject\"].value == \"\" || document.forms[\"msg\"][\"subject\"].value == null || 
				document.forms[\"msg\"][\"body\"].value == \"\" || document.forms[\"msg\"][\"body\"].value == null)
			{
				alert(\"You need to fill all fields!\");
				return false;
			}
		}
	</script>
	</head>
	<h1>Messages</h1>
	<a href=\"messaging.php\">Back To Inbox</a>";

if ($user != null && isset($_GET["id"]))
{
	$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username='$user'");
	$arrayUser = mysqli_fetch_assoc($getUserId);
	$query = "SELECT * FROM messages WHERE toUser='" . $arrayUser["id"] . "' AND id='" . $_GET["id"] . "'";
	$result = mysqli_query($db, $query);
	$count = mysqli_num_rows($result);
}

	if (!isset($_GET["id"]))
	{
		echo "	<table>
			<form method=\"post\" action=\"sendMessage.php\" onsubmit=\"return validateForm()\" name=\"msg\">
			<tr>
				<td><b>To: </b></td><td><input type=\"text\" name=\"to\"></td>
			</tr>
			<tr>
				<td><b>Subject: </b></td><td><input type=\"text\"name=\"subject\"></td>
			</tr>
			<tr>
				<td><b>Message: </b></td><td></td>
			</tr>
			<tr>
				<td colspan=2><textarea name=\"body\" width=100%></textarea></td>
			</tr>
			<tr>
				<td><input type=\"submit\" value=\"Send\"></td><td></td>
			</tr>
			</table>";
	}

	else
	{
		$messageArray = mysqli_fetch_assoc($result);

		if ($arrayUser["id"] != $messageArray["toUser"])
			die("This message is not meant for you!");

		else if($messageArray["state"] == 0) mysqli_query($db, "UPDATE messages set state='1' WHERE id=" . $messageArray["id"]);

		$queryFromUsers = "SELECT * FROM users WHERE id='" . $messageArray["fromUser"] . "' AND id='" . $_GET["id"] . "'";
		$res = mysqli_query($db, $queryFromUsers);
		$getfromID = mysqli_fetch_assoc($res);
		echo "	<div style=\"border: 1px solid blue;\"><table width=100%>
			<tr>
				<td><b>From: </b></td><td>" . $getfromID["username"] . "</td>
			</tr>
			<tr>
				<td><b>Subject: </b></td><td>" . $messageArray["subject"] . "</td>
			</tr>
			<tr>
				<td><b>Date and Time: </b></td><td>" . $messageArray["date"] . ", " . $messageArray["time"] . "</td>
			</tr>
			<tr>
				<td colspan=2>" . $messageArray["text"] . "</td>
			</tr>
			</div></div>";
	}
	echo "	</table></body>
	</html>";
include("bottom.php");
?>