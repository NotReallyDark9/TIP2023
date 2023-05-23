<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Technology Enquiry Assignment">
<meta name="keywords" content="Technology Enquiry Assignment">
<meta name="author" content="Technology Enquiry Assignment">
<meta name="expires" content="never">
<meta name="rating" content="general">
<meta name="copyright" content="Technology Enquiry Assignment"> 
<title>Technology Enquiry Assignment</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<header>
<?php include 'header.inc'?>
<?php include 'settings.php'?>
<?php 
require_once ("settings.php");
$conn = @mysqli_connect($host,
    $user,
    $pwd,
    $sql_db
    );

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$confirmpassword = mysqli_real_escape_string($conn, $_POST['confirmpassword']);

	if ($password == $confirmpassword) {
		//hash the password
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		$query = "INSERT INTO users (firstname, lastname, phone, email, password, password_main) VALUES ('$firstname', '$lastname', '$phone', '$email', '$hashed_password','$password')";

		if (mysqli_query($conn, $query)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($conn);
		}
	} else {
		echo "Password and confirm password does not match.";
	}
}
mysqli_close($conn);?>
</header>
<section class="body-section">
<div class="container">
	<div class="row login_signup_forms justify-content-center">
		<div class="col-sm-6">
		<div class="bg-white shadow block">
		<h4>New User Registration</h4>
		<hr />
			<form class="basic-form form-signup" method="post" name="form" action="signup_confirm.php">
				<div class="form-group">
					<label>First name</label>
					<input class="form-control" type="text" name="firstname" placeholder=""/>
				</div>
				<div class="form-group">
					<label>Last name</label>
					<input class="form-control" type="text" name="lastname" placeholder=""/>
				</div>
				<div class="form-group">
					<label>Phone</label>
					<input class="form-control" type="text" name="phone" placeholder=""/>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input class="form-control" type="text" name="email" placeholder=""/>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input class="form-control" type="password" name="password" placeholder=""/>
				</div>
				<div class="form-group">
					<label>Confirm password</label>
					<input class="form-control" type="password" name="confirmpassword" placeholder=""/>
				</div>
				<div class="btn-bar">
					<button type="submit" class="btn btn-signup btn-primary">Sign Up</button>
				</div>
			</form>
		</div>
		</div>
	</div>
</div>	
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/fontawesome.min.js"></script>
</body>
</html>