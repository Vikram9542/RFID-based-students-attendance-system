<?php
	$cardId = $_POST['cardId'];
	$usn = $_POST['usn'];
	$studentName = $_POST['studentName'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$mobileNo = $_POST['mobileNo'];

	// Database connection
	$conn = new mysqli('localhost','root','','test');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into registration(cardId	,usn,studentName,gender,email,mobileNo) values(?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssi", $cardId, $usn, $studentName, $gender, $email, $mobileNo);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
	}
?>

