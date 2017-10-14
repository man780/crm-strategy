<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExecutionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="execution-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'exec_id') ?>

    <?= $form->field($model, 'exec_staff_id') ?>

    <?= $form->field($model, 'direction_id') ?>

    <?= $form->field($model, 'sub_dir_id') ?>

    <?php // echo $form->field($model, 'event_id') ?>

    <?php // echo $form->field($model, 'actual_mastering_finance') ?>

    <?php // echo $form->field($model, 'timely_financial_security') ?>

    <?php // echo $form->field($model, 'persentage') ?>

    <?php // echo $form->field($model, 'execution_information') ?>

    <?php // echo $form->field($model, 'factors_preventing_implementation') ?>

    <?php // echo $form->field($model, 'bycreated') ?>

    <?php // echo $form->field($model, 'dcreated') ?>

    <?php // echo $form->field($model, 'bydeleted') ?>

    <?php // echo $form->field($model, 'ddeleted') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
