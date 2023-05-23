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
				</div>
				<h3>Messages</h3>
				<table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
				  	<th >Name</th>
                    <th >Email</th>
					<th>Subject</th>
                    <th>Message</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				$conn = @mysqli_connect($host,
				$user,
				$pwd,
				$sql_db
				);
                $sql = "SELECT id, qname, email, subject, message FROM question";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["qname"]. "</td>";
                        echo "<td>" . $row["email"]. "</td>";
                        echo "<td>" . $row["subject"]. "</td>";
                        echo "<td>" . $row["message"]. "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
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