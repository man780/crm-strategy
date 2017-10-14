<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Execution */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Executions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="execution-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'exec_id',
            'exec_staff_id',
            'direction_id',
            'sub_dir_id',
            'event_id',
            'actual_mastering_finance',
            'timely_financial_security:datetime',
            'persentage',
            'execution_information:ntext',
            'factors_preventing_implementation:ntext',
            'bycreated',
            'dcreated',
            'bydeleted',
            'ddeleted',
        ],
    ]) ?>

</div>
