<?php 
$db = Database::getInstance();
$stmt = mysqli_prepare($db, "SELECT * FROM `awam_currency`");
$result = mysqli_stmt_execute($stmt) or die(mysqli_error($db));
$result = $stmt->get_result();
while($row = $result->fetch_assoc()){
    
    echo '<option data-value="'.$row['Percentage'].'" value="'.$row['Name_reference'].'">'.$row['Name'].'</option>';
}