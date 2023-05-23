<?php 
session_start();
$member_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
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
				<h3>Submit Your Resume</h3>
				<?php
				$jobid = $_GET['jobID'];
				if (isset($_POST['submit'])) {
					$fn = $_POST['fn'];
					$ln = $_POST['ln'];
					$email = $_POST['email'];
					$website = $_POST['website'];
					$startdate = date('Y-m-d', strtotime($_POST['startdate']));
					$phone = $_POST['phone'];
					$rcq = $_POST['rcq'];

					// Assuming your file upload is handled correctly, you might want to implement your own error handling here.
					$resume = $_FILES['resume'];

					$stmt = $conn->prepare("INSERT INTO apply (jobID, memberID, fn, ln, web, start_date, phone, rcq, resume) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
					$stmt->bind_param("iissssssb", $jobid, $member_id, $fn, $ln, $website, $startdate, $phone, $rcq, $resume);
					
					if ($stmt->execute()) {
						echo "Your application has been submitted successfully. Redirecting in seconds...";
						header("refresh:5;url=jobs.php");
					} else {
						echo "There was an error submitting your application: " . $conn->error;
					}
				}
				?>
				 <form method="post" action="job_apply_check.php" enctype="multipart/form-data">
					<table class="table table-bordered">
					<tr> <td>
					<label><strong>First name *</strong></label><br />
					<input name="fn" type="text" class="form-control" />
					</td> <td>
					<label><strong>Last name *</strong></label><br />
					<input name="ln" type="text" class="form-control" />
					</td> </tr> <tr> <td colspan="2">
					<label ><strong>Email *</strong></label><br />
					<input name="email" type="text" class="form-control" />
					</td> </tr> <tr> <td colspan="2">
					<label><strong>Portfolio website</strong></label><br />
					<input name="website" type="text" class="form-control" />
					</td> </tr> <tr> <td colspan="2">
					</td> </tr> <tr><td>
					<label><strong>When can you start?</strong></label><br />
					<input name="startdate" type="date" class="form-control" />
					</td> </tr> 
					<tr> <td>
					<label><strong>Phone *</strong></label><br />
					<input name="phone" type="text" class="form-control" placeholder="+61 123 456 7890" />
					</td></tr> <tr>
					<tr> <td colspan="2">
					<label><strong>Reference / Comments / Questions</strong></label><br />
					<textarea name="rcq" rows="4" cols="40" class="form-control"></textarea>
					</td> </tr>
					<tr> <td colspan="2">
					<label><strong>Upload Your Resume</strong></label><br />
					<input id="resume" name="resume" value="<?php echo $jobid; ?>" style="max-width : 450px;" type="file" class="form-control">
					<input type="hidden" name="jobID" value="<?php echo $jobid; ?>" />
					</td> </tr>
					</table>
					<div style="text-align:right"><input type="submit" name="submit" class="btn btn-signin btn-primary" value="Submit Form" /></div>
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