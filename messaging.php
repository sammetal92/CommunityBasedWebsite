<?php
if (!isset($_COOKIE["user"]))
	die("No user logged in!");

include("top.php");
echo "<head>
	<title>Messaging - The GameBook</title>
	</head>
	<h1>Messages</h1>
	<a href=\"message.php\">New Message</a><br />";

$queryUID = "SELECT * FROM users WHERE username='" . $_COOKIE["user"] . "'";
$result = mysqli_query($db, $queryUID);
$arrayUser = mysqli_fetch_assoc($result);

$queryMessages = "SELECT * FROM messages WHERE toUser='" . $arrayUser["id"] . "'";
$result = mysqli_query($db, $queryMessages);

echo "	<table class=\"messageTable\" width=100%>";

while ($arrayMessages = mysqli_fetch_assoc($result))
{
	$queryFromUsers = "SELECT * FROM users WHERE id='" . $arrayMessages["fromUser"] . "'";
	$res = mysqli_query($db, $queryFromUsers);
	$getfromID = mysqli_fetch_assoc($res);
	echo "	<tr>
		<td>From: </td><td>";
	if ($arrayMessages["state"] == 0)
		echo "	<b>";

	echo $getfromID["username"];

	if ($arrayMessages["state"] == 0)
		echo "	</b>";

	echo "	</td><td> " . $arrayMessages["date"] . ", " . $arrayMessages["time"] . "</td>";
	echo "	</tr>
		<tr class=\"messageTable\">
		<td colspan=3>Subject: <a href=\"message.php?id=" . $arrayMessages["id"] . "\">";
	if ($arrayMessages["state"] == 0)
		echo "<b>";

	echo $arrayMessages["subject"];

	if ($arrayMessages["state"] == 0)
		echo "</b>";
		
	echo"</a></td></tr><tr height=5px><td colspan=3></td></tr>";
}

echo "	</table>";
include("bottom.php");
?>