<head>
    <meta charset="UTF-8"/>
    <title>Построение глобальной корректировки</title>
</head>

<?php

require_once __DIR__ . '/../Source/Nerpa.php';
require_once __DIR__ . '/../Source/Gbl.php';

//
// Данный пример демонстрирует построение глобальной корректировки.
//

$gbl = new Nerpa\Gbl();
$gbl->parameter('mhr.mnu', 'Укажите место хранения')
->comment('Это комментарий в начале')
->newMfn("'TEST'",
        (new Nerpa\Gbl())->add(700, "'^AἈριστοτέλης'")
        ->add(200, "'^Aアリストテレス'")
        ->add(300, "'Пробная запись'")
        ->add(920, "'PAZK'")
    )
->comment('Это комментарий в конце');

echo '<pre>', $gbl, '</pre>';