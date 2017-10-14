<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use app\models\Event;
use app\models\Internet;


/* @var $this yii\web\View */
/* @var $searchModel app\models\BroadcastingInternetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Broadcasting Internets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="broadcasting-internet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Broadcasting Internet'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'event_id',
                'value' => 'event.event',
                'filter' => ArrayHelper::map(Event::find()->asArray()->all(), 'id', 'event'),
            ],
            [
                'attribute' => 'internet_id',
                'value' => 'internet.name',
                'filter' => ArrayHelper::map(Internet::find()->asArray()->all(), 'id', 'name'),
            ],
            'date:date',
            'title',
            // 'details:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
