<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">PAYROLL</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>


<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container mt-5">
        <h2>Employee List</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Phone_no</th>
                        <th>Email</th>
                        <th>Salary</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('db_config.php');
                    
                    $employee_query = "SELECT * FROM employees";
                    $employee_result = mysqli_query($con, $employee_query);
                    
                    while ($employee = mysqli_fetch_assoc($employee_result)) {
                        echo "<tr>";
                        echo "<td><a href='#' class='employee-link' data-id='" . $employee['id'] . "'>" . $employee['name'] . "</a></td>";
                        echo "<td>" . $employee['phone'] . "</td>";
                        echo "<td>" . $employee['email'] . "</td>";
                        echo "<td>$" . $employee['salary'] . "</td>";
                        echo "<td>";
                        echo "<a href='edit_employee.php?id=" . $employee['id'] . "' class='btn btn-warning'>Edit</a> ";
                        echo "<a href='delete_employee.php?id=" . $employee['id'] . "' class='btn btn-danger'>Delete</a> ";
                        echo "<a href='employee.php?id=" . $employee['id'] . "' class='btn btn-primary'>View</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    
                    mysqli_close($con);
                    ?>
                </tbody>
            </table> 
        </div>

        <!-- Add Employee button -->
        <a href="add_employee.php" class="btn btn-success">Add Employee</a>
    </div>

    <!-- JavaScript to show total amount on click -->
    <script>
        const employeeLinks = document.querySelectorAll('.employee-link');

        employeeLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();

                const employeeId = link.getAttribute('data-id');
                fetch(`get_total_paid.php?id=${employeeId}`)
                    .then(response => response.text())
                    .then(totalPaid => {
                        alert(`Total Amount Paid for ${link.textContent}: $${totalPaid}`);
                    })
                    .catch(error => console.error('Error fetching data:', error));
            });
        });
    </script>
</body>
</html>
