<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $date = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $email, $password, $role, $date);
    $stmt->execute();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
</head>
<body>
    <h1>Add New User</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p>Username: <input type="text" name="username" required></p>
        <p>Email: <input type="email" name="email" required></p>
        <p>Password: <input type="password" name="password" required></p>
        <p>Role: <input type="text" name="role" required></p>
        <p><input type="submit" value="Add User"></p>
    </form>
</body>
</html>
