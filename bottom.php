<?php
echo "<hr>";

echo "<table width=100%>
	<tr>
		<td style=\"font-size: 9pt;\">Made by the YOLO Team</td>";

if(isset($_COOKIE["user"]))
{
	$user = $_COOKIE["user"];
	$query = "SELECT * FROM users WHERE username='$user'";
	$execute = mysqli_query($db, $query);
	$adminArray = mysqli_fetch_assoc($execute);

	if ($adminArray["rank"] == 2 || $adminArray["rank"] == 3)
		echo "<td style=\"text-align: right;font-size: 9pt;\"><a href=\"adminTool.php\">Administrator Panel</a></td>";
}

echo "</table>";
?>