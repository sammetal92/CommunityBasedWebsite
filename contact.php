<?php
include("top.php");

echo "<head>
	<title>Contact - The GameBook</title>
	<script>
		function validateForm()
		{
			var valid = true;
			var x=document.forms[\"contact\"][\"email\"].value;
			var atpos=x.indexOf(\"@\");
			var dotpos=x.lastIndexOf(\".\");

			if (document.forms[\"contact\"][\"email\"].value == null || document.forms[\"contact\"][\"email\"].value == \"\" ||
				document.forms[\"contact\"][\"subject\"].value == null || document.forms[\"contact\"][\"subject\"].value == \"\" ||
				document.forms[\"contact\"][\"body\"].value == null || document.forms[\"contact\"][\"body\"].value == \"\")
			{
				valid = false;
				alert(\"You must fill all fields!\");
			}

			else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
			{
			  	valid = false;
			  	alert(\"Not a valid e-mail address!\");
			}
			else valid = true;

			return valid;

		}
	</script>
	</head>
	<h1>Contact Us</h1>
	<table>
	<form method=\"POST\" action=\"contactSend.php\" name=\"contact\" onsubmit=\"return validateForm();\">
	<tr>
		<td><b>Your email address: </b></td><td><input type=\"text\" name=\"email\"></td>
	</tr>
	<tr>
		<td><b>Subject: </b></td><td><input type=\"text\" name=\"subject\"></td>
	</tr>
	<tr>
		<td style=\"vertical-align: top;\"><b>Message: </b></td><td><textarea name=\"body\" rows=10 cols=50></textarea></td>
	</tr>
	<tr>
		<td></td><td><input type=\"submit\" value=\"Send\"></td>
	</tr>
	</form>
	</table>";
include("bottom.php");
?>