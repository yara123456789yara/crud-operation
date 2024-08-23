<?php
include "db_conn.php";
$id = $_GET['id'];

// Prevent SQL injection
$id = mysqli_real_escape_string($conn, $id);

$sql = "DELETE FROM crud WHERE id = '$id'";
$result = mysqli_query($conn, $sql); 

if ($result) {
    header("Location: index.php?msg=Record deleted successfully");
    exit; // Add this to prevent further execution
} else {
    echo "Failed: " . mysqli_error($conn); // Use mysqli_error instead of $conn->error
}
?>