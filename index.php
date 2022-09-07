<?php
if (isset($_GET["sub"])) {
	echo "
	<script>
	location.assign('index.php');
	</script>
	";
}
?>
<!DOCTYPE html>
<html dir="rtl">

<head>
	<meta charset="utf-8">
	<title>Shop</title>
	<!-- Note This DOWN -->
	<!-- <meta http-equiv="refresh" content="<?php echo $tim; ?>;http://localhost/www/Shop/"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Pejoal Nagy">
	<style type="text/css">
		table {
			max-width: 100%;
			overflow-x: auto;
			border-collapse: collapse;

		}

		input {
			padding: .5rem;
			font-size: 1.1rem;
		}

		td {
			padding: .3em;
			border: 1px double grey;
			width: 300px;
			text-align: center;
			font-weight: bold;
		}

		th {
			padding: .3rem;
			border: 1px solid grey;
		}

		.do {
			width: 80px;
			font-size: 18px;
			font-weight: bolder;
		}

		.btn {
			padding: 10px;
			font-size: 15px;
			color: white;
			background: #5F9EA0;
			border: none;
			border-radius: 5px;
		}

		.btn:hover {
			background-color: #4e8ca0;
		}

		.del_btn {
			text-decoration: none;
			padding: 2px 5px;
			color: white;
			border-radius: 3px;
			background: #FF1A1A;
		}

		.del_btn:hover {
			background-color: #FF3333;
		}
	</style>
</head>

<body style="background-color: #fff;">
	<h1 style="text-align: center;border: 2px solid orange;border-radius: 20px;width: 300px;margin: 5px auto;padding: 5px;">الصفحة الرئيسية</h1>
	<form method="get" name="posted">
		<fieldset>
			<legend>معلومات البيع</legend>
			<table dir="rtl" style="width: 700px;">
				<tr>
					<td>اسم المشتري</td>
					<td><input type="text" name="name" placeholder="ادخل اسم المشتري هنا"></td>
				</tr>
				<tr>
					<td>اسم المنتج</td>
					<td><input type="text" name="product" placeholder="ادخل اسم المنتج هنا"></td>
				</tr>
				<tr>
					<td>الثمن الكلي</td>
					<td><input type="number" name="full_price" placeholder="ادخل الثمن الكلي هنا"></td>
				</tr>
				<tr>
					<td>تاريخ البيع</td>
					<td><input type="datetime-local" name="date"></td>
				</tr>
				<tr>
					<td>المقدم</td>
					<td><input type="number" name="done" placeholder="ادخل المقدم هنا"></td>
				</tr>
				<tr>
					<td>فلوس الشهر</td>
					<td><input type="number" name="for_month" placeholder="ادخل فلوس الشهر هنا"></td>
				</tr>
				<tr>
					<td><input class="do btn" type="submit" value="تم" name="sub"></td>
					<td><input class="do del_btn" type="reset" value="الغاء"></td>
				</tr>
			</table>
		</fieldset>
	</form>
	<?php
	if (isset($_GET["sub"])) {
		$name = $_GET['name'];
		$name = str_ireplace(" ", "_", $name);
		$product = $_GET['product'];
		$product = str_ireplace(" ", "_", $product);
		$full_price = $_GET['full_price'];
		$date = $_GET['date'];
		$done = $_GET['done'];
		$for_month = $_GET['for_month'];
		$the_rest = $_GET['full_price'] - $_GET['done'];

		// create connection
		$con = new mysqli("localhost", "id19400222_root", "Pd9SSL3guSntsai-", "id19400222_login_system");
		if ($con->connect_error) {
			die("Error in connection" . $con->connect_error);
		} else {
			echo "Connected <br>";
		}
		$sql = "INSERT INTO main (name,product,full_price,datee,done,for_month,the_rest) VALUES ('$name','$product','$full_price','$date','$done','$for_month','$the_rest')";
		if ($con->query($sql) === TRUE) {
			$insert_id = $con->insert_id;
			echo "Inserted Successfully - the last id is :" . $insert_id . "<br>";
		} else {
			echo "Error" . $sql . "<br>" . $con->error;
		}
		$sql = "CREATE TABLE $name (
		name VARCHAR(50) NOT NULL DEFAULT '$name',
		the_rest VARCHAR(25) NOT NULL,
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
-- datee TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
		datee VARCHAR(50) NOT NULL
		)";
		if ($con->query($sql) === TRUE) {
			echo "Table created: " . $name . "  id:" . $insert_id;
		} else {
			echo "error in creating dates table" . $con->error;
		}
		$con->close();
	}
	?>
	<a href="table.php" target="_self">
		<h2>
			<<<<<<<<< الي قاعدة بيانات المشترين </h2>
	</a>
</body>

</html>