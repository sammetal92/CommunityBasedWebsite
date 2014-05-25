<?php
include("top.php");
echo "<head><title>News - The GameBook</title></head>
	<h1>News</h1>";

$urlId = isset($_GET["id"]) ? $_GET["id"] : "";
$query = "SELECT * FROM news WHERE id='$urlId'";
$execQuery = mysqli_query($db, $query);

if ($urlId == "" || $urlId == null || mysqli_num_rows($execQuery) != 1)
{
	$query = "SELECT * FROM headlines ORDER BY id DESC LIMIT 10";
	$execQuery = mysqli_query($db, $query);
	$singleRow = 0;
	while ($result = mysqli_fetch_assoc($execQuery))
	{
		echo "	<tr style=\"padding:5px;\">";
		if ($singleRow < 3)
		{
			echo "\n	<td><img src=" . $result['image'] . " height=124px width=280px></td><td style=\"width:100%;\"><h3><a href=\"" . $result["link"] . "\">" . $result['title'] . " (" . $result['date'] . ")</a></h3>" . "</td>";
			$singleRow++;
		}
		else
			$singleRow = 0;
		echo "	</tr>";
	}
}

else
{
	$result = mysqli_fetch_assoc($execQuery);
	echo "<h2>" . $result["title"] . " - " . $result["date"] . "</h2>";
	echo "<img src=" . $result["image"] . " height=224 width=380px><br /><br />";
	echo $result["description"];
}
include("bottom.php");
?>