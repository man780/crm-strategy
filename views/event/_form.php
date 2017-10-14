<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use \kartik\select2\Select2;

use app\models\Direction;
use app\models\SubDirection;
use app\models\SourceFinancing;
use app\models\Financing;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */

$script = <<< JS
    $('.add-finance').click(function(){
        var finance = $('.finance:first').clone();
        $('.finance-list').append(finance);
    });
    $('.remove-finance').click(function(){
        if($('.finance').length > 1)
        $('.finance:last').remove();
    });
    
    $('.add-executor').click(function(){
        var executor = $('.executor:last').clone();
        //console.log(executor.find('.executorAuthorities'));
        num = $('.executor').length;
        executor.find('.executorAuthorities').attr('id', 'w'+num);
        $('.executor-list').append(executor);
    });
    $('.remove-executor').click(function(){
        if($('.executor').length > 1)
        $('.executor:last').remove();
    });
JS;
$this->registerJs($script);
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?
    $directions = Direction::find()->all();
    $items = ArrayHelper::map($directions,'id','title');
    $params = [
        'prompt' => 'Укажите направления'
    ];
    echo $form->field($model, 'direction_id')->dropDownList($items,$params);?>

    <?
    $sub_directions = SubDirection::find()->all();
    $items = ArrayHelper::map($sub_directions,'id','title');
    $params = [
        'prompt' => 'Укажите под направления'
    ];
    echo $form->field($model, 'sub_dir_id')->dropDownList($items,$params);?>

    <?= $form->field($model, 'event')->textarea(['rows' => 6]) ?>
    <div class="container  executor-list">
        <?if(!$model->isNewRecord):?>
            <?foreach ($executors as $executor):?>
                <div class="row executor">
                    <?=Html::label('Ижро учун масъуллар', 'sourceFinancing')?>
                    <?
                    $items = $model->getExecutorsAll();
                    echo Html::dropDownList('executorAuthorities[]', $executor['executor_authority_id'], $items, ['class'=>'form-control']);
                    ?>
                </div>
            <?endforeach;?>
        <?else:?>
            <div class="row executor">
                <?=Html::label('Ижро учун масъуллар', 'sourceFinancing')?>
                <?
                $items = $model->getExecutorsAll();
                echo Html::dropDownList('executorAuthorities[]', '', $items, ['class'=>'form-control', 'prompt'=>'']);
                ?>
            </div>
        <?endif;?>
    </div>
    <div class="container row">
        <a href="javascript:void(0);" class="btn btn-success add-executor">+</a>
        <a href="javascript:void(0);" class="btn btn-danger remove-executor">-</a>
    </div>

    <?/*= $form->field($model, 'executorAuthorities')->widget(Select2::className(), [
        'name' => 'executorAuthorities',
        'data' => $model->getExecutorsAll(),
        'options' => [
            'multiple' => true
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    */?>

    <hr>
    <div class="form-group financing">
        <h2>Молиялаштириш</h2>

        <div class="finance-list container">
        <?if($model->isNewRecord || empty($financing)):?>
            <div class="row finance">
                <div class="col-md-4">
                    <?=Html::label('Молиялаштириш манбаси', 'sourceFinancing')?>
                    <?
                    $source_financing = SourceFinancing::find()->all();
                    // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
                    $items = ArrayHelper::map($source_financing, 'id','name');
                    $params = [
                        'prompt' => 'Молиялаштириш манбаси'
                    ];
                    echo Html::dropDownList('sourceFinancing[]', $finance['sf_id'], $items, ['class'=>'form-control', 'prompt'=>'']);
                    ?>
                </div>

                <div class="col-md-4">
                    <?= Html::label('Молиялаштириш миқдори', 'amount');?>
                    <?= Html::input('text', 'amount[]', $finance['amount'], ['class' => 'form-control']);?>
                </div>

                <div class="col-md-2">
                    <?= Html::label('Валюта', 'currency');?>
                    <?
                    $currency = \app\models\Currency::find()->all();
                    // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
                    $items = ArrayHelper::map($currency, 'id','name');
                    $params = [
                        'prompt' => 'Валюта'
                    ];
                    echo Html::dropDownList('currency[]', $finance['currency'], $items, ['class'=>'form-control', 'prompt'=>'']);
                    ?>
                </div>

                <hr>
            </div>
        <?else:foreach ($financing as $finance):?>
            <div class="row finance">
                <div class="col-md-4">
                <?=Html::label('Молиялаштириш манбаси', 'sourceFinancing')?>
                <?
                    $source_financing = SourceFinancing::find()->all();
                    // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
                    $items = ArrayHelper::map($source_financing, 'id','name');
                    $params = [
                        'prompt' => 'Молиялаштириш манбаси'
                    ];
                    echo Html::dropDownList('sourceFinancing[]', $finance['sf_id']/*$sourceFinancingValue*/, $items, ['class'=>'form-control']);
                ?>
                </div>

                <div class="col-md-4">
                    <?= Html::label('Молиялаштириш миқдори', 'amount');?>
                    <?= Html::input('text', 'amount[]', $finance['amount'], ['class' => 'form-control']);?>
                </div>

                <div class="col-md-2">
                    <?= Html::label('Валюта', 'currency');?>
                    <?
                    $currency = \app\models\Currency::find()->all();
                    // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
                    $items = ArrayHelper::map($currency, 'id','name');
                    $params = [
                        'prompt' => 'Валюта'
                    ];
                    echo Html::dropDownList('currency[]', $finance['currency'], $items, ['class'=>'form-control']);
                    ?>
                </div>

                <hr>
            </div>
            <?endforeach;?>
        <?endif;?>
        </div>
        <a href="javascript:void(0);" class="btn btn-success add-finance">+</a>
        <a href="javascript:void(0);" class="btn btn-danger remove-finance">-</a>
    </div>


    <div class="form-group">
    <?=$form->field($model, 'deadline')->widget(\yii\jui\DatePicker::className(), [
            'model' => $model,
            'attribute' => 'deadline',
            'language' => 'ru',
            'dateFormat' => 'dd.MM.yyyy',
        ]) ?>
    </div>
    <?//= $form->field($model, 'deadline')->textInput() ?>

    <?= $form->field($model, 'deadline_other')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'mechanism')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
