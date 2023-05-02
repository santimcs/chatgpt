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
    <div class="col-lg-6 m-auto">
        <form action="dvd_create.php" method="post">
            <br><br>
            <div class="card">
                <div class="card-header bg-primary">
                    <h1 class="text-white text-center">  Create New Dividend </h1>
                </div><br>     

                <label for="name">Name:</label>
                <input type="text" name="name" id="name" maxlength="10" required><br>

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