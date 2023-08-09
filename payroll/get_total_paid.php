<?php
include('db_config.php'); // Include the database configuration to establish a connection

if (isset($_GET['id'])) {
    $employee_id = $_GET['id']; // Get the employee ID from the URL parameter

    // Query to calculate the total amount paid for the specified employee
    $total_paid_query = "SELECT SUM(amount_paid) AS total_paid FROM payments WHERE employee_id = '$employee_id'";
    $total_paid_result = mysqli_query($con, $total_paid_query);
    $total_paid = mysqli_fetch_assoc($total_paid_result)['total_paid'];

    echo $total_paid; // Echo the total amount paid
}

mysqli_close($con); // Close the database connection
?>
