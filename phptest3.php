<?php
// Prepare variables for database connection
$dbusername = "root";  // enter database username, I used "arduino" in step 2.2
$dbpassword = "";  // enter database password, I used "arduinotest" in step 2.2
$server = "localhost"; // IMPORTANT: if you are using XAMPP enter "localhost", but if you have an online website enter its address, ie."www.yourwebsite.com"
$dbname = "mydb";

date_default_timezone_set('Asia/Kolkata');
$hrs=date("h");  // hours
$mins=date("i");  //  minutes
$ddate=date("d-m-Y");
$dday=date("l");
echo $ddate;
echo $dday;
// Connect to your database
$dbconnect = mysqli_connect("localhost","root","","mydb");
if (!$dbconnect) {
    die("Database connection failed: " . mysqli_connect_error());
}
$dbselect = mysqli_select_db($dbconnect, "mydb");
if (!$dbselect) {
    die("Database selection failed: " . mysqli_connect_error());
}
// Prepare the SQL statement
//$sql = "INSERT INTO arduinotest1.tabletest2 (temperature,humidity,soilmoisture) VALUES ('".$_GET["temperature"]."','".$_GET["humidity"]."','".$_GET["soilmoisture"]."')"; 

$sql = "INSERT INTO mydb.mytable (cardId,ddate,dday,hrs,mins) VALUES ('".$_GET["cardId"]."','" . $ddate. "','".$dday."','" . $hrs . "','" . $mins ."')";    



// Execute SQL statement
mysqli_query($dbconnect,$sql);
?>