<?php
include 'config.php';
include 'validation_functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    $q3_error = validate_q3($Dq3);
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
    // Validation check for dividend
    if($dividend < 0)
    {
        $errors[] = "Dividend must be greater than or equal to zero";
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

    if (!empty($errors)) {
        $error_message = implode(',', $errors);
        header("Location: dvd_create_form.php?error=".urlencode($error_message));
        exit();
    }    

    if(empty($errors)) {
        $sql = "INSERT INTO dividends (name, q4, q3, q2, q1, dividend, qty, xdate, pay_date, actual) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdddddissi", $name, $q4, $q3, $q2, $q1, $dividend, $qty, $xdate, $pay_date, $actual);
        
        if ($stmt->execute()) {
            header("Location: dvd_read.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>