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
    // End of name validation check
    $q4 = $_POST['q4'];
    // Validation check for q4
    if($q4 < 0)
    {
        $errors[] = "Q4 must be greater than or equal to zero";
    }
    $q3 = $_POST['q3'];
    // Validation check for q3
    if($q3 < 0)
    {
        $errors[] = "Q3 must be greater than or equal to zero";
    }    
    $q2 = $_POST['q2'];
    // Validation check for q2
    if($q2 < 0)
    {
        $errors[] = "Q2 must be greater than or equal to zero";
    }
    $q1 = $_POST['q1'];
    // Validation check for q1
    if($q1 < 0)
    {
        $errors[] = "Q1 must be greater than or equal to zero";
    }
    $dividend = $_POST['dividend'];
    // Validation check for dividend
    if($dividend < 0)
    {
        $errors[] = "Dividend must be greater than or equal to zero";
    }
    $qty = $_POST['qty'];
    if($qty < 0)
    {
        $errors[] = "Quantity must be greater than or equal to zero";
    }
    $xdate = $_POST['xdate'];
    $pay_date = $_POST['pay_date'];
    // Xdate & pay_date combination check
    if ($xdate > $pay_date) {
        $errors[] = "Xdate cannot be greater than pay date";
    }
    $actual = $_POST['actual'];

    if(empty($errors)) {
        $sql = "UPDATE dividends SET name = ?, q4 = ?, q3 = ?, q2 = ?, q1 = ?, dividend = ?, qty = ?, xdate = ?, pay_date = ?, actual = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        // $stmt->bind_param("siiiiiiddii", $name, $q4, $q3, $q2, $q1, $dividend, $qty, $xdate, $pay_date, $actual, $id);
        $stmt->bind_param("sdddddissii", $name, $q4, $q3, $q2, $q1, $dividend, $qty, $xdate, $pay_date, $actual, $id);
        if ($stmt->execute()) {
            header("Location: dvd_read.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
    }
}

    if (isset($_GET['id']) || isset($_POST['id'])) {
        $id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
        $sql = "SELECT * FROM dividends WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        } else {
            header("Location: dvd_read.php");
            exit();
        }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit dividend</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="col-lg-6 m-auto">

        <form action="dvd_update.php" method="post">
        <br><br>
            <div class="card">

                <div class="card-header bg-warning">
                    <h1 class="text-white text-center">  Update Dividend </h1>
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
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control"> <br>
                <label for="q4">Q4:</label>
                <input type="number" step="0.0001" name="q4" id="q4" value="<?php echo $row['q4']; ?>" required><br>
                <label for="q3">Q3:</label>
                <input type="number" step="0.0001" name="q3" id="q3" value="<?php echo $row['q3']; ?>" required><br>
                <label for="q2">Q2:</label>
                <input type="number" step="0.0001" name="q2" id="q2" value="<?php echo $row['q2']; ?>" required><br>
                <label for="q1">Q1:</label>
                <input type="number" step="0.0001" name="q1" id="q1" value="<?php echo $row['q1']; ?>" required><br>
                <label for="dividend">Dividend:</label>
                <input type="number" step="0.0001" name="dividend" id="dividend" value="<?php echo $row['dividend']; ?>" required><br>
                <label for="qty">Qty:</label>
                <input type="number" name="qty" id="qty" value="<?php echo $row['qty']; ?>" required><br>
                <label for="xdate">Xdate:</label>
                <input type="date" name="xdate" id="xdate" value="<?php echo $row['xdate']; ?>" required><br>
                <label for="pay_date">Pay Date:</label>
                <input type="date" name="pay_date" id="pay_date" value="<?php echo $row['pay_date']; ?>" required><br>
                <label for="actual">Actual:</label>
                <input type="checkbox" name="actual" id="actual" value="1" <?php echo $row['actual'] ? 'checked' : ''; ?>><br>
                <input type="submit" value="Save">
            </div>
        </form>
    </div>

<a href="dvd_read.php">Back to list</a>
</body>
</html>