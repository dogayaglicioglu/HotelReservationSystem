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


$sql="SELECT DISTINCT(HotelName) from Hotels";
$result = mysqli_query($conn,$sql) or die("Error");

echo "<form action='RoomTypeButton.php' method='post'>";
echo '<label for = "hotelname">SELECT HOTEL FOR ROOM TYPE:</label>';
echo '<select name="hotelname">';

if (mysqli_num_rows($result) > 0) {
    
    while($row = mysqli_fetch_array($result)) {
        echo "<option value='" . $row["HotelName"] . "'>";
        echo $row["HotelName"];
        echo "</option>";
    }
    echo '</select>';
    
} else {
    echo "0 results";
}
echo '<input type="submit" value="Room Type">';
echo "</form>";

echo "<br/>";
echo "<br/>";


$result = mysqli_query($conn,$sql) or die("Error");
//echo '<input type="submit" value="Room Type">';
echo "<form action='AgencyButton.php' method='post'>";
echo '<label for = "hotelname">SELECT HOTEL FOR Agency:</label>';
echo '<select name="hotelname">';
while($row = mysqli_fetch_array($result)) {
    echo "<option value='" . $row["HotelName"] . "'>";
    echo $row["HotelName"];
    echo "</option>";
}
echo '</select>';
echo '<input type="submit" value="Agency">';
echo "</form>";

echo "<br/>";
echo "<br/>";


$result = mysqli_query($conn,$sql) or die("Error");
//echo '<input type="submit" value="Room Type">';
echo "<form action='ChooseAgencyButton.php' method='post'>";

echo '<label for = "hotelname">SELECT HOTEL AFTER SELECT Agency:</label>';
echo '<select name="hotelname">';
while($row = mysqli_fetch_array($result)) {
    echo "<option value='" . $row["HotelName"] . "'>";
    echo $row["HotelName"];
    echo "</option>";
}
echo '</select>';
//echo '<input type="submit" value="Agency">';
$sql2="SELECT DISTINCT(TravelAgentName) from TravelAgents";
$res2 = mysqli_query($conn,$sql2) or die("Error");
//echo '<label for = "hotelname">SELECT HOTEL AFTER SELECT Agency:</label>';
echo '<select name="agencyname">';
while($row = mysqli_fetch_array($res2)) {
    echo "<option value='" . $row["TravelAgentName"] . "'>";
    echo $row["TravelAgentName"];
    echo "</option>";
}
echo '</select>';
echo '<input type="submit" value="Choose Agency">';
echo "</form>";

echo "<br/>";
echo "<br/>";




$result = mysqli_query($conn,$sql) or die("Error");

echo "<form action='invoice.php' method='post'>";
echo '<label for = "hotelname">SELECT HOTEL FOR INVOICE:</label>';
echo '<select name="hotelname">';

if (mysqli_num_rows($result) > 0) {
    
    while($row = mysqli_fetch_array($result)) {
        echo "<option value='" . $row["HotelName"] . "'>";
        echo $row["HotelName"];
        echo "</option>";
    }
    echo '</select>';
    
} else {
    echo "0 results";
}
echo '<input type="submit" value="Invoice">';
echo "</form>";
//echo '<input type="submit" value="Invoice">';



//echo "</form>";



mysqli_close($conn);
?>

</body>
</html>
