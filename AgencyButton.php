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

$hotelname = $_POST['hotelname'];
//print_r("$hotelname");

$sql="SELECT TravelAgents.TravelAgentName, TravelAgents.Price*COUNT(Bookings.RoomID) AS Price FROM Bookings INNER JOIN Rooms ON Rooms.RoomID = Bookings.RoomID INNER JOIN RoomTypes ON Rooms.RoomTypeID = RoomTypes.RoomTypeID INNER JOIN Hotels ON Rooms.HotelID = Hotels.HotelID INNER JOIN TravelAgents ON TravelAgents.TravelAgentID = Bookings.TravelAgentID INNER JOIN Cities ON Cities.CityID = Hotels.CityID WHERE Hotels.HotelName = '$hotelname' GROUP BY TravelAgents.TravelAgentID";

$result = mysqli_query($conn,$sql) or die("Error");

//echo "$result";
if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><td>TravelAgentName</td><td>Price</td></tr>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        //echo '<button type="submit" value="Select">';
        echo "<td>" . $row["TravelAgentName"] . "</td><td>" . $row["Price"] . "</td><td>" . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";
    
} else {
    echo "0 results";
}
   
mysqli_close($conn);
?>

</body>
</html>
