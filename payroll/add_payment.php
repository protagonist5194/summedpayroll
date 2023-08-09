<?php
include('db_config.php');

if (isset($_POST['add_payment'])) {
    $employee_id = $_POST['employee_id'];
    $amount_paid = $_POST['amount_paid'];
    $payment_date = date('Y-m-d'); // Use current date as payment date

    // Insert the payment data into the payments table
    $insert_payment_query = "INSERT INTO payments (employee_id, amount_paid, payment_date) VALUES ('$employee_id', '$amount_paid', '$payment_date')";
    
    if (mysqli_query($con, $insert_payment_query)) {
        // Redirect back to employee details page with success message
        header("Location: employee.php?id=$employee_id&payment_added=true");
        exit();
    } else {
        echo "Error adding payment: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
