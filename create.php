<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $qty = $_POST['qty'];
    $u_cost = $_POST['u_cost'];
    $active = $_POST['active'];
    $period = $_POST['period'];
    $grade = $_POST['grade'];
    $dividend = $_POST['dividend'];

    $sql = "INSERT INTO portfolios (name, date, qty, u_cost, active, period, grade, dividend) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiiissd", $name, $date, $qty, $u_cost, $active, $period, $grade, $dividend);

    if ($stmt->execute()) {
        header("Location: read.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>
