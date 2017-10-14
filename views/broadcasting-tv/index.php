<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use app\models\Event;
use app\models\Tv;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BroadcastingTvSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Broadcasting Tvs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="broadcasting-tv-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Broadcasting Tv'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            /*'event_id',
            'tv_id',*/
            [
                'attribute' => 'event_id',
                'value' => 'event.event',
                'filter' => ArrayHelper::map(Event::find()->asArray()->all(), 'id', 'event'),
            ],
            [
                'attribute' => 'tv_id',
                'value' => 'tv.name',
                'filter' => ArrayHelper::map(Tv::find()->asArray()->all(), 'id', 'name'),
            ],
            'date:date',
            'title',
            // 'body:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
