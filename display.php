<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'test');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed: " . $conn->connect_error);
} else {
    $sql = "SELECT * FROM registration";
    $result = $conn->query($sql);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Display Data</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    </head>
    <body>
    <div class="container">
        <h2>Registered Students</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Card Id</th>
                <th>USN</th>
                <th>Student Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Mobile Number</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row['cardId']; ?></td>
                        <td><?php echo $row['usn']; ?></td>
                        <td><?php echo $row['studentName']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['mobileNo']; ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6">No records found.</td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    </body>
    </html>

    <?php
    // Close the database connection
    $conn->close();
}
?>
