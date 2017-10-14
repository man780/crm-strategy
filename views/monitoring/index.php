<?php
/* @var $this yii\web\View */
use miloschuman\highcharts\Highcharts;
?>

<h1>Monitoring</h1>

<p>
    <?
    echo Highcharts::widget([
        'options'=>'{
            chart: {
                type: \'pie\'
            },
            "title": { "text": "Fruit Consumption" },
            "xAxis": {
             "categories": ["Apples", "Bananas", "Oranges"]
            },
            "yAxis": {
             "title": { "text": "Fruit eaten" }
            },
            "series": [
             { "name": "Jane", "data": [1, 0, 4] },
             { "name": "John", "data": [5, 7,3] }
            ]
        }'
    ]);
    ?>
</p>
