<?php
$db = mysqli_connect("localhost", "root", "", "thegamebook");
if (mysqli_connect_errno())
{
	die(mysqli_connect_error());
}

$user = isset($_COOKIE["user"]) ? $_COOKIE["user"] : null;

if ($user != null)
{
	$getUserId = mysqli_query($db, "SELECT * FROM users WHERE username='$user'");
	$arrayUser = mysqli_fetch_assoc($getUserId);
	$query = "SELECT * FROM messages WHERE toUser='" . $arrayUser["id"] . "' AND state='0'";
	$result = mysqli_query($db, $query);
	$count = mysqli_num_rows($result);
}

echo "<html>
<head>
	
	<link rel=\"stylesheet\" href=\"style.css\" type=\"text/css\">
</head>
<body>
	<center>
	<br /><br />
	<a href=\"index.php\"><div id=\"main-header\"></div></a>
	<p>
	<div id=\"navbar\">
	<ul class=\"navig\" id=\"topnavbar\">
		<li class=\"navig\"><a href=\"news.php\">News</a></li>
		<li class=\"navig\"><a href=\"forums.php\">Forums</a></li>
		<li class=\"navig\"><a href=\"contests.php\">Giveaways And Competitions</a></li>";

if (!isset($_COOKIE["user"]))
{
	echo "	<li class=\"navig\"><a href=\"login.html\">Login</a></li>
		<li class=\"navig\"><a href=\"register.html\">Register</a></li>";
}

else
{
	echo "	<li class=\"navig\"><a href=\"profile.php\">Profile</a></li>
		<li class=\"navig\"><a href=\"logout.php\">Logout (" . $_COOKIE["user"] . ")</a></li>
		<li class=\"navig\"><a href=\"messaging.php\">Inbox (" . $count . ")</a></li>";
}
	echo "	<li class=\"navig\"><a href=\"about.php\">About Us</a></li>
		<li class=\"navig\"><a href=\"contact.php\">Contact</a></li>
	</ul>
	</div>
	</p>
	</center>
	<p>";
?>