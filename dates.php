<!DOCTYPE html>
<html dir="rtl">

<head>
	<meta charset="utf-8">
	<title></title>
	<style type="text/css">
		table {
			max-width: 100%;
			overflow-x: auto;
			border-collapse: collapse;
		}
		th {
			border: 1px double black;
			padding: .5rem;

		}

		td {
			border: 1px solid black;
			padding: .5rem;

		}
	</style>
</head>

<body>
	<?php
	if (isset($_POST['go'])) {
		$id = $_POST['go'];
		$con = new mysqli("localhost", "id19400222_root", "Pd9SSL3guSntsai-", "id19400222_login_system");

		$sql = "SELECT name FROM main WHERE id=$id";
		$result = $con->query($sql);
		$row_name = $result->fetch_assoc();

		$sql = "SELECT name, datee, the_rest FROM $row_name[name]";
		$result = $con->query($sql);

		if ($result->num_rows > 0) {
			echo "			<table style='width: 800px;border: 2px solid red;'>
				<tr>
					<th>اسم المشتري</th><th>تاريخ دفع القسط</th><th>الباقي</th>
				</tr>";
			// output data of each row
			while ($row = $result->fetch_assoc()) {
				echo "<tr>" . "<td>" . $row['name'] . "</td>" . "<td>" . $row['datee'] . "</td>" . "<td>" . $row['the_rest'] . "</td>" . "</tr>";
			}
			echo "</table>";
		} else {
			echo "0 results";
		}
	}
	?>
	<div>
		<section style="float: left;"><a href="table.php" target="_self">
				<h2> الي قاعدة بيانات المشترين >>>>>>>></h2>
			</a></section>
		<section style="float: right;"><a href="index.php" target="_self">
				<h2>
					<<<<<<<< الي الصفحة الرئيسية</h2>
			</a></section>
	</div>
</body>

</html>