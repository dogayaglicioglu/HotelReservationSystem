
<!DOCTYPE html>
<html>
<body>
<?php


$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "dogayaglicioglu";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 

$cityname = $_POST['cityname'];
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];


 $sql="SELECT Hotels.HotelName, COUNT(Rooms.RoomID) AS NUMOFBOOKS FROM Bookings INNER JOIN Rooms ON Rooms.RoomID = Bookings.RoomID INNER JOIN Hotels ON Rooms.HotelID = Hotels.HotelID INNER JOIN Cities ON Hotels.CityID = Cities.CityID WHERE Cities.CityName = '$cityname'  AND  DATE(Bookings.BookingDate) BETWEEN '$date1' AND '$date2' GROUP BY HotelName";
$result = mysqli_query($conn,$sql) or die("Error");

echo "<form action='BookingInfo.php' method='post'>";
//echo '<label for = "but">BUTTON</label>';
//echo '<input type = "button" id="but" name="but">';

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    echo "<table border='1'>";
    echo "<tr><td>HotelName</td><td>NUMBEROFBOOKINGS</td></tr>";

    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        //echo '<button type="submit" value="Select">';
        echo "<td>" . $row["HotelName"] . "</td><td>" . $row["NUMOFBOOKS"]. "</td><td>" . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";
    $result = mysqli_query($conn,$sql) or die("Error");


    
    
} else {
    echo "0 results";
}
echo "</form>";
mysqli_close($conn);
?>

</body>
</html>
