<?php
include("top.php");

echo "<head>
	<title>Forgot Password - The GameBook</title>
	<script>
		function validateForm()
		{
			var valid = true;
			var x=document.forms[\"contact\"][\"email\"].value;
			var atpos=x.indexOf(\"@\");
			var dotpos=x.lastIndexOf(\".\");

			if (document.forms[\"forgot\"][\"email\"].value == null || document.forms[\"forgot\"][\"email\"].value == \"\")
			{
				valid = false;
				alert(\"You need to give an email address.\");
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
	</head>";

echo "Enter your email address, if it is in our database, your password will be emailed to you.
<br / ><form name=\"forgot\" method=\"POST\" action=\"sendPassword.php\" onsubmit=\"return validateForm();\">
	<input type=\"text\" name=\"email\">  <input type=\"submit\" value=\"Send\">
</form>";
include("bottom.php");
?>