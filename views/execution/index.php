<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExecutionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Executions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="execution-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Execution'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'exec_id',
            'exec_staff_id',
            'direction_id',
            'sub_dir_id',
            // 'event_id',
            // 'actual_mastering_finance',
            // 'timely_financial_security:datetime',
            // 'persentage',
            // 'execution_information:ntext',
            // 'factors_preventing_implementation:ntext',
            // 'bycreated',
            // 'dcreated',
            // 'bydeleted',
            // 'ddeleted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
