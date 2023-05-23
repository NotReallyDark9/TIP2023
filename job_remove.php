<?php 
session_start();
$member_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
// Check if the user is logged in and is a 'PStaff'
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
			<div class="sort">
				<form id="search-form" method="get">
				<input type="text" id="search-term" name="search-term" placeholder="Search">
				<input
				 type="submit" value="Search">
				<?php $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';?>
				</form>
				</div>
				<h3>Remove Job</h3>
				<?php
				if (isset($_SESSION['status']) && $_SESSION['status'] == 'PStaff') {
					echo '<th><a href="job_add.php" class="btn btn-primary">Add Job</a></th>';
					echo '<th><a href="job_remove.php" class="btn btn-primary">Remove Job</a></th>';
				}
				?>
				<table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
				  	<th >Job ID</th>
                    <th >Name</th>
                    <th >Job Type</th>
                    <th >Location</th>
					<th >Area</th>
                    <th >Salary</th>
                    <th >Detail</th>
                    <th>Bookmark/<br>Save</th>
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
			
				$sql = "SELECT jobID, name, job_type, location, area, salary 
				FROM jobs
				WHERE name LIKE '%$search%' OR job_type LIKE '%$search%' OR area LIKE '%$search%'
				ORDER BY name";

				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						// Display job info
					}
				} else {
					echo "No jobs found";
				}
				// Sorting options
				$sql = "SELECT jobID, name, job_type, location, area, salary 
				FROM jobs
				WHERE name LIKE '%$search%' OR job_type LIKE '%$search%' OR area LIKE '%$search%'
				";

				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo '<tr>';
						echo '<td name=>' . $row['jobID'] . '</td>';
						echo '<td>' . $row['name'] . '</td>';
						echo '<td>' . $row['job_type'] . '</td>';
						echo '<td>' . $row['location'] . '</td>';
						echo '<td>' . $row['area'] . '</td>';
						echo '<td>$AU' . $row['salary'] . '</td>';
						echo '<td><a href="job_detail.php?jobID=' . $row['jobID'] . '" class="btn btn-primary">See Details</a></td>';
						echo '<td><button id="delete-job-' . $row['jobID'] . '" class="btn btn-danger delete-job" data-job-id="' . $row['jobID'] . '">Delete</button></td>';
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
$(document).ready(function() {
   $('#jobs').change(function() {
      location.href = $(this).val();
   });

   $('.delete-job').click(function() {
      var buttonId = $(this).attr('id');
      var jobId = $(this).data('job-id');

      $.ajax({
         type: 'POST',
         url: 'delete_job.php',
         data: {jobID: jobId},
         success: function(data) {
            alert(data);
            $('#' + buttonId).parent().parent().remove();
         },
         error: function(data) {
            alert('An error occurred.');
         }
      });
   });
});
</script>
</body>
</html>