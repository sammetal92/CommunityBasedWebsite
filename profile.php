<?php
if (!isset($_COOKIE["user"]))
	die ("No user logged in!");

include("top.php");
echo "<head><title>Profile - The GameBook</title></head>
	<h1>User Profile - " . $_COOKIE["user"] . "</h1>";

$user = $_COOKIE["user"];
$query = "SELECT * FROM users WHERE username='$user'";
$getUserData = mysqli_query($db, $query);
$arrayData = mysqli_fetch_assoc($getUserData);

echo "	<table>
	<tr><td><b>Name: </b></td><td>" . $arrayData["name"] . "</td></tr>
	<tr><td><b>UserName: </b></td><td>" . $arrayData["username"] . "</td></tr>
	<tr><td><b>Email: </b></td><td>" . $arrayData["email"] . "</td></tr>
	<tr><td><b>Location: </b></td><td>" . $arrayData["location"] . "</td></tr>
	<tr><td><b>Display Picture: </b></td><td><img src=\"" . $arrayData["displayPic"] . "\" height=210px width=210px></td>
	<td><form method=\"post\" action=\"upload_pic.php\" enctype=\"multipart/form-data\"><input type=\"file\" name=\"file\" id=\"file\"></td><td><input type=\"submit\" value=\"Upload\"></form></tr>
	</table>";

include("bottom.php");
echo "</body>\n</html>";
?>