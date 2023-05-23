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
?>    
</header>
<section class="body-section">
<div class="container">
	<div class="row login_signup_forms justify-content-center">
		<div class="col-sm-6">
		<div class="bg-white shadow block">
			<h4>Logged out</h4>
            <hr>
            <?php
            session_start();  // start the session
            
            // Save the previous page into a variable before the session gets destroyed
            $prev_page = $_SESSION['prev_page'] ?? 'index.php';
            
            // Unset all of the session variables.
            $_SESSION = array();
            
            // If it's desired to kill the session, also delete the session cookie.
            //This will destroy the session,not just the session data!
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            
            // Destroy the session.
            session_destroy();
            
            // After logout, redirect user to the previously visited page
            header('Location: '.$prev_page);
            exit;
            ?>
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