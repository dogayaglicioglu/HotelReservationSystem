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



$sql="SELECT Clients.ClientName, Clients.ClientSurname, Clients.ClientID FROM Clients INNER JOIN Bookings ON Bookings.ClientID = Clients.ClientID INNER JOIN Rooms ON Bookings.RoomID = Rooms.RoomID INNER JOIN Hotels ON Hotels.HotelID = Rooms.HotelID WHERE Hotels.HotelName = '$hotelname' ";

$result = mysqli_query($conn,$sql) or die("Error1");

echo "<form action='invoice2.php' method='post'>";
echo '<label for = "client">SELECT CLIENT NAME:</label>';
echo '<select name="client">';
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) {
        echo "<option value='" . $row["ClientName"] . $row["ClientSurname"] . "'>";
        echo $row["ClientName"] . $row["ClientSurname"];
        //echo $row["ClientID"];
        echo "</option>";
    }
    echo "</select>";

    
} else {
    echo "0 results";
}
   
echo "<br/>";
echo '<input type="submit" value="Submit">';
echo "</form>";
mysqli_close($conn);
?>

</body>
</html>
