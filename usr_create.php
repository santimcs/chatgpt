<?php
include 'config.php';
include 'validation_functions.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $username = $_POST["username"];
    $email = $_POST["email"];
    $email_error = validate_email($email);
    if ($email_error) {
        $errors[] = $email_error;
    }    
    $password = $_POST["password"];
    $password_error = validate_password($password);
    if ($password_error) {
        $errors[] = $password_error;
    }     
    $role = $_POST["role"];
    $date = date("Y-m-d H:i:s");

    if (!empty($errors)) {
        $error_message = implode(',', $errors);
        header("Location: usr_create_form.php?error=".urlencode($error_message));
        exit();
    } 

    if(empty($errors)) {
        $sql = "INSERT INTO users (username, email, password, role, date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $username, $email, $password, $role, $date);

        if ($stmt->execute()) {
            header("Location: usr_read.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
    }
}
$conn->close();
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
