<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>User Registration</h2>
        <form method="post" action="register.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>
</html>

<?php
include('db_config.php');

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    
    $insert_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($con, $insert_query)) {
        echo "<script>alert('User registered successfully!'); window.location.href = 'login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
