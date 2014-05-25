<?php
include("top.php");
echo "<head><title>Forums - The GameBook</title></head>
	<h1>Forums</h1>";

$query = "SELECT * FROM forums";
$execute = mysqli_query($db, $query);

echo "<center><table width=75%>";
while ($result = mysqli_fetch_assoc($execute))
{
	echo "	<center><table style=\"border-collapse: collapse; border: 1px solid blue\">	
		<tr>
			<td width=100%><b><a href=\"threads.php?forum=" . $result["id"] . "\">" . $result["title"] . "</a></b></td><td>Threads: </td><td>" . $result["threadCount"] . "</td>
		</tr>
		<tr>
			<td>" . $result["description"] . "</td><td></td><td></td>
		</tr>
	</table></center>";
}
echo "</table>";
include("bottom.php");
echo "</center>
</html>";
?>