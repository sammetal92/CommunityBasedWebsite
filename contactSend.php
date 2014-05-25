<?php
$from = $_POST["email"];
$subject = $_POST["subject"];
$msg = "From: '$from'\n\n" . $_POST["body"];

if (mail("far.kosh@live.com", $subject, $msg))
{
	echo "<script>alert(\"Message Sent!\");</script>";
	header("Location:index.php");
}
else
{
	echo "<script>alert(\"Message could not be sent!\");</script>";
	header("Location:contact.php");
}
?>