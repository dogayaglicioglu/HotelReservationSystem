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

$clientnamesurname = $_POST['client'];


$sql="SELECT Rooms.RoomID, RoomTypes.RoomType, Bookings.BookingDate, Bookings.CheckInDate, Bookings.CheckOutDate, (DATEDIFF(Bookings.CheckOutDate,Bookings.CheckInDate)*TravelAgents.Price*RoomTypes.Price) AS TotalCost, (DATEDIFF(Bookings.CheckOutDate,Bookings.CheckInDate)*RoomTypes.Price) AS BookingPrice from Bookings INNER JOIN Rooms ON Bookings.RoomID = Rooms.RoomID INNER JOIN RoomTypes ON Rooms.RoomTypeID = RoomTypes.RoomTypeID INNER JOIN TravelAgents ON TravelAgents.TravelAgentID = Bookings.TravelAgentID INNER JOIN Clients ON Bookings.ClientID = Clients.ClientID INNER JOIN Hotels ON Rooms.HotelID = Hotels.HotelID WHERE CONCAT(Clients.ClientName,Clients.ClientSurname) = '$clientnamesurname'";

$result = mysqli_query($conn,$sql) or die("Error1");

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    echo "<table border='1'>";
    echo "<tr><td>Room ID</td><td>Room Type</td><td>Booking Date</td><td>Check In Date</td><td>Check Out Date</td><td>Total Cost</td><td>Booking Price</td></tr>";

    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        //echo '<button type="submit" value="Select">';
        echo "<td>" . $row["RoomID"] . "</td><td>" . $row["RoomType"] . "</td><td>" . $row["BookingDate"] . "</td><td>" . $row["CheckInDate"] . "</td><td>" . $row["CheckOutDate"] . "</td><td>" . $row["TotalCost"] . "</td><td>" . $row["BookingPrice"] . "</td><td>" . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";
    $result = mysqli_query($conn,$sql) or die("Error");


    
    
} else {
    echo "0 results";
}
mysqli_close($conn);
?>

</body>
</html>
