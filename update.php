<?php
include 'config.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    
    $name = $_POST['name'];
    // Validation check for name
    $sql_name_check = "SELECT COUNT(*) as name_count FROM tickers WHERE name = ?";
    $stmt_name_check = $conn->prepare($sql_name_check);
    $stmt_name_check->bind_param("s", $name);
    $stmt_name_check->execute();
    $result_name_check = $stmt_name_check->get_result();
    $row_name_check = $result_name_check->fetch_assoc();
    if ($row_name_check['name_count'] == 0) {
        $errors[] = "Name must belong to the 'name' column of the 'tickers' table";
    }
    $stmt_name_check->close();

    $date = $_POST['date'];
    // Input date cannot be future date
    $today = date("Y-m-d");
    if ($date > $today) {
        $errors[] = "Date cannot be greater than today";
    }
    $qty = $_POST['qty'];
    if($qty <= 0)
    {
        $errors[] = "Quantity must be greater than zero";
    }
    $u_cost = $_POST['u_cost'];
    // Validation check for unit cost
    if($u_cost <= 0)
    {
        $errors[] = "Unit cost must be greater than zero";
    }
    $active = $_POST['active'];
    $period = $_POST['period'];
    // Validation check for period
    if ($period < 1 || $period > 4) {
        $errors[] = "Period must be between 1 and 4";
    }
    $grade = $_POST['grade'];
    // Validation check for grade
    if (!preg_match("/^[ABC][1-4]$/", $grade)) {
        $errors[] = "Grade must start with 'A', 'B', or 'C' and be followed by a number between 1 and 4";
    }    
    $dividend = $_POST['dividend'];
    // Validation check for dividend
    if($dividend < 0)
    {
        $errors[] = "Dividend must be positive";
    }
    if(empty($errors)) {
        $sql = "UPDATE portfolios SET name=?, date=?, qty=?, u_cost=?, active=?, period=?, grade=?, dividend=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiiissdi", $name, $date, $qty, $u_cost, $active, $period, $grade, $dividend, $id);

        if ($stmt->execute()) {
            header("Location: read.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
    }
}

    if (isset($_GET['id']) || isset($_POST['id'])) {
        $id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
        $sql = "SELECT * FROM portfolios WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        } else {
            header("Location: read.php");
            exit();
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Portfolio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
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
    <!-- <h1>Update Portfolio</h1> -->
    <div class="col-lg-6 m-auto">

        <form action="update.php" method="post">
        <br><br>

            <div class="card">

                <div class="card-header bg-warning">
                    <h1 class="text-white text-center">  Update Portfolio </h1>
                </div><br>
                <!-- Display errors -->
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control"> <br>
                <label> NAME: </label>
                <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control"> <br>
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" value="<?php echo $row['date']; ?>" required><br>
                <label for="qty">Quantity:</label>
                <input type="number" name="qty" id="qty" value="<?php echo $row['qty']; ?>" required><br>
                <label for="u_cost">Unit Cost:</label>
                <input type="number" step="0.01" name="u_cost" id="u_cost" value="<?php echo $row['u_cost']; ?>" required><br>
                <label for="active">Active:</label>
                <input type="checkbox" name="active" id="active" value="1" <?php echo $row['active'] ? 'checked' : ''; ?>><br>
                <label for="period">Period:</label>
                <input type="text" name="period" id="period" maxlength="1" value="<?php echo $row['period']; ?>" required><br>
                <label for="grade">Grade:</label>
                <input type="text" name="grade" id="grade" maxlength="2" value="<?php echo $row['grade']; ?>" required><br>
                <label for="dividend">Dividend:</label>
                <input type="number" step="0.0001" name="dividend" id="dividend" value="<?php echo $row['dividend']; ?>" required><br>
                <input type="submit" value="Update">
            </div>
        </form>
    </div>

    <a href="read.php">Back to list</a>
</body>
</html>