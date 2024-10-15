<head>
    <meta charset="UTF-8"/>
    <title>Простой пример глобальной корректировки</title>
</head>

<?php

require_once __DIR__ . '/../Source/Nerpa.php';

//
// Данный пример демонстрирует простую глобальную корректировку.
// Она проводится над базой данных TEST, наличие которой предполагается.
// Обратите внимание: AUTOIN.GBL в данном сценарии не срабатывает!
//

try {

    // Подключаемся к серверу
    $connection = new Nerpa\Connection();
    $connectString = 'host=127.0.0.1;user=librarian;password=secret;';
    $connection->parseConnectionString($connectString);

    if (!$connection->connect()) {
        echo '<h3 style="color: red;">Не удалось подключиться!</h3>';
        echo '<p>', Nerpa\describe_error($connection->lastError), '</p>';
        die(1);
    }

    $statements = array(
        new Nerpa\GblStatement('NEWMFN', "'TEST'"),
        new Nerpa\GblStatement('ADD', '700', 'XXX', "'^AἈριστοτέλης'"),
        new Nerpa\GblStatement('ADD', '200', 'XXX', "'^Aアリストテレス'"),
        new Nerpa\GblStatement('ADD', '300', 'XXX', "'Пробная запись'"),
        new Nerpa\GblStatement('ADD', '920', 'XXX', "'PAZK'"),
        new Nerpa\GblStatement('END'),
    );
    $settings = new Nerpa\GblSettings();
    $settings->mfnList = array(1);
    $settings->statements = $statements;
    $result = $connection->globalCorrection($settings);

    echo '<h1>Результат корректировки</h1>';
    echo '<pre>', implode('<br/>', $result ), '</pre>';

    //
    // Ожидаемый результат корректировки:
    //
    // DBN=TEST#MFN=0#AUTOIN=#UPDATE=0#STATUS=8#UPDUF=0#
    // DBN=IBIS#MFN=1#AUTOIN=#UPDATE=0#STATUS=8#UPDUF=0#
    //

    // Отключаемся от сервера
    $connection->disconnect();
} catch (Exception $exception) {
    echo "ОШИБКА:  $exception";
}
