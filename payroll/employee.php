<!DOCTYPE html>
<html>
<head>
    <title>Employee Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php
    include('db_config.php');
    session_start();

    if (isset($_GET['id'])) {
        $employee_id = $_GET['id'];

        $employee_query = "SELECT * FROM employees WHERE id = '$employee_id'";
        $employee_result = mysqli_query($con, $employee_query);
        $employee = mysqli_fetch_assoc($employee_result);

        // Calculate the total salary (same as before)
        $total_salary_query = "SELECT SUM(salary) AS total_salary FROM employees WHERE id = '$employee_id'";
        $total_salary_result = mysqli_query($con, $total_salary_query);
        $total_salary = mysqli_fetch_assoc($total_salary_result)['total_salary'];

        // Calculate the total amount paid
        $total_paid_query = "SELECT SUM(amount_paid) AS total_paid FROM payments WHERE employee_id = '$employee_id'";
        $total_paid_result = mysqli_query($con, $total_paid_query);
        $total_paid = mysqli_fetch_assoc($total_paid_result)['total_paid'];

        // Get individual payment details
        $payments_query = "SELECT * FROM payments WHERE employee_id = '$employee_id'ORDER BY payment_date DESC";
        $payments_result = mysqli_query($con, $payments_query);

        // ... your existing code to display employee details ...

        echo '<h2>Total Amount Paid: $' . $total_paid . '</h2>';
        
        // Display individual payments
        echo '<h2>Payment History</h2>';
        echo '<table class="table table-bordered table-hover">';
        echo '<thead class="thead-dark">';
        echo '<tr><th>Date</th><th>Amount Paid</th></tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($payment = mysqli_fetch_assoc($payments_result)) {
            echo '<tr>';
            echo '<td>' . $payment['payment_date'] . '</td>';
            echo '<td>$' . $payment['amount_paid'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';


        // Display payment addition form
        echo '<div class="mt-4">';
        echo '<h3>Add Payment</h3>';
        echo '<form method="post" action="add_payment.php">';
        echo '<input type="hidden" name="employee_id" value="' . $employee_id . '">';
        echo '<div class="form-group">';
        echo '<label for="amount_paid">Amount Paid:</label>';
        echo '<input type="text" class="form-control" id="amount_paid" name="amount_paid" required>';
        echo '</div>';
        echo '<button type="submit" class="btn btn-primary" name="add_payment">Add Payment</button>';
        echo '</form>';
        echo '</div>';
    }
    ?>
  <br/>
    <!-- Display back button -->
    <a href="index.php" class="btn btn-secondary">Back</a>

</body>
</html>




