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
    // Get the input values from the form
    $studentName = $_POST["studentName"];
    $course = $_POST["course"];

    // Query the database to get the attendance records for the specific student and course
    $sql = "SELECT m.Date, t.Course 
            FROM `main table` m 
            JOIN `student table` s ON m.cardId = s.cardId 
            JOIN `time_table` t ON m.Date = t.Date 
            WHERE s.studentName = '$studentName' AND t.Course = '$course'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Attendance Records for $studentName - Course: $course</h3>";
        echo "<table>
                <tr>
                    <th>Date</th>
                    <th>Course</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["Date"]."</td>
                    <td>".$row["Course"]."</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No attendance records found for the given student and course.</p>";
    }
}

$conn->close();
?>

<style>
h3 {
    text-align: center;
    
    font-size: 20px;
}

table {
    margin: 0 auto;
    border-collapse: collapse;
    width: 40%;
}

table th, table td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: center;
}

table th {
    background-color: #f2f2f2;
}

p.no-records {
    color: red;
    text-align: center;
}

</style>