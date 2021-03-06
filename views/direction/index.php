<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Direction;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DirectionSearchDirection */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Directions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="direction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', ['modelClass' => Yii::t('app', 'Direction')]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'image',
            'color',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
