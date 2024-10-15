<?php

error_reporting(E_ALL);

require_once ('../Source/Nerpa.php');
require_once ('../Source/Teapot.php');

$connection = new Nerpa\Connection();
$connection->host = '127.0.0.1';
$connection->database = 'HUDO';
$connection->username = 'librarian';
$connection->password = 'secret';
$connection->workstation = Nerpa\CATALOGER;

if (!$connection->connect()) {
    echo "Не удалось подключиться!" . PHP_EOL;
    echo Nerpa\describe_error($connection->lastError) . PHP_EOL;
    die(1);
}

$teapot = new Nerpa\Teapot();
// $teapot->debug = true;
$found = $teapot->search($connection,'Тринадцатая сказка');
foreach ($found as $item) {
    $item->description = $connection->formatRecord('@brief', $item->record->mfn);
    echo "{$item->record->mfn}: {$item->rating}: {$item->description}<br>" . PHP_EOL;
}

$connection->disconnect();
echo "Успешное завершение";