<?php
include 'config.php';

$sql = "SELECT * FROM portfolios";
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

        <title>Read Portfolios</title>
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
                          <a type="button" class="btn btn-secondary nav-link" href="dvd_read.php">Dividends</a>
                        </li>
                        <li class="nav-item">
                          <a type="button" class="btn btn-primary nav-link active" href="create_form.php">Add New</a>
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
                        <th>Name</th>
                        <th>Date</th>
                        <th>Qty</th>
                        <th>Cost</th>
                        <th>Cost Amt</th>
                        <th>A</th>
                        <th>Period</th>
                        <th>Grade</th>
                        <th>Dividend</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['date']; ?></td>

                        <?php $formatted_qty = number_format($row['qty'], 0, '.', ','); ?>
                        <td><?php echo $formatted_qty; ?></td>

                        <td><?php echo $row['u_cost']; ?></td>

                        <?php $cost = $row['qty'] * $row['u_cost']; ?>
                        <?php $formatted_cost = number_format($cost, 2, '.', ','); ?>
                        <td><?php echo $formatted_cost; ?></td>

                        <td><?php echo $row['active']; ?></td>
                        <td><?php echo $row['period']; ?></td>
                        <td><?php echo $row['grade']; ?></td>
                        <td><?php echo $row['dividend']; ?></td>
                        <td>
                            <a class="btn btn-success" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div> <!-- class="container my-4" -->
        <!-- End of Addition to Skeleton Program 2 -->
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>

<?php
$conn->close();
?>