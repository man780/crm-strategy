<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExecutorStaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Executor Staff');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="executor-staff-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Executor Staff'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            //'exec_id',
            [
                'attribute' => 'exec_id',
                'value' => 'exec.name',
                'filter' => \app\models\ExecutorAuthority::getAutoritiesMap(),
            ],
            'fio',
            'details:ntext',
            'phones',
            'emails:email',
            'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
