<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>User Login</h2>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>

<?php
session_start();
include('db_config.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $select_query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $select_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: index.php"); // Redirect to your main page after login
    } else {
        echo "<script>alert('Invalid credentials!');</script>";
    }
}

mysqli_close($conn);
?>
