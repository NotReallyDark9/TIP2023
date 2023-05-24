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
					<h2>Welcome</h2>
					<p>At CorpU, we pride ourselves on being a recently accredited university that provides high-quality education and innovative learning opportunities for our students. We employ a large team of dedicated and knowledgeable sessional staff members to run our classes, labs, and workshops each semester. These professionals bring diverse expertise and are managed by our committed permanent or long-term contract staff. Our mission is to ensure that we have qualified, well-trained sessional staff on hand for the various units we run. A sessional staff member can engage with one or multiple units, depending on their unique skills and availability. In each unit, up to 20 unique sessionals may be involved, depending on the number of students enrolled, ensuring individual attention and personalized support. We are proud to say that at CorpU, our staff is our strength.</p>
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