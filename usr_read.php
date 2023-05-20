<?php
include 'config.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    
        <title>User Management</title>
    </head>
    <body>
        <!-- Addition to Skeleton Program 1 -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="read.php">PHP CRUD OPERATION</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="read.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a type="button" class="btn btn-secondary nav-link" href="read.php">Portfolios</a>
                        </li>
                        <li class="nav-item">
                            <a type="button" class="btn btn-secondary nav-link" href="dvd_read.php">Dividends</a>
                        </li>
                        <li class="nav-item">
                            <a type="button" class="btn btn-primary nav-link active" href="usr_create_form.php">Add New User</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>    

        <!-- Addition to Skeleton Program 2 -->
        <div class="container my-4">
        <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["username"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["role"]; ?></td>
                            <td><?php echo date('Y-m-d', strtotime($row["date"])); ?></td>
                            <td>
                                <a class="btn btn-success" href="usr_update.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a class="btn btn-danger" href="usr_delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                                </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div> 
        <!-- End of Addition to Skeleton Program 2 -->
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        </body>
</html>
