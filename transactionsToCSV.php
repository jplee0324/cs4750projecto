<?php
require('connectdb.php');
require('db-commands.php');
?>

<?php

$transactions = viewTransactions($_COOKIE['pwd']);

$fp = fopen('transactions.csv', 'w');
fputcsv($fp, ['Transaction ID', 'Sender', 'Recipient', 'Amount', 'Date']);

foreach ($transactions as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);

header('Content-type: application/csv');
header("Content-Disposition: inline; filename=transactions.csv");
readfile("transactions.csv");

?>