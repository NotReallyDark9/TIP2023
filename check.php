<?php 
session_start();
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
</header>
<section class="body-section">
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="bg-white shadow block">
			<div class="sort">
				</div>
				<h3>Job Status</h3>
				<table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
				  	<th >Job ID</th>
                    <th >Job Title</th>
					<th>Job Status</th>
                    <th>Remove Application</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				$conn = @mysqli_connect($host,
				$user,
				$pwd,
				$sql_db
				);
                $userId = $_SESSION['user_id'];

                // Prepare the SQL query
                $sql = "SELECT apply.applyID, jobs.jobID, jobs.name AS jobTitle, apply.job_status 
                FROM apply 
                INNER JOIN jobs ON apply.jobID=jobs.jobID
                WHERE apply.memberID = ?";
                
                // Create a prepared statement
                $stmt = $conn->prepare($sql);
                
                // Bind parameters
                $stmt->bind_param('i', $userId);
                
                // Execute the statement
                $stmt->execute();
                
                // Get the result
                $result = $stmt->get_result();
                
                // Fetch the data and output it
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['jobID']}</td>
                        <td>{$row['jobTitle']}</td>
                        <td>{$row['job_status']}</td>
                        <td>
                            <form method='post' action='{$_SERVER['PHP_SELF']}'>
                                <input type='hidden' name='removeID' value='{$row["applyID"]}' />
                                <input type='submit' name='remove' value='Remove'>
                            </form>
                        </td>
                    </tr>";
                    // Remove Job
                    // Check if a remove request was submitted
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
                    $removeId = $_POST['removeID'];

                    // Prepare the SQL query
                    $sql = "DELETE FROM apply WHERE applyID = ? AND memberID = ?";

                    // Create a prepared statement
                    $stmt = $conn->prepare($sql);

                    // Bind parameters
                    $stmt->bind_param('ii', $removeId, $userId);

                    // Execute the query
                    $stmt->execute();

                    if($stmt->affected_rows > 0) {
                        echo "Job application has been successfully removed!";
                    } else {
                        echo "Error occurred while removing job application.";
                    }
                }
                }
                $stmt->close();
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