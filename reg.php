<?php

if ($_POST["pass"] != $_POST["repass"])
{
	echo "Try again, both passwords do not match.<br />";
	echo "<input type=\"button\" onclick=\"history.go(-1)\" value=\"Go Back and Try Again\">";
	die();
}

$db = mysqli_connect("localhost", "root", "", "thegamebook");

if (mysqli_connect_errno())
	die(mysqli_connect_error());

$user = $_POST["username"];
$email = $_POST["email"];

$emailQueryString = "SELECT * FROM users WHERE email='$email'";
$userQueryString = "SELECT * FROM users WHERE username='$user'";

$queryForEmail = mysqli_query($db, $emailQueryString) or die(mysqli_error($db));
$queryForUsername = mysqli_query($db, $userQueryString) or die(mysqli_error($db));

if (mysqli_num_rows($queryForUsername) >= 1)
{
	echo "Try again, username already in use.<br />";
	echo "<input type=\"button\" onclick=\"history.go(-1)\" value=\"Go Back and Try Again\">";
	die();
}

if (mysqli_num_rows($queryForEmail) >= 1)
{
	echo "Try again, email already registered.<br />";
	echo "<input type=\"button\" onclick=\"history.go(-1)\" value=\"Go Back and Try Again\">";
	die();
}

$name = $_POST["name"];
$password = $_POST["pass"];
$location = $_POST["location"];

$queryString = "INSERT INTO users(id, name, username, password, email, location, rank) VALUES(NULL, '".$name."', '".$user."', '".$password."', '".$email."', '".$location."', '1')";
$submitQuery = mysqli_query($db, $queryString);

if ($submitQuery)
	echo "Success!<br /><a href=\"index.php\">Go back to home page</a>";
else echo "Failed.<br /><input type=\"button\" onclick=\"history.go(-1)\" value=\"Go Back and Try Again\">";
?>