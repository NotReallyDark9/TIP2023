<?php
session_start();

include 'settings.php';

$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$jobId = $_POST['jobId'];
$memberId = $_SESSION['user_id'];

// Check if the job is already bookmarked
$stmt = $conn->prepare("SELECT COUNT(*) as count FROM favorite WHERE memberID = ? AND jobID = ?");
$stmt->bind_param('ii', $memberId, $jobId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$isBookmarked = $row['count'] > 0;

if ($isBookmarked) {
    // If the job is already bookmarked, then we remove the bookmark
    $stmt = $conn->prepare("DELETE FROM favorite WHERE memberID = ? AND jobID = ?");
    $stmt->bind_param('ii', $memberId, $jobId);
    $stmt->execute();
} else {
    // If the job is not bookmarked, then we add a bookmark
    $stmt = $conn->prepare("INSERT INTO favorite (memberID, jobID) VALUES (?, ?)");
    $stmt->bind_param('ii', $memberId, $jobId);
    $stmt->execute();
}

$conn->close();
?>
