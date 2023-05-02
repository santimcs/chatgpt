<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];
    $q3 = $_POST['q3'];
    $q4 = $_POST['q4'];
    $dividend = $_POST['dividend'];
    $qty = $_POST['qty'];
    $xdate = $_POST['xdate'];
    $pay_date = $_POST['pay_date'];
    $actual = POST['actual'];

    $sql = "INSERT INTO dividends (name, q4, q3, q2, q1, dividend, qty, xdate, pay_date, actual) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siiiiiiddi", $name, $q4, $q3, $q2, $q1, $dividend, $qty, $xdate, $pay_date, $actual);
    
    if ($stmt->execute()) {
        header("Location: dvd_read.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>