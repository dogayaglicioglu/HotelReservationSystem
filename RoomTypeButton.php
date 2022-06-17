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

$sql="SELECT RoomTypes.RoomType, COUNT(Bookings.BookingNumber) AS NUMBEROFBOOKING FROM Bookings INNER JOIN Rooms ON Rooms.RoomID = Bookings.RoomID INNER JOIN RoomTypes ON Rooms.RoomTypeID = RoomTypes.RoomTypeID INNER JOIN Hotels ON Rooms.HotelID = Hotels.HotelID WHERE Hotels.HotelName = '$hotelname' GROUP BY RoomTypes.RoomType";

$result = mysqli_query($conn,$sql) or die("Error");


if (mysqli_num_rows($result) > 0) {
    echo "<table border='4'>";
    echo "<tr><td>RoomTypes</td><td>NUMBEROFBOOKING</td></tr>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row["RoomType"] . "</td><td>" . $row["NUMBEROFBOOKING"]. "</td><td>" . "</td>";
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
