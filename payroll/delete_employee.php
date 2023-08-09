<!DOCTYPE html>
<html>
<head>
    <title>Delete Employee</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Delete Employee</h2>
        <?php
        include('db_config.php');
        
        if (isset($_GET['id'])) {
            $employee_id = $_GET['id'];
            
            if (isset($_POST['delete_employee'])) {
                $delete_query = "DELETE FROM employees WHERE id = '$employee_id'";
                if (mysqli_query($con, $delete_query)) {
                    echo "<div class='alert alert-success'>Employee deleted successfully!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error deleting employee: " . mysqli_error($con) . "</div>";
                }
            }
            
            $employee_query = "SELECT * FROM employees WHERE id = '$employee_id'";
            $employee_result = mysqli_query($con, $employee_query);
            $employee = mysqli_fetch_assoc($employee_result);
            
            echo '<p>Are you sure you want to delete the employee: ' . $employee['name'] . '?</p>';
            echo '<form method="post">';
            echo '<button type="submit" name="delete_employee" class="btn btn-danger">Delete Employee</button>';
            echo '</form>';
        }
        
        mysqli_close($con);
        ?>
        <br>
        <a href="index.php" class="btn btn-secondary">Back to Employee List</a>
    </div>
</body>
</html>
