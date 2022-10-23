<?php
include('Database.php');
$db = Database::getInstance();
$stmt = mysqli_prepare($db,   "SELECT * FROM `awam_operation_list` WHERE `Date` = CURRENT_DATE");
$result = mysqli_stmt_execute($stmt) or die(mysqli_error($db));
$result = $stmt->get_result();

$from = 'no-reply@awam.fr';
$to = 'contact@awam.fr';
$subject = 'Calculs du jour ! ';
$msg = '';
$msg .= "Voici les résultats du jour ! <br/><br/>";

while ($row = $result->fetch_assoc()) {
    if ($row['Currency_one'] == $row['Currency_two']) {
        $currency = $row['Currency_one'];
    }else{
        $currency = 'EUR';
    };
    $msg .= $row['Amount_one'] . $row['Currency_one'] . '+' . $row['Amount_two'] . $row['Currency_two'] . ' = ' . $row['Total'] . $currency . '<br/>';
};

echo $msg;


// mail($to, $subject, $msg, $from);
