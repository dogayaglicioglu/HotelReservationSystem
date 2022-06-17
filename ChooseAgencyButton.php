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
$agencyname = $_POST['agencyname'];

$sql="SELECT Bookings.BookingNumber, Bookings.TravelAgentID, Bookings.BookingDate, Bookings.CheckInDate, Bookings.CheckOutDate, Clients.ClientName, Bookings.RoomID FROM Bookings INNER JOIN TravelAgents ON TravelAgents.TravelAgentID = Bookings.TravelAgentID INNER JOIN Rooms ON Rooms.RoomID = Bookings.RoomID INNER JOIN Hotels ON Hotels.HotelID = Rooms.HotelID INNER JOIN Clients ON Bookings.ClientID = Clients.ClientID WHERE Hotels.HotelName='$hotelname' AND TravelAgents.TravelAgentName = '$agencyname' GROUP BY Bookings.BookingNumber";

$result = mysqli_query($conn,$sql) or die("Error");


if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><td>Booking Number</td><td>Travel Agent ID</td><td>Booking Date</td><td>CheckInDate</td><td>Check Out Date</td><td>Client Name</td><td>Room ID</td></tr>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        //echo '<button type="submit" value="Select">';
        echo "<td>" . $row["BookingNumber"] . "</td><td>" . $row["TravelAgentID"]. "</td><td>" . $row["BookingDate"] . "</td><td>" . $row["CheckInDate"]. "</td><td>" . $row["CheckOutDate"]. "</td><td>" . $row["ClientName"]. "</td><td>" . $row["RoomID"]. "</td>";
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
