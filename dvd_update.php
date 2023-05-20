<?php
include 'config.php';
include 'validation_functions.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $name = $_POST['name'];
    $name_error = validate_name($name, $conn);
    if ($name_error) {
        $errors[] = $name_error;
    } 

    $q4 = $_POST['q4'];
    $q4_error = validate_q4($q4);
    if ($q4_error) {
        $errors[] = $q4_error;
    }

    $q3 = $_POST['q3'];
    $q3_error = validate_q3($q3);
    if ($q3_error) {
        $errors[] = $q3_error;
    }  

    $q2 = $_POST['q2'];
    $q2_error = validate_q2($q2);
    if ($q2_error) {
        $errors[] = $q2_error;
    }

    $q1 = $_POST['q1'];
    $q1_error = validate_q1($q1);
    if ($q1_error) {
        $errors[] = $q1_error;
    }

    $dividend = $_POST['dividend'];
    $dividend_error = validate_dividend($dividend);
    if ($dividend_error) {
        $errors[] = $dividend_error;
    }    

    $qty = $_POST['qty'];
    $qty_error = validate_qty($qty);
    if ($qty_error) {
        $errors[] = $qty_error;
    }

    $xdate = $_POST['xdate'];
    $pay_date = $_POST['pay_date'];
    // Xdate & pay_date combination check
    $date_combo_error = validate_date_combo($xdate, $pay_date);
    if ($date_combo_error) {
        $errors[] = $date_combo_error;
    } 

    $actual = $_POST['actual'];

    if(empty($errors)) {
        $sql = "UPDATE dividends SET name=?, q4=?, q3=?, q2=?, q1=?, dividend=?, qty=?, xdate=?, pay_date=?, actual=? WHERE id=?";
        $stmt = $conn->prepare($sql);
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
        // Fetch the ticker names from the 'tickers' table
        $query = "SELECT name FROM tickers ORDER BY name";
        $result = $conn->query($query);
        $ticker_names = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ticker_names[] = $row['name'];
            }
        }

        $id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
        $sql = "SELECT * FROM dividends WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $current_data = $row;
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
            <p><?php echo $row['id']; ?></p>

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

                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <label for="name">Name:</label>
                <select name="name" id="name" required>
                    <?php foreach ($ticker_names as $ticker_name): ?>
                        <option value="<?php echo htmlspecialchars($ticker_name); ?>"<?php echo $ticker_name === $current_data['name'] ? ' selected' : ''; ?>><?php echo htmlspecialchars($ticker_name); ?></option>
                    <?php endforeach; ?>
                </select><br>

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