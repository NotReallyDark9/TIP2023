<?php 
session_start();
$member_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
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
	<div class="row">
		<div class="col-12">
			<div class="bg-white shadow block">
			<div class="sort">Sort by <select name="sort" id="sort">
				<option value="#">Select </option>
						<option value="name_asc">A to Z</option>
						<option value="name_desc">Z to A</option>
					</select>
				<form id="search-form" method="get">
				<input type="text" id="search-term" name="search-term" placeholder="Search">
				<input
				 type="submit" value="Search">
				<?php $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';?>
				</form>
				</div>
				<h3>Job Listing</h3>
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
			
				// Get sort method from POST data
				$sortMethod = $_GET['sort'] ?? 'name_asc';

				// Prepare SQL sort clause
				$sortSql = '';
				switch ($sortMethod) {
				case 'name_asc':
					$sortSql = 'ORDER BY name ASC';
					break;
				case 'name_desc':
					$sortSql = 'ORDER BY name DESC';
					break;
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
				$sql = "SELECT jobID, name, job_type, location, area, salary FROM jobs $sortSql";

				function checkIfJobIsBookmarked($job_id, $member_id) {
					global $conn;
					$sql = "SELECT COUNT(*) as count FROM favorite WHERE memberID = ? AND jobID = ?";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param('ii', $member_id, $job_id);
					$stmt->execute();
					$result = $stmt->get_result();
					$row = $result->fetch_assoc();
					return $row['count'] > 0;
				}
				$sql = "SELECT jobID, name, job_type, location, area, salary 
				FROM jobs
				WHERE name LIKE '%$search%' OR job_type LIKE '%$search%' OR area LIKE '%$search%'
				$sortSql";

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
						$isBookmarked = checkIfJobIsBookmarked($row['jobID'], $member_id);
						$bookmarkClass = $isBookmarked ? 'bookmarked' : '';
						echo '<td><button data-job-id="'.$row['jobID'].'" onclick="bookmarkJob(this)" class="btn btn-dark '.$bookmarkClass.'">'.($isBookmarked ? '★' : '☆').'</button></td>';
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

function bookmarkJob(element) {
    var jobId = element.dataset.jobId;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'bookmark_job.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('jobId=' + jobId + '&memberId=' + '<?php echo $member_id; ?>');

    // Handle response
    xhr.onload = function() {
        if (xhr.status == 200) {
            // Toggle the button's text
            if (element.innerHTML === '☆') {
                element.innerHTML = '★';
            } else {
                element.innerHTML = '☆';
            }
            // Toggle 'bookmarked' class
            element.classList.toggle('bookmarked');
        } else {
            console.error('Request failed.  Returned status of ' + xhr.status);
        }
    }
}

$(document).ready(function() {
  $('#sort').change(function() {
    var sortMethod = $(this).val();
    location.href = window.location.pathname + '?sort=' + sortMethod;
  });

  // Search form submission
  $('#search-form').on('submit', function(e) {
    e.preventDefault();
    var searchTerm = $('#search-term').val();
    location.href = window.location.pathname + '?search=' + searchTerm;
  });
});
</script>
</body>
</html>