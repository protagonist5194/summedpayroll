<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Employee</h2>
        <?php
        include('db_config.php');
        
        if (isset($_GET['id'])) {
            $employee_id = $_GET['id'];
            
            if (isset($_POST['update_employee'])) {
                $new_name = $_POST['new_name'];
                $new_phone = $_POST['new_phone'];
                $new_email = $_POST['new_email'];
                $new_salary = $_POST['new_salary'];
                
                $update_query = "UPDATE employees SET name = '$new_name', phone = '$new_phone', email = '$new_email', salary = '$new_salary' WHERE id = '$employee_id'";
                if (mysqli_query($con, $update_query)) {
                    echo "<div class='alert alert-success'>Employee details updated successfully!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error updating employee details: " . mysqli_error($con) . "</div>";
                }
            }
            
            $employee_query = "SELECT * FROM employees WHERE id = '$employee_id'";
            $employee_result = mysqli_query($con, $employee_query);
            $employee = mysqli_fetch_assoc($employee_result);
            
            echo '<form method="post">';
            echo '<div class="form-group">';
            echo '<label for="new_name">Employee Name:</label>';
            echo '<input type="text" class="form-control" id="new_name" name="new_name" value="' . $employee['name'] . '" required>';
            echo '</div>';
           
            echo '<div class="form-group">';
            echo '<label for="new_phone">Employee Phone:</label>';
            echo '<input type="text" class="form-control" id="new_phone" name="new_phone" value="' . $employee['phone'] . '" required>';
            echo '</div>';


            echo '<div class="form-group">';
            echo '<label for="new_emaikl">Employee Email:</label>';
            echo '<input type="email" class="form-control" id="new_email" name="new_email" value="' . $employee['email'] . '" required>';
            echo '</div>';

            echo '<div class="form-group">';
            echo '<label for="new_salary">Employee Salary:</label>';
            echo '<input type="text" class="form-control" id="new_salary" name="new_salary" value="' . $employee['salary'] . '" required>';
            echo '</div>';
            echo '<button type="submit" name="update_employee" class="btn btn-primary">Update Employee</button>';
            echo '</form>';
        }
        
        mysqli_close($con);
        ?>
        <br>
        <a href="index.php" class="btn btn-secondary">Back to Employee List</a>
    </div>
</body>
</html>
