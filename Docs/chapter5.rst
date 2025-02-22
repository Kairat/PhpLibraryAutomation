====================
Построитель запросов
====================

Класс ``Search`` представляет собой построитель запросов в синтаксисе прямого поиска. В нём имеются следующие статические методы:

* **all()** -- отбор всех документов в базе. Фактически строит запрос ``I=$``.

* **equals($prefix, ...)** -- поиск по совпадению с одним из перечисленных значений. Возвращает построитель запросов для последующих цепочечных вызовов.

Экземплярные методы:

* **and_(....)** -- логическое И. Возвращает построитель запросов для последующих цепочечных вызовов.

* **not_($text)** -- логическое НЕ. Возвращает построитель запросов для последующих цепочечных вызовов.

* **or_(...)** -- логическое ИЛИ. Возвращает построитель запросов для последующих цепочечных вызовов.

* **sameField(...)** -- логический оператор "в том же поле". Возвращает построитель запросов для последующих цепочечных вызовов.

* **sameRepeat(...)** -- логический оператор "в том же повторении поля". Возвращает построитель запросов для последующих цепочечных вызовов.

Пример:

.. code-block:: php

    $expression = (string) Search::equals('TJ=', 'Аврора',
        'Новый мир')->and_(Search::equals('G=', '199$', '200$'));


Поскольку вышеприведённый синтаксис довольно громоздкий, предоставляются следующие функции, значительно упрощающие формирование запроса:

============== ========================
Функция         Поиск по
============== ========================
author          автору
bbk             индексу ББК
document_kind   виду документа
keyword         ключевым словам
language        языку текста
magazine        заглавию журнала
mhr             месту хранения
number          инвентарному номеру
place           месту издания (городу)
publisher       издательству
rzn             разделу знаний
subject         предметной рубрике
title           заглавию
udc             индексу УДК
year            году издания
============== ========================

Пример применения построителя с упрощённым формированием запроса:

.. code-block:: php

    $client = new Irbis\Connection();
    $client->host = 'irbis.server';
    $client->port = 5555;
    $client->username = 'ninja';
    $client->password = 'i_am_invisible';
    $client->connect();
    $expression = Irbis\author('Пушкин$')->and_(Irbis\title('СКАЗКИ$'));
    $found = $client->searchCount($expression);
    echo "Найдено: ", $found;
    $client->disconnect();
