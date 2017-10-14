<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use app\models\Direction;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SubDirectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sub Directions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-direction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sub Direction'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'direction_id',
                'value' => 'direction.title',
                'filter' => ArrayHelper::map(Direction::find()->asArray()->all(), 'id', 'title'),
            ],
            'num',
            'title',
            //'body:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
