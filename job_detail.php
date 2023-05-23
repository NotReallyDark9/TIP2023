<?php 
session_start();
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login-index.php');
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
<?php 
$conn = @mysqli_connect($host,
$user,
$pwd,
$sql_db
);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$jobID = isset($_GET['jobID']) ? $_GET['jobID'] : '';
// Prepare the SQL statement
$stmt = $conn->prepare("SELECT * FROM jobs WHERE jobID = ?");
$stmt->bind_param('i', $jobID); // 'i' specifies the variable type => 'integer'

// execute the prepared statement
$stmt->execute();

$result = $stmt->get_result();

// check if record is found
if ($result->num_rows > 0) {
	$job = $result->fetch_assoc();
	// now you can use the $job associative array to display the job details
} else {
	// Redirect to jobs listing or show error message
	die("No job found with the provided ID");
}
?>
</header>
<section class="body-section">
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="bg-white shadow block">
                <h3>Job Details</h3>
                <p><strong>Job ID:</strong><br><?php echo $job['jobID']; ?></p>
                <p><strong>Job Name:</strong><br><?php echo $job['name']; ?></p>
                <p><strong>Job Type:</strong><br><?php echo $job['job_type']; ?></p>
                <p><strong>Location:</strong><br><?php echo $job['location']; ?></p>
                <p><strong>Area:</strong><br><?php echo $job['area']; ?></p>
                <p><strong>Salary:</strong><br><?php echo $job['salary']; ?></p>
                <h4>Job Description:</h4><?php echo nl2br($job['job_des']); ?>
                <h4>Job Requirement:</h4><?php echo nl2br($job['job_req']); ?>
				<div style="text-align:right"><a href="job_apply.php?jobID=<?php echo $job['jobID']; ?>" class="btn btn-signin btn-primary">Apply This Job</a></div>
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