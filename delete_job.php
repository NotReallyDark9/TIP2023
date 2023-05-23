<?php
session_start();
include 'settings.php';

if(isset($_POST['jobID']) && !empty($_POST['jobID'])) {
    $jobID = $_POST['jobID'];

    // Create connection
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Delete job from database
    $sql = "DELETE FROM jobs WHERE jobID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $jobID);
    
    if ($stmt->execute()) {
        echo "Job deleted successfully.";
    } else {
        echo "Error deleting job: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "No job ID received.";
}
?>
