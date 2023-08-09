<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Employee</h2>
        <form method="post" action="add_employee.php">
            <div class="form-group">
                <label for="employee_name">Employee Name:</label>
                <input type="text" class="form-control" id="employee_name" name="employee_name" required>
            </div>
            <div class="form-group">
                <label for="phone_no">Employee Phone_no:</label>
                <input type="text" class="form-control" id="phone_no" name="phone_no" required>
            </div>

             <div class="form-group">
                <label for="email">Employee Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
             <div class="form-group">
                <label for="employee_salary">Employee Salary:</label>
                <input type="text" class="form-control" id="employee_salary" name="employee_salary" required>
            </div>
            <button type="submit" name="add_employee" class="btn btn-primary">Add Employee</button>
        </form>
                <a href="index.php" class="btn btn-secondary mt-3">Back to Employee List</a>

    </div>
</body>
</html>

<?php
include('db_config.php');

if (isset($_POST['add_employee'])) {
    $employee_name = $_POST['employee_name'];
    $employee_salary = $_POST['employee_salary'];

    $insert_query = "INSERT INTO employees (name, salary) VALUES ('$employee_name', '$employee_salary')";
    if (mysqli_query($con, $insert_query)) {
        echo "<script>alert('New employee added successfully!'); window.location.href = 'index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
