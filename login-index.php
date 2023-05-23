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
// Create table if not exists
$sql = "CREATE TABLE if not exists users ( 
	memberID INT AUTO_INCREMENT PRIMARY KEY, 
	firstname VARCHAR(50), 
	lastname VARCHAR(50), 
	phone VARCHAR(20), 
	email VARCHAR(100) UNIQUE, 
	password VARCHAR(255),
	password_main VARCHAR(255) NOT NULL,
	status ENUM('Waiting','Staff','PStaff') DEFAULT 'Waiting' );";

if ($conn->query($sql) === FALSE) {
        echo "Error creating table: " . $conn->error;
}
?>    
</header>
<section class="body-section">
<div class="container">
	<div class="row login_signup_forms justify-content-center">
		<div class="col-sm-6">
		<div class="bg-white shadow block">
		<?php
            if (isset($_POST['login'])) {
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $password = $_POST['password'];

                $query = "SELECT * FROM users WHERE email='$email'";
                $result = mysqli_query($conn, $query);
                
                if (mysqli_num_rows($result) > 0) {
                    $user = mysqli_fetch_assoc($result);
                    $hashed_password = $user['password'];

                    if (password_verify($password, $hashed_password)) {
                        echo 'Successfully logged in. Redirecting to Main Page in seconds...';
                        //Store necessary user data
                        session_start();
                        $_SESSION['user_id'] = $user['memberID'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['firstname'] =$user['firstname'];
						$_SESSION['status'] =$user['status'];
                        header("refresh:5;url=index.php");
                        exit;
                    } else {
                        echo 'Invalid passwordor email.';
                    }
                } else {
                    echo 'Invalid password or email.';
                }
            }
            ?>

			<h4>Existing Member's Login</h4>
			<hr />
			
			<form class="basic-form form-signin" method="post" action="login-index.php">
			<div class="form-group">
				<label>Email Address</label>
				<input class="form-control" type="text" name="email" placeholder=""/>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input class="form-control" type="password" name="password" placeholder=""/>
			</div>
			<div class="btn-bar">
				<p class="new-user-link">New User? <a href="signup.php" class="text-primary">Sign up now</a></p>
				<button type="submit" class="btn btn-signin btn-primary" name="login">Sign in</button>
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