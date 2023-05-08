<?php
include 'config.php';
include 'validation_functions.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $name_error = validate_name($name, $conn);
    if ($name_error) {
        $errors[] = $name_error;
    }   
    $date = $_POST['date'];
    $date_error = validate_date($date);
    if ($date_error) {
        $errors[] = $date_error;
    }
    $qty = $_POST['qty'];
    $qty_error = validate_qty($qty);
    if ($qty_error) {
        $errors[] = $qty_error;
    }
    
    $u_cost = $_POST['u_cost'];
    $u_cost_error = validate_u_cost($u_cost);
    if ($u_cost_error) {
        $errors[] = $u_cost_error;
    }
    $active = $_POST['active'];

    $period = $_POST['period'];
    $period_error = validate_period($period);
    if ($period_error) {
        $errors[] = $period_error;
    }
    $grade = $_POST['grade'];
    $grade_error = validate_grade($grade);
    if ($grade_error) {
        $errors[] = $grade_error;
    }
    $dividend = $_POST['dividend'];
    $dividend_error = validate_dividend($dividend);
    if ($dividend_error) {
        $errors[] = $dividend_error;
    }
    
    if (!empty($errors)) {
        $error_message = implode(',', $errors);
        header("Location: create_form.php?error=".urlencode($error_message));
        exit();
    }

    if(empty($errors)) {
        $sql = "INSERT INTO portfolios (name, date, qty, u_cost, active, period, grade, dividend) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssidissd", $name, $date, $qty, $u_cost, $active, $period, $grade, $dividend);

        if ($stmt->execute()) {
            header("Location: read.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>
