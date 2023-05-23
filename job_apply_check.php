<?php 
session_start();
$member_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$jobid = $_POST['jobID'];
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
				$jobid = $_POST['jobID'];
				if (isset($_POST['submit'])) {
                    $fn = trim(htmlspecialchars(stripslashes($_POST['fn'])));
                    $ln = trim(htmlspecialchars(stripslashes($_POST['ln'])));
                    $email = trim(htmlspecialchars(stripslashes($_POST['email'])));
                    $website = trim(htmlspecialchars(stripslashes($_POST['website'])));
                    $startdate = trim(htmlspecialchars(stripslashes($_POST['startdate'])));
                    $phone = trim(htmlspecialchars(stripslashes($_POST['phone'])));
                    $rcq = trim(htmlspecialchars(stripslashes($_POST['rcq'])));
                
                    // Check if any field is empty and echo error message
                    if (empty($fn)) {
                        echo "Please enter your first name.<br />";
                    }
                    if (empty($ln)) {
                        echo "Please enter your last name.<br />";
                    }
                    if (empty($email)) {
                        echo "Please enter your email.<br />";
                    }
                    if (empty($startdate)) {
                        echo "Please enter a start date.<br />";
                    }
                    if (empty($phone)) {
                        echo "Please enter your phone number.<br />";
                    }
                    if (empty($rcq)) {
                        echo "Please enter your Reference / Comments / Questions..<br />";
                    }
                    if (!empty($fn) && !empty($ln) && !empty($email) &&  !empty($startdate) && !empty($phone) && !empty($rcq)) {
                    // File handling
                    if (isset($_FILES['resume'])) {
                        if ($_FILES['resume']['error'] == 0) {
                            // Ensure the directory exists and is writable
                            $destination = __DIR__ . '/uploads/' . $_FILES['resume']['name'];
                            
                            if (!is_dir(__DIR__ . '/uploads/')) {
                                mkdir(__DIR__ . '/uploads/', 0777, true); // Create the directory if it does not exist
                            }
                            
                            if (move_uploaded_file($_FILES['resume']['tmp_name'], $destination)) {
                                $resume = $destination;
                            } else {
                                echo "There was an error moving the uploaded file.";
                                $resume = null;
                            }
                        } else {
                            echo "There was an error uploading the file: " . $_FILES['resume']['error'];
                            $resume = null;
                        }
                    } else {
                        echo "No file was uploaded.";
                        $resume = null;
                    }
                    $stmt = $conn->prepare("INSERT INTO apply (jobID, memberID, fn, ln, web, start_date, phone, rcq, resume) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("iisssssss", $jobid, $member_id, $fn, $ln, $website, $startdate, $phone, $rcq, $resume);
                    
                    if ($stmt->execute()) {
						echo "Your application has been submitted successfully. Redirecting in seconds...";
						header("refresh:5;url=jobs.php");

                    } else {
                        echo "There was an error submitting your application: " . $conn->error;
                    }
                    $stmt->close();
                }
                }
                ?>
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