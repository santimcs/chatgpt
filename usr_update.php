<?php
include 'config.php';
include 'validation_functions.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $username = $_POST["username"];
    $username_error = validate_username($username);
    if ($username_error) {
        $errors[] = $username_error;
    }    

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
    $role_error = validate_role($role);
    if ($role_error) {
        $errors[] = $role_error;
    }
    
    if(empty($errors)) {
        $sql = "UPDATE users SET username=?, email=?, password=?, role=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $username, $email, $password, $role, $id);

        if ($stmt->execute()) {
            header("Location: usr_read.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        };
        $stmt->close();
    } 
}

    if (isset($_GET['id']) || isset($_POST['id'])) {
        $id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
    } else {
        header("Location: usr_read.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!--  Addidtion to skeleton program  1 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Addidtion to skeleton program  2 -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" class="fw-bold">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">PHP CRUD OPERATION</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="read.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="create_form.php">Add New</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>    
    <!-- Addidtion to skeleton program  3 -->
    <div class="col-lg-6 m-auto">

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        
        <br><br>
            <!-- Addidtion to skeleton program  4 -->
            <div class="card">
                <div class="card-header bg-warning">
                    <h1 class="text-white text-center">  Update User </h1>
                </div><br>
                <!-- Display errors -->
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                <p>Username: <input type="text" name="username" value="<?php echo $row["username"]; ?>" required></p>
                <p>Email: <input type="email" name="email" value="<?php echo $row["email"]; ?>" required></p>
                <p>Password: <input type="password" name="password" value="<?php echo $row["password"]; ?>" required></p>
                <p>Role: <input type="text" name="role" value="<?php echo $row["role"]; ?>" required></p>
                <p><input type="submit" value="Update User"></p>

            </div>
            <!-- End of Addidtion to skeleton program  4 -->
        </form>
    </div>
    <!-- End of Addidtion to skeleton program  3 -->
    </body>
</html>
