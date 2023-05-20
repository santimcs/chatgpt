<?php
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="read.php">PHP CRUD OPERATION</a>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="read.php">Home</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>    
    <!-- <h1>Add New User</h1> -->
    <div class="col-lg-6 m-auto">
        <form action="usr_create.php" method="post">
        <br><br>

            <div class="card">
                <div class="card-header bg-primary">
                    <h1 class="text-white text-center">  Create New User </h1>
                </div><br>     
                <!-- Display errors -->
                <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <?php foreach(explode(',', $_GET['error']) as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <p>Username: <input type="text" name="username" required></p>
                <p>Email: <input type="email" name="email" required></p>
                <p>Password: <input type="password" name="password" required></p>
                <p>Role: <input type="text" name="role" required></p>
                <p><input type="submit" value="Add User"></p>

            </div>
        </form>
    </div>
    <a href="usr_read.php">Back to list</a>
</body>
</html>