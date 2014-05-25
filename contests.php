<?php
include("top.php");

echo "<head><title>Contests - The GameBook</title></head>";
echo "<h1>Contests</h1>";

if (!isset($_GET["contest"]))
{
	$query = "SELECT * FROM contests WHERE deadline > (SELECT CURDATE()) ORDER BY id DESC";
	$execute = mysqli_query($db, $query);
	$contestArray = mysqli_fetch_assoc($execute);

	echo "<center><img width=300px height=170px src=" . $contestArray["image"] . ">";
	echo "<br /><h3><a href=\"contests.php?contest=" . $contestArray["id"] . "\">" . $contestArray["title"] . "</a></h3>";
	echo  $contestArray["shortDesc"];
	echo "</center>";
	echo "<h2>Other Contests</h2>
		<table>";

	while ($contestArray = mysqli_fetch_assoc($execute))
	{
		echo "	<tr>
				<td><center><h3><a href=\"contests.php?contest=" . $contestArray["id"] . "\">" . $contestArray["title"] . "</a></h3><br /><img src=" . $contestArray["image"] . " width=250px height=120px></center></td>
				<td>" . $contestArray["shortDesc"] . "</td>
			</tr>";
	}
	echo "</table>";
}

else
{
	$query = "SELECT * FROM contests WHERE id='" . $_GET["contest"] . "'";
	$execute = mysqli_query($db, $query);
	$contestArray = mysqli_fetch_assoc($execute);
	echo "<h2>" . $contestArray["title"] . "</h2><img width=300px height=170px src=" . $contestArray["image"] . ">
	<br />" . $contestArray["description"] . "<br /><br /><b><u>Deadline:</u> ". $contestArray["deadline"];
}
include("bottom.php");
?>