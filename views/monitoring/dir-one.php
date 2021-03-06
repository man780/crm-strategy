<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22.05.2017
 * Time: 10:52
 */
use miloschuman\highcharts\Highcharts;
?>

    <h3 align="center">2017-2021 йилларда Ўзбекистон Республикасини ривожлантиришнинг бешта устувор йўналиши бўйича Ҳаракатлар стратегиясини<br>
        "Халқ билан мулоқот ва инсон манфаатлари йили"да амалга оширишга оид Давлат дастури доирасида 2017 йилда кўриладиган тадбирлар тўғрисида<br>
        МАЪЛУМОТ</h3>
<?
echo Highcharts::widget([
    'options' => [
        'title' => ['text' => 'I. ДАВЛАТ ВА ЖАМИЯТ ҚУРИЛИШИ ТИЗИМИНИ ТАКОМИЛЛАШТИРИШНИНГ УСТУВОР ЙЎНАЛИШЛАРИ'],
        'plotOptions' => [
            'pie' => [
                'cursor' => 'pointer',
            ],
        ],
        'series' => [
            [ // new opening bracket
                'type' => 'pie',
                'name' => 'Elements',
                'data' => [
                    ['Ўзбекистон Республикаси Қонуни лойиҳалари', 17],
                    ['Ўзбекистон Республикаси Президенти Фармони лойиҳалари', 4],
                    ['Ўзбекистон Республикаси Президенти Қарори лойиҳалари', 2],
                    ['Ўзбекистон Республикаси Вазирлар Маҳкамаси қарори лойиҳалари', 6],
                    ['Идоравий хужжат (норматив хуқуқий хужжатлар) лойиҳалари', 6],
                    ['Концепция ва стратегиялар  лойиҳалари', 1],
                    ['Комплекс чора-тадбирлар, Чора-тадбирлар, Дастурлар (тармоқ дастурлари), Йўл ҳариталари', 15],
                    ['Лойиҳаларни амалга ошириш, тегишли қарорлар ижросини таъминлаш', 1],
                    ['Таҳлилий маълумотномалар ва таклифлар', 1],
                ],
            ] // new closing bracket
        ],
    ],
]);
?>

<h4>Жами: 53 та</h4>
