<?php
include 'config.php';

$sql = "SELECT * FROM dividends";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Read Dividends</title>
</head>
<body>
    <div class="container my-4">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Q4</th>
                    <th>Q3</th>
                    <th>Q2</th>
                    <th>Q1</th>
                    <th>Dividend</th>
                    <th>Qty</th>
                    <th>X Date</th>
                    <th>Pay Date</th>
                    <th>Actual</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['q4']; ?></td>
                    <td><?php echo $row['q3']; ?></td>
                    <td><?php echo $row['q2']; ?></td>
                    <td><?php echo $row['q1']; ?></td>
                    <td><?php echo $row['dividend']; ?></td>
                    <?php $formatted_qty = number_format($row['qty'], 0, '.', ','); ?>
                    <td><?php echo $formatted_qty; ?></td>
                    <td><?php echo $row['xdate']; ?></td>
                    <td><?php echo $row['pay_date']; ?></td>
                    <td><?php echo $row['actual']; ?></td>
                    <td>
                        <a class="btn btn-success" href="dvd_update.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a class="btn btn-danger" href="dvd_delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div> <!-- class="container my-4" -->

  <a href="dvd_create.php">Add new dividend</a>
</body>
</html>
<?php
$conn->close();
?>