<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli("localhost","root","","test");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the input values from the form
$studentName = $_POST["studentName"];
$course = $_POST["course"];

// Query the database to get the attendance count
$sql = "SELECT COUNT(*) AS attendance_count 
FROM `main table` m 
JOIN `student table` s ON m.cardId = s.cardId 
JOIN `time_table` t ON m.Date = t.Date 
WHERE s.studentName = '$studentName' AND t.Course = '$course'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Output the attendance count
  $row = $result->fetch_assoc();
  $attendanceCount = $row["attendance_count"];
  echo '<div class="container">';
  echo '<h1 class="title">Attendance Count</h1>';
  echo '<table class="table">';
  echo "<tr><td>Student Name:</td><td>$studentName</td></tr>";
  echo "<tr><td>Course:</td><td>$course</td></tr>";
  echo "<tr><td>Attendance Count:</td><td>$attendanceCount</td></tr>";
  echo '</table>';
  echo '</div>';
} else {
  echo '<div class="container">';
  echo '<h1 class="title">Attendance Count</h1>';
  echo '<p class="error">No attendance records found for the given student and course.</p>';
  echo '</div>';
}

$conn->close();
?>

<style>
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f2f2f2;
  border-radius: 5px;
}

.title {
  position: center ;
  font-size: 36px;
  font-weight: bold;
  margin-bottom: 20px;
}

.table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

.table td {
  padding: 10px;
  border: 1px solid #ddd;
}

.error {
  color: red;
  font-weight: bold;
}
</style>
