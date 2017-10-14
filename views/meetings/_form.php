<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\datetime\DateTimePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Meetings */
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

<div class="meetings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'place')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?
        echo DateTimePicker::widget([
            'name' => 'time',
            'options' => ['placeholder' => 'Выберите время ...'],
            'convertFormat' => true,
            'value' => date('d.m.Y H:i A', $model->time),
            'pluginOptions' => [
                'format' => 'd-M-yyyy H:i A',
                'startDate' => '01.10.2017 12:00 AM',
                'todayHighlight' => true
            ]
        ]);
        ?>
    </div>

    <?
    $items = [
        1 => 'Переговоры',
        2 => 'Большые мероприятия',
        3 => 'Мероприятия без наших',
        4 => 'за пределами',
    ];
    $params = [
        'prompt' => 'Укажите тип мероприятия'
    ];
    echo $form->field($model, 'type')->dropDownList($items,$params);?>

    <div class="container  executor-list">
        <?if(!$model->isNewRecord):?>
            <?$staff = $model->staff;?>
            <?if(count($staff)>0):?>
            <?foreach ($staff as $employee):?>
                <div class="row executor">
                    <?=Html::label('Ҳодимлар', 'staff')?>
                    <?
                    $items = $model->getStaffAll();
                    echo Html::dropDownList('staff[]', $employee['id'], $items, ['class'=>'form-control']);
                    ?>
                </div>
            <?endforeach;?>
            <?else:?>
                <div class="row executor">
                    <?=Html::label('Ҳодимлар', 'staff')?>
                    <?
                    $items = $model->getStaffAll();
                    echo Html::dropDownList('staff[]', '', $items, ['class'=>'form-control', 'prompt'=>'']);
                    ?>
                </div>
            <?endif;?>
        <?else:?>
            <div class="row executor">
                <?=Html::label('Ҳодимлар', 'staff')?>
                <?
                $items = $model->getStaffAll();
                echo Html::dropDownList('staff[]', '', $items, ['class'=>'form-control', 'prompt'=>'']);
                ?>
            </div>
        <?endif;?>

    </div>
    <Br>
    <div class="container row">
        <a href="javascript:void(0);" class="btn btn-success add-executor">+</a>
        <a href="javascript:void(0);" class="btn btn-danger remove-executor">-</a>
    </div>
    <br>

    <div class="container  finance-list">
        <?if(!$model->isNewRecord):?>
            <?$guests = $model->meetingGuests;?>
            <?if(count($guests)>0):?>
            <?foreach ($guests as $guest):?>
                <div class="row finance">
                    <?=Html::label('Меҳмонлар', 'meeting_guests')?>
                    <?
                    $items = $model->getGuestsAll();
                    echo Html::dropDownList('meeting_guests[]', $guest['id'], $items, ['class'=>'form-control']);
                    ?>
                </div>
            <?endforeach;?>
            <?else:?>
            <div class="row finance">
                <?=Html::label('Меҳмонлар', 'meeting_guests')?>
                <?
                $items = $model->getGuestsAll();
                echo Html::dropDownList('meeting_guests[]', '', $items, ['class'=>'form-control', 'prompt'=>'']);
                ?>
            </div>
            <?endif;?>
        <?else:?>
            <div class="row finance">
                <?=Html::label('Меҳмонлар', 'meeting_guests')?>
                <?
                $items = $model->getGuestsAll();
                echo Html::dropDownList('meeting_guests[]', '', $items, ['class'=>'form-control', 'prompt'=>'']);
                ?>
            </div>
        <?endif;?>

    </div>
    <Br>
    <div class="container row">
        <a href="javascript:void(0);" class="btn btn-success add-finance">+</a>
        <a href="javascript:void(0);" class="btn btn-danger remove-finance">-</a>
    </div>
    <br>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
