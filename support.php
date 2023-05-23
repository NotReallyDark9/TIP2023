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
		<?php include 'header.inc' ?>
		<?php include 'settings.php' ?>
	</header>
	<section class="body-section">
		<div class="container">
			<div class="bg-white shadow block">
				<div class="row no-gutters">
					<div class="col-md-7 d-flex align-items-stretch">
						<div class="contact-wrap">
							<h3 class="mb-4">Get in touch</h3>
							<?php
							$conn = @mysqli_connect(
								$host,
								$user,
								$pwd,
								$sql_db
							);

							// Check connection
							if ($conn->connect_error) {
								die("Connection failed: " . $conn->connect_error);
							} 
							?>
							<?php
							if ($_SERVER["REQUEST_METHOD"] == "POST") {
								// Check if all fields are filled
								if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
									echo "All fields are required!";
								} else {
									$qname = trim(htmlspecialchars($_POST['name']));
									$email = trim(htmlspecialchars($_POST['email']));
									$subject = trim(htmlspecialchars($_POST['subject']));
									$message = trim(htmlspecialchars($_POST['message']));

									if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
										echo "Invalid email format!";
									} else {
										$sql = "INSERT INTO question (qname, email, subject, message) VALUES (?, ?, ?, ?)";
										$stmt = $conn->prepare($sql);
										$stmt->bind_param("ssss", $qname, $email, $subject, $message);

										if ($stmt->execute()) {
											echo "Successfully Send!";
										} else {
											echo "Error: " . $sql . "<br>" . $conn->error;
										}

										$stmt->close();
										$conn->close();
									}
								}
							}
							?>
							<form method="POST" class="basic-form" name="contactForm" novalidate="">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" name="name" id="name" placeholder="Name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="email" class="form-control" name="email" id="email" placeholder="Email">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea name="message" class="form-control" id="message" cols="30" rows="7" placeholder="Message"></textarea>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="submit" value="Send Message" class="btn btn-primary">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-md-5 d-flex align-items-stretch">
						<div class="info-wrap bg-primary">
							<table valign="middle" class="contact-info">
								<tr>
									<td>
										<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-map-marker"></span></div>
									</td>
									<td>
										<p>35 Wakefield St, Hawthorn VIC 3122</p>
									</td>
								</tr>
								<tr>
									<td>
										<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-phone"></span></div>
									</td>
									<td>
										<p><span>Phone:</span> <a href="tel:123">+61 123 456 7890</a></p>
									</td>
								</tr>
								<tr>
									<td>
										<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-paper-plane"></span></div>
									</td>
									<td>
										<p><span>Email:</span> <a href="mailto:info@yoursite.com">info@corpu.com</a></p>
									</td>
								</tr>
								<tr>
									<td>
										<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-globe"></span></div>
									</td>
									<td>
										<p><span>Website</span> <a href="#">corpu.com</a></p>
									</td>
								</tr>
							</table>
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