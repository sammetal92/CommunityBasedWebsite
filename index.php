<?php
include("top.php");
echo "<head><title>Home - The GameBook</title></head>";

$query = mysqli_query($db, "SELECT * FROM headlines ORDER BY id DESC LIMIT 5");

echo "	<h1>Headlines</h1>";

echo "	<table style=\"width:100%;\">";

while ($result = mysqli_fetch_assoc($query))
{
	echo "	<tr style=\"border:1px solid black; padding:5px;\">";
	echo "\n	<td><img src=" . $result['image'] . " height=124px width=280px></td><td style=\"width:100%;\"><h3><a href=\"" . $result["link"] . "\">" . $result['title'] . " (" . $result['date'] . ")</a></h3>" . $result['description'] . "</td>";
	echo "	</tr>";
}

echo "	</table>";

echo "\n	</p>";
include("bottom.php");
echo "</body>
</html>";
?>