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

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the student name from the form
    $studentName = $_POST["studentName"];

    // Fetch the attendance records for the student from the database
    $sql = "SELECT `Date`, COUNT(cardId) AS AttendanceCount
            FROM `main table`
            WHERE cardId IN (
                SELECT cardId
                FROM `student table`
                WHERE studentName = '$studentName'
            )
            GROUP BY `Date`";

    $result = $conn->query($sql);

    // Generate the attendance graph using Python script
    if ($result->num_rows > 0) {
        // Prepare the data as a comma-separated string
        $data = "";
        while ($row = $result->fetch_assoc()) {
            $data .= $row["AttendanceCount"] . ",";
        }
        $data = rtrim($data, ",");  // Remove the trailing comma

        // Call the Python script to generate the graph
        $command = "python graph.py \"$studentName\" \"$data\"";
        exec($command, $output, $return_val);

        if ($return_val == 0) {
            echo "<div class='container'>";
            echo "<h3 class='graph-title'>Attendance Graph for $studentName</h3>";
            echo "<img src='attendance_graph.png' class='graph-image'>";
            echo "</div>";
        } else {
            echo "<p>An error occurred while generating the graph.</p>";
        }
    } else {
        echo "<p>No attendance records found for the given student.</p>";
    }
}

$conn->close();
?>

<style>
/* graph-style.css */

.container {
  text-align: center;
}

.graph-title {
  font-size: 25px;
  font-weight: bold;
  color: #333333;
 
}

.graph-image {
  width: 600px;
  height: auto;
  margin-top: 50px;
  border: 2px solid #333333;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
  background-color: #f2f2f2;
}

.graph-image:hover {
  border-color: #ff0000;
  box-shadow: 0 0 8px rgba(255, 0, 0, 0.3);
}

.graph-image:active {
  transform: scale(0.95);
}


</style>