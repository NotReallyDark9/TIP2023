<?php 
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['status']) || $_SESSION['status'] != 'PStaff') {
    header('Location: login-index.php'); // redirect to login page if not authorized
    exit();
}
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
	<div class="row">
		<div class="col-12">
			<div class="bg-white shadow block">
			<?php
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$name = trim(htmlspecialchars(stripslashes($_POST['name'])));
				$job_type = trim(htmlspecialchars(stripslashes($_POST['job_type'])));
				$location = trim(htmlspecialchars(stripslashes($_POST['location'])));
				$area = trim(htmlspecialchars(stripslashes($_POST['area'])));
				$salary = trim(htmlspecialchars(stripslashes($_POST['salary'])));
				$job_des = trim(htmlspecialchars(stripslashes($_POST['job_des'])));
				$job_req = trim(htmlspecialchars(stripslashes($_POST['job_req'])));

				// Check if any field is empty
				if (empty($name) || empty($job_type) || empty($location) || empty($area) || empty($salary) || empty($job_des) || empty($job_req)) {
					echo "Please fill in all the fields.";
					exit();
				}
				
				$mysqli = new mysqli($host, $user, $pwd, $sql_db);
				if ($mysqli->connect_error) {
					die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
				}
				
				$stmt = $mysqli->prepare("INSERT INTO jobs (name, job_type, location, area, salary, job_des, job_req) VALUES (?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("sssssss", $name, $job_type, $location, $area, $salary, $job_des, $job_req);
				
				if ($stmt->execute()) {
					echo "Add job successfully. Redirecting to Job Page in seconds";
					header("refresh:5;url=jobs.php");
					exit();
				} else {
					echo "Error: " . $stmt->error;
				}
				
				$stmt->close();
				$mysqli->close();
				}	
				?>
				<h3>Add Job</h3>
				<form method="post" action="job_add.php">
					<table class="table table-bordered">
					<tr> <td>
					<label><strong>Job Title *</strong></label><br />
					<input name="name" type="text" class="form-control" required/>
					</td> <td>
					<label><strong>Job Type *</strong></label><br />
					<select name="job_type" class="form-control" required>
					<option value="">Select</option>
					<option value="Casual">Casual</option>
					<option value="Part-Time">Part-Time</option>
					</select>
					</td> </tr> <tr> <td colspan="2">
					<label ><strong>Location *</strong></label><br />
					<input name="location" type="text" class="form-control" required/>
					<label><strong>Area *</strong></label><br />
					<select name="area" class="form-control" required>
					<option value="">Select</option>
					<option value="Business">Business</option>
					<option value="Design">Design</option>
					<option value="Education">Education</option>
					<option value="Engineering">Engineering</option>
					<option value="Health">Health</option>
					<option value="Information Technology">Information Technology</option>
					<option value="Law">Law</option>
					<option value="Media and Communication">Media and Communication</option>
					<option value="Nursing">Nursing</option>
					<option value="Psychology">Psychology</option>
					<option value="Science">Science</option>
					</select>
					<label ><strong>Salary *</strong></label><br />
					<input name="salary" type="text" class="form-control" required/>
					<label ><strong>Job Description *</strong></label><br />
					<textarea name="job_des" class="form-control" id="job_des" rows="5" required></textarea>
					<label ><strong>Job Requirements *</strong></label><br />
					<textarea name="job_req" class="form-control" id="job_req" rows="5" required></textarea>
					</td> </tr> 
					</table>
					<div style="text-align:right"><button type="submit" class="btn btn-primary">Submit Job</button></div>
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