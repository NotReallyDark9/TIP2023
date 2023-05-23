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
					<h4><img src="images/collehae-students.jpg" alt="Technology" class="img-fluid" /></h4>
				</div>
				<div class="col-6">
				<div class="welcome-text">
					<h2>Welcome to CorpU</h2>
					<p>CorpU are one of Australia's premier independent co-educational schools, educating students from ELC3 to Year 12. For over 100 years we have provided young people with outstanding educational experiences in an environment that nurtures and develops the whole person – head, heart and soul. Our students excel academically and enjoy access to first-class facilities and an outstanding array of cocurricular experiences.</p>
				</div></div>
			</div>
			</div>			
		</div>
	</div>
</div>
<div class="container">
<div class="bg-white shadow block">
	<div class="row">
		<div class="col-12">
			<div class="row">
				<div class="col-6">
					<h4><img src="images/hiring.jpg" alt="Hiring" class="img-fluid" /></h4>
				</div>
				<div class="col-6">
				<div class="welcome-text">
					<h2>Career</h2>
					<p>Join our vibrant academic community at CorpU! We're seeking a dedicated University Tutor to provide personalized academic support, helping students navigate complex course materials. If you have a passion for education, strong communication skills, we invite you to apply. Foster student success and contribute to an enriching learning environment at CorpU. Apply to embark on a rewarding educational journey.</p>
					<td><a href="jobs.php" class="btn btn-primary">Go to Job Board</a></td>
				</div></div>
			</div>
			</div>			
		</div>
	</div>
</div>
<div class="container">
<div class="bg-white shadow block">
	<div class="row">
		<div class="col-12">
			<div class="row">
				<div class="col-6">
					<h4><img src="images/contact.jpg" alt="Contact Us" class="img-fluid" /></h4>
				</div>
				<div class="col-6">
				<div class="welcome-text">
					<h2>Contact Us</h2>
					<p>Looking for more information? We're here to help! Reach out to the CorpU team with any questions or concerns. Whether it's about admissions, academics, campus life, or just a general inquiry, we're always ready to assist. Don't hesitate to get in touch – your journey to academic excellence begins here at CorpU. Connect with us today!</p>
					<td><a href="support.php" class="btn btn-primary">Go to Contact Us</a></td>
				</div></div>
			</div>
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