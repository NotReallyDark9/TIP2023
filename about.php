<?php 
session_start();
$_SESSION['prev_page'] = $_SERVER['REQUEST_URI'];
?>
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
</header>
<section class="body-section">
<div class="container">
<div class="bg-white shadow block">
	<div class="row">
		<div class="col-12">
		
			<div class="row">
				<div class="col-6">
					<h4><img src="images/technology.jpg" alt="Technology" class="img-fluid" /></h4>
				</div>
				<div class="col-6">
				<div class="welcome-text">
					<h2>Welcome Sam,</h2>
					<p>CorpU is a recently accredited university. Like most universities, they hire a large quantity of casual (a.k.a., “sessional”) staff to run classes, labs, and workshops each semester. These sessional staff are managed by permanent or long-term contract staff, who are responsible for finding, training, and scheduling qualified sessionals for the units (i.e., subjects) they run. Each sessional staff member can be engaged by one or multiple units, depending on their availability and expertise. Within each unit, up to 20 unique sessionals might be involved depending on the number of students enrolled.</p>
				</div></div>
			</div>
			</div>			
		</div>
	</div>
</div>
<div class="container">
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/fontawesome.min.js"></script>
</body>
</html>