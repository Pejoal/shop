<?php
if (isset($_GET["done"])) {
	echo "
	<script>
	location.assign('table.php');
	</script>
	";
}
?>
<!DOCTYPE html>
<html dir="rtl">

<head>
	<meta charset="utf-8">
	<title>table</title>
	<!-- <meta http-equiv="refresh" content="<?php echo $tim; ?>;http://localhost/www/Shop/table.php"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Pejoal Nagy">
	<style type="text/css">
		table {
			max-width: 100%;
			overflow-x: auto;
			border-collapse: collapse;
		}
		td {
			border: 1px double grey;
			padding: .5rem;
		}

		th {
			border: 1px solid grey;
			padding: .5rem;

		}
	</style>
</head>

<body>
	<?php
	$servername = "localhost";
	$username = "id19400222_root";
	$password = "Pd9SSL3guSntsai-";
	$dbname = "id19400222_login_system";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT name, product, full_price, datee, done, for_month, the_rest FROM main ORDER BY id ASC";
	// LIMIT 30 / ASC,DESC name ASC, product ASC
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		echo "			<table style='width: 1200px;border: 2px solid red;'>
				<tr>
					<th>اسم المشتري</th><th>اسم المنتج</th><th>الثمن الكلي</th><th>تاريخ البيع</th><th>المقدم</th><th>فلوس الشهر</th><th>الباقي</th><th>طرح فلوس الشهر</th>
				</tr>";
		// output data of each row
		$counter = 1;
		while ($row = $result->fetch_assoc() and $counter < 10000) {
			echo "<tr>" . "<td>" . $row['name'] . "</td>" . "<td>" . $row['product'] . "</td>" . "<td>" . $row['full_price'] . "</td>" . "<td>" . "<form action='dates.php' method='post'><button name='go' value='$counter'>" . $row['datee'] . "</button></form>" . "</td>"  . "<td>" . $row['done'] . "</td>" . "<td>" . $row['for_month'] . "</td>"  . "<td>" . $row['the_rest'] . "</td>" . "<td>" . "<form><button name='done' value='$counter'>طرح فلوس الشهر</button></form>" . "</td>" .  "</tr>";
			$counter += 1;
		}
		echo "</table>";
	} else {
		echo "0 results";
	}
	if (isset($_GET['done'])) {
		$id = $_GET['done'];

		$the_rest = "SELECT the_rest from main WHERE id=$id"; // command
		$result = $conn->query($the_rest); // runs the command
		$row_the_rest = $result->fetch_assoc(); // put the result into assoc array

		$for_month = "SELECT for_month from main WHERE id=$id"; // command
		$result = $conn->query($for_month); // runs the command
		$row_for_month = $result->fetch_assoc(); // put the result into assoc array

		$the_rest = $row_the_rest['the_rest'] - $row_for_month['for_month'];

		$sql = "UPDATE main SET the_rest='$the_rest' WHERE id=$id";
		if ($conn->query($sql) === TRUE) {
			echo "UPDATED <br>";
		} else {
			echo "error in update";
		}

		// dates table inserting

		$name = "SELECT name from main WHERE id=$id"; // command
		$result = $conn->query($name); // runs the command
		$row_name = $result->fetch_assoc(); // put the result into assoc array	

		$dat = date("d/m/Y") . "  -  " . date("s:i:ha");
		$sql = "INSERT INTO $row_name[name] (datee,the_rest) VALUES ('$dat','$the_rest')";

		if ($conn->query($sql) === TRUE) {
			echo "date added <br>";
		} else {
			echo "error in add date" . $conn->error;
		}
	}
	$conn->close();
	?>
	<section style="float: left;"><a href="index.php" target="_self">
			<h2>الي الصفحة الرئيسية >>>>>>>></h2>
		</a></section>
</body>

</html>