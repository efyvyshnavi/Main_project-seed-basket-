<?php
date_default_timezone_set('Asia/Kolkata');
$current_time2 = date('Y-m-d H:i:s');
// Establish a connection to the database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Retrieve the entered OTP
    $otp = $_POST['otp'];

    $sql = "SELECT * FROM tbl_dbassign WHERE otp = '$otp'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Update the database with the delivered status
   $sql = "UPDATE tbl_dbassign SET deliver_status = 'delivered', delivered_time = DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s') WHERE otp = '$otp'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Delivery status updated to delivered');</script>";
    } else {
        echo "<script>alert('Error updating delivery status: " . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('OTP does not match');</script>";
}
        }

		$conn->close();
	?>
<!DOCTYPE html>
<head>
	<title>OTP Verification</title>
    <style>
       body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}
		
		.container {
			max-width: 600px;
			margin: 0 auto;
			padding: 20px;
			text-align: center;
		}
		
		h1 {
			margin-top: 0;
			font-size: 36px;
			font-weight: normal;
		}
		
		form {
			max-width: 400px;
			margin: 0 auto;
			text-align: center;
			position: absolute;
			top: 350px;
            right:620px;
			transform: translateY(-50%);
		}
		
		label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
			text-align: left;
		}
		
		input[type="text"] {
			padding: 10px;
			font-size: 16px;
			border: 1px solid #ccc;
			border-radius: 5px;
			width: 100%;
			box-sizing: border-box;
			margin-bottom: 10px; /* add margin between input and button */
		}
		
		button[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			width: 100%;
			font-size: 16px;
		}
		
		button[type="submit"]:hover {
			background-color: #3e8e41;
		}
		
		table {
			border-collapse: collapse;
			width: 100%;
		}
		
		th, td {
			padding: 8px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
		
		th {
			background-color: #4CAF50;
			color: #fff;
		}
		
		.footer {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px;
			text-align: center;
			position: fixed;
			left: 0;
			bottom: 0;
			width: 100%;
		}
		
		.footer p {
			margin: 0;
			font-size: 14px;
		}
        .header {
	background-color: #4CAF50;
	color: #fff;
	padding: 10px;
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	z-index: 1;
	display: flex;
	justify-content: space-between;
	align-items: center;
}

.logo a {
	color: #fff;
	text-decoration: none;
	font-size: 24px;
	font-weight: bold;
}

.navbar ul {
	list-style: none;
	margin: 0;
	padding: 0;
	display: flex;
}

.navbar li {
	margin-left: 20px;
}

.navbar li a {
	color: #fff;
	text-decoration: none;
	font-size: 16px;
	font-weight: bold;
}

.navbar li a:hover {
	text-decoration: underline;
}
</style
</head>

<body>
	<h1 style="position:absolute;top:180px;right:630px;">OTP Verification</h1>
	<form method="POST"action="otp2.php"enctype="multipart/form-data">
		<label for="otp" style="text-align:center">Enter OTP:</label>
		<input type="text" id="otp" name="otp" required>
		<button type="submit" name="submit">Verify</button>
	</form>

	
    </main>
<footer class="footer">
	<p>&copy; 2023 OTP Verification</p>
</footer>
</body>
</html>
