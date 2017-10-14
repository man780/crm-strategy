<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 18.05.2017
 * Time: 11:20
 */
use yii\helpers\Html;
use dosamigos\tinymce\TinyMce;
use yii\widgets\ActiveForm;
use kartik\slider\Slider;

/* @var $this yii\web\View */
/* @var $event app\models\Event */

$this->title = "Тадбирни мониторинг қилиш карточкаси";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$direction = $event->direction;
$sub_direction = $event->subDir;
$authority = $staff->exec;
//$financing = $event->getFinancingAmount();
?>
















<?php $form = ActiveForm::begin(['action' => ['confirmed-execution/create', 'id' => $execution->id], 'method' => 'POST']); ?>

<div class="card">
    <div class="card-content container">

        <h2 align="center"><?=$direction->title?></h2>
        <h3 align="center"><?=$sub_direction->title?></h3>
        <h3 align="center"><?=$event->event?></h3>

        <div align="right"><?=date('d.m.Y')?></div>


        <div class="row">
            <div class="col-md-4">
                Маъсул ижрочи:
            </div>
            <div class="col-md-8">
                <?=$staff->fio?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Маъсул ижрочи ташкилот:
            </div>
            <div class="col-md-8">
                <?=$authority->name?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Тел. номер:
            </div>
            <div class="col-md-8">
                <?=$staff->phones?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Эл. почта:
            </div>
            <div class="col-md-8">
                <?=$staff->emails?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Сана:
            </div>
            <div class="col-md-8">
                <?=date('d.m.Y', $execution->dcreated);?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Молиялаштириш:
            </div>
            <div class="col-md-8">
                <?
                if(count($event->financings) > 0){
                    foreach ($event->financings as $financing){
                        echo $financing->sf->name." - ";
                        echo number_format($financing->amount, 0, ',', ' ')." ";
                        echo $financing->currency0->name;
                    }
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Амалдаги ўзлаштириш:
            </div>
            <div class="col-md-8">
                <?=number_format($execution->actual_mastering_finance, 0, ',', ' ')?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Ўз вақтидаги молиявий таъминот:
            </div>
            <div class="col-md-8">
                <?=($execution->timely_financial_security==0)?'Ҳа':'Йўқ';?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Бажарилиш фоизи:
            </div>
            <div class="col-md-8">
                <?
                echo $form->field($execution, 'persentage')->widget(Slider::classname(), [
                    'pluginOptions'=>[
                        'tooltip'=>'always',
                        'min'=>0,
                        'max'=>100,
                        'step'=>1
                    ],
                ]);
                ?>
                <?//=$execution->persentage?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Бажарилиш фоизи:
            </div>
            <div class="col-md-8">
                <?=Html::dropDownList('Execution[status]', null, [1 => 'Бажарилмаган', 2 => 'Бажарилмоқда', 3 => 'Бажарилган'], ['class' => 'form-control status']);?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                Бажарилиши ҳақида маълумот:
            </div>
            <div class="col-md-10">

                <?
                echo $form->field($execution, 'execution_information')->widget(TinyMce::className(), [
                    'options' => ['rows' => 16],
                    'language' => 'ru',
                    'clientOptions' => [
                        'plugins' => [
                            "advlist autolink lists link charmap print preview anchor",
                            "searchreplace visualblocks code fullscreen",
                            "insertdatetime media table contextmenu paste"
                        ],
                        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    ]
                ]);
                ?>
                <?//=Html::textarea('execution_information');?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                Бажарилишга тўсқинлик қилаётган омиллар:
            </div>
            <div class="col-md-10">
                <?=$execution->factors_preventing_implementation?>
            </div>
        </div>

        <div class="row">
            <h3 align="center">Тадбирни ОАВда ёритилиши ҳақида маълумот</h3>
        </div>

        <div class="row">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                <tr align="center">
                    <th colspan="3" class="success">Телевиденияда ёритилиши</th>
                </tr>
                <tr>
                    <th>Эфирга чиқиш санаси</th>
                    <th>Ролик/дастурнинг номи</th>
                    <th>ОАВ номи</th>
                </tr>
                </thead>
                <tbody>
                <?foreach ($broadcasting_tvs as $key => $broadcasting_tv):?>
                    <tr>
                        <td><?=date('d.m.Y', $broadcasting_tv->date);?></td>
                        <td><?=$broadcasting_tv->title?></td>
                        <td>
                            <?$tv = $broadcasting_tv->tv?>
                            <?= $tv->name?>
                        </td>
                    </tr>
                <?endforeach;?>
                </tbody>
                <tfoot>
                <tr>
                    <td>Итого:</td>
                    <td colspan="2"><?=count($broadcasting_tvs)?></td>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="row">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                <tr align="center">
                    <th colspan="3" class="success">Радиода ёритилиши</th>
                </tr>
                <tr>
                    <th>Эфирга чиқиш санаси</th>
                    <th>Ролик/дастурнинг номи</th>
                    <th>ОАВ номи</th>
                </tr>
                </thead>
                <tbody>
                <?foreach ($broadcasting_radios as $key => $broadcasting_radio):?>
                    <tr>
                        <td><?=date('d.m.Y', $broadcasting_radio->date);?></td>
                        <td><?=$broadcasting_radio->title?></td>
                        <td>
                            <?$radio = $broadcasting_radio->radio?>
                            <?=$radio->name?>
                        </td>
                    </tr>
                <?endforeach;?>
                </tbody>
                <tfoot>
                <tr>
                    <td>Итого:</td>
                    <td colspan="2"><?=count($broadcasting_radios)?></td>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="row">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                <tr align="center">
                    <th colspan="4" class="success">Прессада ёритилиши</th>
                </tr>
                <tr>
                    <th>Чоп этилган сана</th>
                    <th>Газета/Журнал сони №</th>
                    <th>Мақола сарлавҳаси</th>
                    <th>ОАВ номи</th>
                </tr>
                </thead>
                <tbody>
                <?foreach ($broadcasting_presss as $key => $broadcasting_press):?>
                    <tr>
                        <td><?=date('d.m.Y', $broadcasting_press->date);?></td>
                        <td><?=$broadcasting_press->num?></td>
                        <td><?=$broadcasting_press->title?></td>
                        <td>
                            <?$press = $broadcasting_press->press?>
                            <?=$press->name?>
                        </td>
                    </tr>
                <?endforeach;?>
                </tbody>
                <tfoot>
                <tr>
                    <td>Итого:</td>
                    <td colspan="3"><?=count($broadcasting_presss)?></td>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="row">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                <tr align="center">
                    <th colspan="4" class="success">Интернетда ёритилиши</th>
                </tr>
                <tr>
                    <th>Чоп этилган сана</th>
                    <th>Мақола гиперлавхаси(Ссылка)</th>
                    <th>Мақола сарлавҳаси</th>
                    <th>ОАВ номи</th>
                </tr>
                </thead>
                <tbody>
                <?foreach ($broadcasting_internets as $key => $broadcasting_internet):?>
                    <tr>
                        <td><?=date('d.m.Y', $broadcasting_internet->date);?></td>
                        <td><?=$broadcasting_internet->link?></td>
                        <td><?=$broadcasting_internet->title?></td>
                        <td>
                            <?$internet = $broadcasting_internet->internet?>
                            <?=$internet->name?>
                        </td>
                    </tr>
                <?endforeach;?>
                </tbody>
                <tfoot>
                <tr>
                    <td>Итого:</td>
                    <td colspan="3"><?=count($broadcasting_internets);?></td>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="row">
            <?
            echo $form->field($model, 'note')->widget(TinyMce::className(), [
                'options' => ['rows' => 16],
                'language' => 'ru',
                'clientOptions' => [
                    'plugins' => [
                        "advlist autolink lists link charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table contextmenu paste"
                    ],
                    'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                ]
            ]);
            ?>
        </div>
        <?= Html::submitButton(Yii::t('app', 'Confirm'), ['class' =>'btn btn-success' ]) ?>
        <?/*=Html::a(Yii::t('app', 'Confirm'), \yii\helpers\Url::toRoute(['confirmed-execution/create', 'id'=>$event->id]), ['class' => 'btn btn-success'])*/?>
        <?=Html::a('Орқага', \yii\helpers\Url::toRoute(['event/view', 'id'=>$event->id]), ['class' => 'btn btn-danger'])?>
    </div>
</div>
<?php ActiveForm::end(); ?>
