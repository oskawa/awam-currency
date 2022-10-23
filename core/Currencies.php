<?php
include('Database.php');
if (isset($_POST['callFunction'])) {
    if ($_POST['callFunction'] == "get_currency") {

        $array = array();
        $db = Database::getInstance();
        $currency_one = $_POST['currency_one'];
        $currency_two = $_POST['currency_two'];

        $stmt = mysqli_prepare($db,   "SELECT `Percentage` FROM `awam_currency` WHERE `Name_reference` = ? ");
        mysqli_stmt_bind_param($stmt, "s", $currency_one);
        $result = mysqli_stmt_execute($stmt) or die(mysqli_error($db));
        $result = $stmt->get_result();
        array_push($array, (array)$result->fetch_assoc());

        $stmt = mysqli_prepare($db,   "SELECT `Percentage` FROM `awam_currency` WHERE `Name_reference` = ? ");
        mysqli_stmt_bind_param($stmt, "s", $currency_two);
        $result = mysqli_stmt_execute($stmt) or die(mysqli_error($db));
        $result = $stmt->get_result();
        array_push($array, (array)$result->fetch_assoc());

    $json_array = json_encode($array);
    echo $json_array;
    }
    if ($_POST['callFunction'] == "save_currency") {
        var_dump( $_POST['currency_one']);
        $db = Database::getInstance();
        $stmt = mysqli_prepare($db, 'INSERT INTO awam_operation_list(`Currency_one`,`Amount_one`,`Currency_two`,`Amount_two`,`Total`) VALUES ( ?, ? , ? , ?, ?)');
    mysqli_stmt_bind_param($stmt, 'sdsdd', $_POST['currency_one'], $_POST['amount_one'], $_POST['currency_two'], $_POST['amount_two'], $_POST['result']  );
    $result = mysqli_stmt_execute($stmt) or die(mysqli_error($db));

    }
}
