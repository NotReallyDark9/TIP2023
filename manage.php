<?php 
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['status']) || $_SESSION['status'] != 'PStaff') {
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
</header>
<section class="body-section">
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="bg-white shadow block">
			<div class="sort">
				<form id="search-form" method="get">
				<input type="text" id="search-term" name="search-term" placeholder="Search">
				<input
				 type="submit" value="Search">
				<?php $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';?>
				</form>
				</div>
				<h3>Manage Applicants</h3>
				<table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
				  	<th >Job ID</th>
                    <th >Job Title</th>
                    <th >First Name</th>
                    <th >Last Name</th>
                    <th >Email</th>
					<th >Website</th>
                    <th >Start Date</th>
                    <th >Phone</th>
                    <th>RCQ</th>
                    <th>Resume</th>
					<th>Job Status</th>
					<th>Change Job Status</th>
                    <th>Status</th>
					<th>Change Status</th>
                  </tr>
                </thead>
                <tbody>
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

				// Update user status
				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_status'])) {
					$new_status = mysqli_real_escape_string($conn, $_POST['choose_status']);
					$memberID = mysqli_real_escape_string($conn, $_POST['memberID']);
					
					$stmt = $conn->prepare("UPDATE users SET status = ? WHERE memberID = ?");
					$stmt->bind_param("si", $new_status, $memberID);
				
					if ($stmt->execute()) {
						echo "Status updated successfully";
					} else {
						echo "Error updating status: " . $stmt->error;
					}
				}
				// Update job status
				if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_job_status'])) {
					$new_job_status = mysqli_real_escape_string($conn, $_POST['choose_job_status']);
					$applyID = mysqli_real_escape_string($conn, $_POST['applyID']);

					$stmt = $conn->prepare("UPDATE apply SET job_status = ? WHERE applyID = ?");
					$stmt->bind_param("si", $new_job_status, $applyID);

					if ($stmt->execute()) {
						echo "Job status updated successfully";
					} else {
						echo "Error updating job status: " . $stmt->error;
					}
				}			
				$sql = "SELECT apply.applyID, jobs.jobID, jobs.name, apply.fn, apply.ln, users.email, apply.web, apply.start_date, apply.phone, apply.rcq, apply.resume, apply.job_status, users.status, users.memberID
				FROM jobs 
				JOIN apply ON jobs.jobID = apply.jobID
				JOIN users ON apply.memberID = users.memberID
				WHERE (jobs.jobID LIKE '%$search%' OR jobs.name LIKE '%$search%' OR apply.fn LIKE '%$search%' OR apply.ln LIKE '%$search%' OR users.email LIKE '%$search%' OR apply.job_status LIKE '%$search%'OR users.status LIKE '%$search%')
				AND (users.status = 'Waiting' OR users.status = 'Staff')
				ORDER BY jobs.name";                   
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					// Fetch rows from result set
					while($row = $result->fetch_assoc()) {
						echo '<tr>';
						echo '<td>' . $row['jobID'] . '</td>';
						echo '<td>' . $row['name'] . '</td>';
						echo '<td>' . $row['fn'] . '</td>';
						echo '<td>' . $row['ln'] . '</td>';
						echo '<td>' . $row['email'] . '</td>';
						echo '<td>' . $row['web'] . '</td>';
						echo '<td>' . $row['start_date'] . '</td>';
						echo '<td>' . $row['phone'] . '</td>';
						echo '<td>' . $row['rcq'] . '</td>';
						echo '<td>' . $row['resume'] . '</td>';
						echo '<td>' . $row['job_status'] . '</td>';
						echo "<td><form id='change_job_status' method='post' action='", $_SERVER['PHP_SELF'], "'>
						<p><label for='choose_job_status", $row["applyID"], "'>Changing Job status</label>
							<select name='choose_job_status' id='choose_job_status", $row["applyID"], "'>
								<option value=''>Please Select</option>
								<option value='Rejected'>Rejected</option>
								<option value='Waiting'>Waiting</option>
								<option value='Accepted'>Accepted</option>
							</select>
							<input type='hidden' name='applyID' value='", $row["applyID"], "' />
							<input type='submit' name='change_job_status' value='Change Job Status'>
						</p></form></td>\n ";	
						echo '<td>' . $row['status'] . '</td>';				
						echo "<td><form id='change_status' method='post' action='", $_SERVER['PHP_SELF'], "'>
						<p><label for='choose_status", $row["memberID"], "'>Changing status</label>
							<select name='choose_status' id='choose_status", $row["memberID"], "'>
								<option value=''>Please Select</option>
								<option value='Waiting'>Waiting</option>
								<option value='Staff'>Staff</option>
							</select>
							<input type='hidden' name='status' value='", $row["status"], "' />
							<input type='hidden' name='memberID' value='", $row["memberID"], "' />
							<input type='submit' name='change_status' value='Change Status'>
						</p></form></td>\n ";
						echo "</tr>\n ";
					}
				} else {
					echo "No jobs found";
				}
				$conn->close();
				?>
               </tbody>
              </table>
			</div>			
		</div>
	</div>
</div>	
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/fontawesome.min.js"></script>

<script>
$(document).ready( function() {
   $('#jobs').change( function() {
      location.href = $(this).val();
   });
});
</script>
</body>
</html>