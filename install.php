<!DOCTYPE html>
<html>
</body>


<?php 
$servername = "localhost";
$username = "root";
$password = "mysql";
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



$sql ="DROP DATABASE IF EXISTS dogayaglicioglu";
if($conn->query($sql)==TRUE){
	echo "Database dropped successfully";

}
else{
	echo "Error dropping database.\n";
}

echo "<br>";

$sql ="CREATE DATABASE IF NOT EXISTS dogayaglicioglu";
if($conn->query($sql)==TRUE){
	echo "Database created successfully";

}
else{
	echo "Error creating database.";
}
echo "<br>";
$conn->close();
?>

<?php 
$servername = "localhost";
$username = "root";
$password = "mysql";
$database = "dogayaglicioglu";

$conn = mysqli_connect($servername, $username, $password,$database);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

echo "Connected to database";


$sql = "CREATE TABLE IF NOT EXISTS `Clients`(`ClientID`INT NOT NULL AUTO_INCREMENT,`ClientName`VARCHAR(30) NOT NULL, `ClientSurname`VARCHAR(30) NOT NULL, PRIMARY KEY(`ClientID`)) ENGINE = InnoDB";
$result = mysqli_query($conn,$sql) or die("20");


$sql = "CREATE TABLE IF NOT EXISTS `Districts`(`DistrictID`INT NOT NULL AUTO_INCREMENT,`DistrictName` VARCHAR(40) NOT NULL, PRIMARY KEY(`DistrictID`)) ENGINE = InnoDB";
$result = mysqli_query($conn,$sql) or die("21");




$sql = "CREATE TABLE IF NOT EXISTS `Cities`(`CityID`INT NOT NULL AUTO_INCREMENT, `CityName` VARCHAR(50) NOT NULL,`DistrictID` INT NOT NULL, FOREIGN KEY fk_Cities_DistrictID(`DistrictID`) REFERENCES `Districts`(`DistrictID`),PRIMARY KEY(`CityID`)) ENGINE = InnoDB";
$result = mysqli_query($conn,$sql) or die("22");



$sql = "CREATE TABLE IF NOT EXISTS `TravelAgents`(`TravelAgentID` INT NOT NULL AUTO_INCREMENT, `TravelAgentName`VARCHAR(35) NOT NULL,`Price`INT NOT NULL, PRIMARY KEY(`TravelAgentID`)) ENGINE = InnoDB";
$result = mysqli_query($conn,$sql) or die("23");

$sql = "CREATE TABLE IF NOT EXISTS `Hotels`(`HotelID` INT NOT NULL AUTO_INCREMENT, `HotelName`VARCHAR(35) NOT NULL,`CityID` INT NOT NULL, FOREIGN KEY fk_Hotels_CityID(`CityID`) REFERENCES `Cities`(`CityID`), PRIMARY KEY(`HotelID`)) ENGINE = InnoDB";
$result = mysqli_query($conn,$sql) or die("24");



$sql = "CREATE TABLE IF NOT EXISTS `RoomTypes`(`RoomTypeID`INT NOT NULL AUTO_INCREMENT, `RoomType` VARCHAR(40) NOT NULL, `Price` INT NOT NULL, PRIMARY KEY(`RoomTypeID`)) ENGINE=InnoDB";
$result = mysqli_query($conn,$sql) or die("25");

$sql = "CREATE TABLE IF NOT EXISTS `Rooms`(`RoomID`INT NOT NULL AUTO_INCREMENT, `RoomTypeID` INT NOT NULL, `HotelID`INT NOT NULL, FOREIGN KEY fk_Rooms_HotelID(`HotelID`) REFERENCES `Hotels`(`HotelID`), FOREIGN KEY fk_Rooms_RoomTypeID(`RoomTypeID`) REFERENCES `RoomTypes` (`RoomTypeID`), PRIMARY KEY(`RoomID`)) ENGINE = InnoDB";
$result = mysqli_query($conn,$sql) or die("26");

$sql = "CREATE TABLE IF NOT EXISTS `Facilities`(`FacilityID`INT NOT NULL AUTO_INCREMENT, `FacilityName` VARCHAR(40) NOT NULL,`HotelID`INT NOT NULL, FOREIGN KEY fk_Facilities_HotelID(`HotelID`) REFERENCES Hotels(`HotelID`), PRIMARY KEY(`FacilityID`)) ENGINE = InnoDB";
$result = mysqli_query($conn,$sql) or die("27");

$sql = "CREATE TABLE IF NOT EXISTS `Bookings`(`BookingNumber`INT NOT NULL AUTO_INCREMENT, `TravelAgentName` VARCHAR(40) NOT NULL, `TravelAgentID`INT NOT NULL,`BookingDate`DATE NOT NULL, `CheckInDate`DATE NOT NULL, `CheckOutDate`DATE NOT NULL,`ClientID` INT NOT NULL,`RoomID`INT NOT NULL,FOREIGN KEY fk_Bookings_RoomID(`RoomID`) REFERENCES `Rooms` (`RoomID`), FOREIGN KEY fk_Bookings_TravelAgentID(`TravelAgentID`) REFERENCES `TravelAgents` (`TravelAgentID`),FOREIGN KEY fk_Bookings_ClientID(`ClientID`) REFERENCES `Clients` (`ClientID`),PRIMARY KEY(`BookingNumber`)) ENGINE=InnoDB";
$result = mysqli_query($conn,$sql) or die("28");


$file = fopen("Districts.csv","r");
while(($row = fgetcsv($file, 1000, ";")) !== FALSE)
{
	$sql = "INSERT INTO Districts(DistrictName) values('$row[0]')"; 
	mysqli_query($conn,$sql);
}
fclose($file);


$file = fopen("City.csv","r");
while(($row = fgetcsv($file, 1000, ";")) !== FALSE)
{
	$sql = "INSERT INTO Cities(CityName,DistrictID) values('$row[0]', '$row[1]')"; 
	mysqli_query($conn,$sql);
}
fclose($file);


$file = fopen("TravelAgents.csv","r");
while(($row = fgetcsv($file, 1000, ";")) !== FALSE)
{
	$sql = "INSERT INTO TravelAgents(TravelAgentName,Price) values('$row[0]','$row[1]')"; 
	mysqli_query($conn,$sql);
}
fclose($file);


$ClientName = array();
$header = NULL;
//$row = 0;
$file = fopen("Names.csv","r");
while(($row = fgetcsv($file, 1000, ";")) !== FALSE)
{
	if(!$header)
		$header = $row;
	else
		$ClientName[] = $row[0];
}
fclose(file);

$ClientSurname = array();
$header = NULL;
//$row = 0;
$file = fopen("Surname.csv","r");
while(($row = fgetcsv($file, 1000, ";")) !== FALSE)
{
	if(!$header)
		$header = $row;
	else
		$ClientSurname[] = $row[0];
}
fclose(file);

for($i=0; $i<1620;$i++)
{
	if($i >= 250){
		$randnamenumber=rand(250,500);
		$randsurnamenumber=rand(250,500);

	}
	else{
		$randnamenumber=rand(1,250);
		$randsurnamenumber=rand(1,250);

	}
	$sql = "INSERT INTO Clients(ClientName,ClientSurname) values('$ClientName[$randnamenumber]','$ClientSurname[$randsurnamenumber]')";
	mysqli_query($conn,$sql);

}


$file = fopen("Hotels.csv","r");
while(($row = fgetcsv($file, 10000, ";")) !== FALSE)
{
	$sql = "INSERT INTO Hotels(HotelName,CityID) values('$row[0]','$row[1]')"; 
	mysqli_query($conn,$sql);
}
fclose($file);

$file = fopen("Facilities.csv","r");
while(($row = fgetcsv($file, 10000, ";")) !== FALSE)
{
	$sql = "INSERT INTO Facilities(FacilityName,HotelID) values('$row[0]','$row[1]')"; 
	mysqli_query($conn,$sql);
}
fclose($file);

$file = fopen("Roomtype.csv","r");
while(($row = fgetcsv($file, 10000, ";")) !== FALSE)
{
	$sql = "INSERT INTO RoomTypes(RoomType,Price) values('$row[0]','$row[1]')"; 
	mysqli_query($conn,$sql);
}
fclose($file);

$file = fopen("Rooms.csv","r");
while(($row = fgetcsv($file, 10000, ";")) !== FALSE)
{
	$sql = "INSERT INTO Rooms(HotelID,RoomTypeID) values('$row[0]','$row[1]')"; 
	mysqli_query($conn,$sql);
}
fclose($file);

$file = fopen("Booking.csv","r");
while(($row = fgetcsv($file, 10000, ";")) !== FALSE)
{
	$sql = "INSERT INTO Bookings(ClientID,RoomID,TravelAgentName,TravelAgentID,BookingDate,CheckInDate,CheckOutDate) values('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]')"; 
	mysqli_query($conn,$sql);
}
fclose($file);



mysqli_close($conn);
?>

<html>
</body>