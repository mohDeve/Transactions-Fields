<?php

declare(strict_types = 1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

/* YOUR CODE (Instructions in README.md) */
require APP_PATH . 'App.php';

require APP_PATH . 'helper.php';

$files =getTransactionsFiles(FILES_PATH);
// var_dump($files);
$transactions =[];

foreach($files as $file){

$transactions = array_merge($transactions,getTransactions($file));
}

$totals = calculateTotals($transactions);
// var_dump($transactions);
require VIEWS_PATH . "transactions.php";