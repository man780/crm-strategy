<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use app\models\Event;
use app\models\Press;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BroadcastingPressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Broadcasting Presses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="broadcasting-press-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Broadcasting Press'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'press_id',
                'value' => 'press.name',
                'filter' => ArrayHelper::map(Press::find()->asArray()->all(), 'id', 'name'),
            ],
            'date:date',
            'title',
            // 'details:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
