<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="author" content="Pejoal Nagy">
	<title>SETUP PROGRAM</title>
</head>

<body>
	<?php
	$conn = new mysqli("localhost", "id19400222_root", "Pd9SSL3guSntsai-");
	if ($conn->connect_error) {
		die("Can't Connect MYSQL SYSTEM" . $conn->connect_error);
	}
	echo "Connected To SYSTEM Successfully <br>";
	$sql = "CREATE DATABASE id19400222_login_system";
	// if ($conn->query($sql) === TRUE) {
	// 	echo "Database Created Successfully <br>";
	// } else {
	// 	echo "Can't Create Database" . $conn->error . "<br>";
	// }
	// $conn->close();
	$conn = new mysqli("localhost", "id19400222_root", "Pd9SSL3guSntsai-", "id19400222_login_system");
	if ($conn->connect_error) {
		die("Can't Connect To The Database" . $conn->connect_error . "<br>");
	}

	$sql = "CREATE TABLE main(
	ID INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL DEFAULT 'UNKNOWN',
	product VARCHAR(50) NOT NULL DEFAULT 'UNKNOWN',
	full_price INT(7) NOT NULL,
	datee VARCHAR(60) NOT NULL,
	done INT(6) NOT NULL,
	for_month INT(6) NOT NULL,
	the_rest INT(6) NOT NULL
	)";
	if ($conn->query($sql) === TRUE) {
		echo "MAIN TABLE CREATED Successfully";
	} else {
		echo "ERROR IN CREATE MAIN TABEL " . $conn->error;
	}
	echo "<h2>With My Best Wishes, Enjoy My PROGRAM</h2>";
	?>
	<div style="color: #FFF;background: #000;font-size: 2em;font-style: italic;font-family: 'Comic Sans MS';margin: 30px 400px;text-align: center;">AMAZING <span style="font-family: 'Script MT';">BEGOL NAGY</span></div>
</body>

</html>