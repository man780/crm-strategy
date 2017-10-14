<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SubEventSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-event-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'event_id') ?>

    <?= $form->field($model, 'direction_id') ?>

    <?= $form->field($model, 'sub_dir_id') ?>

    <?= $form->field($model, 'event') ?>

    <?php // echo $form->field($model, 'mechanism') ?>

    <?php // echo $form->field($model, 'details') ?>

    <?php // echo $form->field($model, 'deadline') ?>

    <?php // echo $form->field($model, 'deadline_other') ?>

    <?php // echo $form->field($model, 'percentage') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
