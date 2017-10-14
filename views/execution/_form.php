<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\Direction;
use app\models\SubDirection;

/* @var $this yii\web\View */
/* @var $model app\models\Execution */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="execution-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'exec_id')->textInput() ?>

    <?= $form->field($model, 'exec_staff_id')->textInput() ?>

    <?//= $form->field($model, 'direction_id')->textInput() ?>
    <?
    $directions = Direction::find()->all();
    $items = ArrayHelper::map($directions,'id','title');
    $params = [
        'prompt' => 'Укажите направления'
    ];
    echo $form->field($model, 'direction_id')->dropDownList($items,$params);?>

    <?//= $form->field($model, 'sub_dir_id')->textInput() ?>
    <?
    $sub_directions = SubDirection::find()->all();
    $items = ArrayHelper::map($sub_directions,'id','title');
    $params = [
        'prompt' => 'Укажите под направления'
    ];
    echo $form->field($model, 'sub_dir_id')->dropDownList($items,$params);?>

    <?= $form->field($model, 'event_id')->textInput() ?>

    <?= $form->field($model, 'actual_mastering_finance')->textInput() ?>

    <?= $form->field($model, 'timely_financial_security')->textInput() ?>

    <?= $form->field($model, 'persentage')->textInput() ?>

    <?= $form->field($model, 'execution_information')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'factors_preventing_implementation')->textarea(['rows' => 6]) ?>

    <?/*= $form->field($model, 'bycreated')->textInput() */?><!--

    <?/*= $form->field($model, 'dcreated')->textInput() */?>

    <?/*= $form->field($model, 'bydeleted')->textInput() */?>

    --><?/*= $form->field($model, 'ddeleted')->textInput() */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
