<?php
function validate_name($name, $conn) {
    $sql_name_check = "SELECT COUNT(*) as name_count FROM tickers WHERE name = ?";
    $stmt_name_check = $conn->prepare($sql_name_check);
    $stmt_name_check->bind_param("s", $name);
    $stmt_name_check->execute();
    $result_name_check = $stmt_name_check->get_result();
    $row_name_check = $result_name_check->fetch_assoc();
    if ($row_name_check['name_count'] == 0) {
        return "Name must belong to the 'name' column of the 'tickers' table";
    }
    $stmt_name_check->close();
    return null;
}

function validate_date($date) {
    $today = date("Y-m-d");
    if ($date > $today) {
        return "Date cannot be greater than today";
    }
    return null;
}

function validate_date_combo($xdate, $pay_date) {
    if ($xdate > $pay_date) {
        return "XDate cannot be greater than pay_date";
    }
    return null;
}

function validate_q1($q1) {
    if($q1 < 0)
    {
        return "Q1 must be greater than or equal to zero";
    }
    return null;
}

function validate_q2($q2) {
    if($q2 < 0)
    {
        return "Q2 must be greater than or equal to zero";
    }
    return null;
}

function validate_q3($q3) {
    if($q3 < 0)
    {
        return "Q3 must be greater than or equal to zero";
    }
    return null;
}

function validate_q4($q4) {
    if($q4 < 0)
    {
        return "Q4 must be greater than or equal to zero";
    }
    return null;
}

function validate_qty($qty) {
    if($qty < 0)
    {
        return "Quantity must be greater than or equal to zero";
    }
    return null;
}

function validate_u_cost($u_cost) {
    if($u_cost <= 0)
    {
        return "Unit cost must be greater than zero";
    }
    return null;
}

function validate_period($period) {
    if ($period < 1 || $period > 4) {
        return "Period must be between 1 and 4";
    }
    return null;
}

function validate_grade($grade) {
    if (!preg_match("/^[ABC][1-4]$/", $grade)) {
        return "Grade must start with 'A', 'B', or 'C' and be followed by a number between 1 and 4";
    }
    return null;
}

function validate_dividend($dividend) {
    if($dividend < 0)
    {
        return "Dividend must be positive";
    }
    return null;
}
