<!DOCTYPE html>
<html>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "dogayaglicioglu";

$conn = mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
	die("Connect fail:" . mysqli_connect_error());
}
$sql = "SELECT cityName FROM Cities ";
$result = mysqli_query($conn,$sql) or die("Error");

	echo "<form action='FilterHotelsByCityDate.php' method='post'>";
	echo '<label for = "cityname">City Name:</label>';
	echo '<select name="cityname">';
	while($row = mysqli_fetch_array($result)) {
		echo "<option value='" . $row["cityName"] . "'>";
        echo $row["cityName"];
		echo "</option>";
    }
	echo '</select>';
	
	//echo '<input type="text id="cityname" name="cityname">';
	echo "<br>";
	echo '<label for="date1">Start Date:</label>';
 	echo '<input type="date" id="date1" name="date1">';
 	echo "<br>";
 	echo '<label for="date2">End Date:</label>';
 	echo '<input type="date" id="date2" name="date2">';
 	echo "<br>";
	echo '<input type="submit" value="Submit">';
	echo "</form>";
mysqli_close($conn);
?>

</body>
</html>
