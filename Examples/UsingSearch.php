<?php

$client = new Nerpa\Connection();
$client->host = 'nerpa.server';
$client->port = 5555;
$client->username = 'ninja';
$client->password = 'i_am_invisible';
$client->connect();
$expression = Nerpa\author('Пушкин$')->and_(Nerpa\title('СКАЗКИ$'));
$found = $client->searchCount($expression);
echo "Найдено: ", $found;
$client->disconnect();
