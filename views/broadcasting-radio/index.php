<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use app\models\Event;
use app\models\Radio;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BroadcastingRadioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Broadcasting Radios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="broadcasting-radio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Broadcasting Radio'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            /*'event_id',
            'radio_id',*/
            [
                'attribute' => 'event_id',
                'value' => 'event.event',
                'filter' => ArrayHelper::map(Event::find()->asArray()->all(), 'id', 'event'),
            ],
            [
                'attribute' => 'radio_id',
                'value' => 'radio.name',
                'filter' => ArrayHelper::map(Radio::find()->asArray()->all(), 'id', 'name'),
            ],
            'date:date',
            'title',
            // 'details:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
