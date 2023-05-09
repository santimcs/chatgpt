<?php
require_once 'config.php';

// Fetch the ticker names from the 'tickers' table
$query = "SELECT name FROM tickers ORDER BY name";
$result = $conn->query($query);
$ticker_names = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ticker_names[] = $row['name'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Dividend</title>
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

    <div class="col-lg-6 m-auto">

        <form action="dvd_create.php" method="post">
            <br><br>

            <div class="card">
                <div class="card-header bg-primary">
                    <h1 class="text-white text-center">  Create New Dividend </h1>
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

                <label for="name">Name:</label>
                    <select name="name" id="name" required>
                        <?php foreach ($ticker_names as $ticker_name): ?>
                            <option value="<?php echo htmlspecialchars($ticker_name); ?>"><?php echo htmlspecialchars($ticker_name); ?></option>
                        <?php endforeach; ?>
                    </select><br>

                <label for="q4">Q4:</label>
                <input type="number" step="0.01" name="q4" id="q4" required><br>

                <label for="q3">Q3:</label>
                <input type="number" step="0.01" name="q3" id="q3" required><br>

                <label for="q2">Q2:</label>
                <input type="number" step="0.01" name="q2" id="q2" required><br>

                <label for="q1">Q1:</label>
                <input type="number" step="0.01" name="q1" id="q1" required><br>

                <label for="dividend">Dividend:</label>
                <input type="number" step="0.01" name="dividend" id="dividend" required><br>

                <label for="qty">Qty:</label>
                <input type="number" name="qty" id="qty" required><br>

                <label for="xdate">X Date:</label>
                <input type="date" name="xdate" id="xdate" required><br>

                <label for="pay_date">Pay Date:</label>
                <input type="date" name="pay_date" value="<?php echo $pay_date; ?>"><br>

                <label for="actual">Actual:</label>
                <input type="checkbox" name="actual" id="actual" value="1"><br>

                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
    <a href="dvd_read.php">Back to list</a>
</body>
</html>