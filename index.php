<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awam-Currency</title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<body>
    <?php  include('core/Database.php'); ?>
    <input type="number" min="0.1" name="amount_one" id="amount_one"><select name="currency_one" id="currency_one"><?php include('includes/db_currencies.php'); ?></select><br>
    <input type="number" min="0.1" name="amount_two" id="amount_two"><select name="currency_two" id="currency_two"><?php include('includes/db_currencies.php'); ?></select>
    <button id="currency_addition">Calculer ! </button>

    <p id="calcul">

    </p>

    <script src="script.js"></script>
</body>
</html>