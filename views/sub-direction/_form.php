<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\Direction;

/* @var $this yii\web\View */
/* @var $model app\models\SubDirection */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-direction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'direction_id')->textInput() ?>
    <?// получаем всех авторов
    $directions = Direction::find()->all();
    // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
    $items = ArrayHelper::map($directions,'id','title');
    $params = [
        'prompt' => 'Укажите направления'
    ];
    echo $form->field($model, 'direction_id')->dropDownList($items,$params);?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
