<?php
declare(strict_types=1);

require_once('./src/packages/Manager/File.php');
require_once('./src/packages/Operation/Transaction.php');

use Manager\File;
use Operation\Transaction;

$files = scandir('./tables');
$files = array_diff($files, array('.','..'));
$files = array_values($files);

$rawTransactions = [];
$dataTransactions = [];

foreach ($files as &$file) {
	$file = new File('./tables/'. $file);
	$rawTransactions[] = new Transaction($file);
}

foreach ($rawTransactions as $rawTransaction) {
	$dataTransactions[] = $rawTransaction->getTransactions();
}

?>