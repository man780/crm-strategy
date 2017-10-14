<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 18.05.2017
 * Time: 11:20
 */
use yii\helpers\Html;
use dosamigos\tinymce\TinyMce;
//use yii\bootstrap\Progress;
use kartik\slider\Slider;
use \yii\jui\DatePicker;

use app\models\Direction;
use app\models\SubDirection;
use app\models\SourceFinancing;
/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = "Тадбирни мониторинг қилиш карточкаси";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$direction = $model->direction;
$sub_direction = $model->subDir;
$financing = $model->financings;

$script = <<< JS
    $('.btn-add-tv').click(function(){
        var date = $('.tv-date').val();
        var name = $('.tv-name').val();
        var tv = $('.tv-channel').val();
        var tv_channel = $('.tv-channel option:selected').text();
        $('.table-tv tbody').append('<tr><td class="date">'+date+'</td><td class="name">'+name+'</td><td class="tv" data-id="'+tv+'">'+tv_channel+'</td></tr>');
        tv_arr = [];
        $('.table-tv tbody tr').each(function() {
            var date = $(this).find('td.date').html();
            var name = $(this).find('td.name').html();
            var tv = $(this).find('td.tv').attr('data-id');
            tv_arr.push([date, name, tv]);
        });
        $('.Broadcasting-tv').val(JSON.stringify(tv_arr));
        //console.log();
    });    
    $('.btn-remove-tv').click(function(){
        $('.table-tv tbody tr:last').remove();
        tv_arr = [];
        $('.table-tv tbody tr').each(function() {
            var date = $(this).find('td.date').html();
            var name = $(this).find('td.name').html();
            var tv = $(this).find('td.tv').attr('data-id');
            tv_arr.push([date, name, tv]);
        });
        $('.Broadcasting-tv').val(JSON.stringify(tv_arr));
    });
    
    $('.btn-add-radio').click(function(){
        var date = $('.radio-date').val();
        var name = $('.radio-name').val();
        var radio = $('.radio-channel').val();
        var radio_channel = $('.radio-channel option:selected').text();
        $('.table-radio tbody').append('<tr><td class="date">'+date+'</td><td class="name">'+name+'</td><td class="radio" data-id="'+radio+'">'+radio_channel+'</td></tr>');
        radio_arr = [];
        $('.table-radio tbody tr').each(function() {
            var date = $(this).find('td.date').html();
            var name = $(this).find('td.name').html();
            var radio = $(this).find('td.radio').attr('data-id');
            radio_arr.push([date, name, radio]);
        });
        $('.Broadcasting-radio').val(JSON.stringify(radio_arr));
    });    
    $('.btn-remove-radio').click(function(){
        $('.table-radio tbody tr:last').remove();
        radio_arr = [];
        $('.table-radio tbody tr').each(function() {
            var date = $(this).find('td.date').html();
            var name = $(this).find('td.name').html();
            var radio = $(this).find('td.radio').attr('data-id');
            radio_arr.push([date, name, radio]);
        });
        $('.Broadcasting-radio').val(JSON.stringify(radio_arr));
    });
    
    $('.btn-add-press').click(function(){
        var date = $('.press-date').val();
        var num = $('.press-num').val();
        var name = $('.press-name').val();
        var press = $('.press-channel').val();
        var press_channel = $('.press-channel option:selected').text();
        $('.table-press tbody').append('<tr><td class="date">'+date+'</td><td class="num">'+num+'</td><td class="name">'+name+'</td><td class="press" data-id="'+press+'">'+press_channel+'</td></tr>');
        press_arr = [];
        $('.table-press tbody tr').each(function() {
            var date = $(this).find('td.date').html();
            var num = $(this).find('td.num').html();
            var name = $(this).find('td.name').html();
            var press = $(this).find('td.press').attr('data-id');
            press_arr.push([date, num, name, press]);
        });
        $('.Broadcasting-press').val(JSON.stringify(press_arr));
    });    
    $('.btn-remove-press').click(function(){
        $('.table-press tbody tr:last').remove();
        press_arr = [];
        $('.table-press tbody tr').each(function() {
            var date = $(this).find('td.date').html();
            var num = $(this).find('td.num').html();
            var name = $(this).find('td.name').html();
            var press = $(this).find('td.press').attr('data-id');
            press_arr.push([date, num, name, press]);
        });
        $('.Broadcasting-press').val(JSON.stringify(press_arr));
    });
    
    $('.btn-add-internet').click(function(){
        var date = $('.internet-date').val();
        var link = $('.internet-link').val();
        var name = $('.internet-name').val();
        var internet = $('.internet-channel').val();
        var internet_channel = $('.internet-channel option:selected').text();
        $('.table-internet tbody').append('<tr><td class="date">'+date+'</td><td class="link">'+link+'</td><td class="name">'+name+'</td><td class="internet" data-id="'+internet+'">'+internet_channel+'</td></tr>');
        internet_arr = [];
        $('.table-internet tbody tr').each(function() {
            var date = $(this).find('td.date').html();
            var link = $(this).find('td.link').html();
            var name = $(this).find('td.name').html();
            var internet = $(this).find('td.internet').attr('data-id');
            internet_arr.push([date, link, name, internet]);
        });
        $('.Broadcasting-internet').val(JSON.stringify(internet_arr));
    });    
    $('.btn-remove-internet').click(function(){
        $('.table-internet tbody tr:last').remove();
        internet_arr = [];
        $('.table-internet tbody tr').each(function() {
            var date = $(this).find('td.date').html();
            var link = $(this).find('td.link').html();
            var name = $(this).find('td.name').html();
            var internet = $(this).find('td.internet').attr('data-id');
            internet_arr.push([date, link, name, internet]);
        });
        $('.Broadcasting-internet').val(JSON.stringify(internet_arr));
    });
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY);

?>
<div class="card">
    <div class="card-content container">

        <?=Html::beginForm('execution?id='.$model->id, 'POST')?>
        <h2 align="center"><?=$direction->title?></h2>
        <h3 align="center"><?=$sub_direction->title?></h3>
        <h3 align="center"><?=$model->event?></h3>

        <div align="right"><?=date('d.m.Y')?></div>

        <div class="row">
            <div class="col-md-3">
                Маъсул ижрочи:
            </div>
            <div class="col-md-8">
                <?=$staff->fio?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                Маъсул ижрочи ташкилот:
            </div>
            <div class="col-md-8">
                <?=$authority->name?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                Тел. номер:
            </div>
            <div class="col-md-8">
                <?=$staff->phones?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                Эл. почта:
            </div>
            <div class="col-md-8">
                <?=$staff->emails?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                Сана:
            </div>
            <div class="col-md-8">
                <?=date('d.m.Y');?>
            </div>
        </div>
        <?if($financing):?>
        <div class="row">
            <div class="col-md-3">
                Молиялаштириш:
            </div>
            <div class="col-md-8">
                <?
                if(count($model->financings) > 0){
                    foreach ($model->financings as $financing){
                        echo $financing->sf->name . ' - ' . number_format($financing->amount, 0, ',', ' ') . ' ' . $financing->currency0->name;
                    }
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                Амалдаги ўзлаштириш:
            </div>
            <div class="col-md-9">
                <?=Html::input('text', 'Financing[actual_mastering_finance]', '', ['class' => 'form-control']);?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                Ўз вақтидаги молиявий таъминот:
            </div>
            <div class="col-md-9">
                <?=Html::radioList('Financing[timely_financial_security]', ['da', 'net'], ['Ҳа', 'Йўқ'], ['class' => 'form-control']);?>
            </div>
        </div>
        <?endif;?>
        <div class="row">
            <div class="col-md-3">
                Бажарилиш ҳолати:
            </div>
            <div class="col-md-9">
                <?
                /*echo Slider::widget([
                    'name'=>'Execution[persentage]',
                    'sliderColor'=>Slider::TYPE_PRIMARY,
                    'options' => ['class' => 'form-control'],
                    'handleColor'=>Slider::TYPE_INFO,
                    'pluginOptions'=>[
                        'tooltip'=>'always',
                        'min'=>0,
                        'max'=>100,
                        'step'=>1
                    ],
                    'pluginEvents' => [
                        "slide" => "function(e) { $('.persentage').val(e.value); }",
                    ],
                ]);*/
                ?>
                <?=Html::dropDownList('Execution[persentage]', null, [range(1,100)], ['class' => 'form-control persentage']);?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                Бажарилиши ҳақида маълумот:
            </div>
            <div class="col-md-10">
                <?=TinyMce::widget([
                    'name' => 'Execution[execution_information]',
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
                ])?>
                <?//=Html::textarea('execution_information');?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                Бажарилишга тўсқинлик қилаётган омиллар:
            </div>
            <div class="col-md-10">
                <?=TinyMce::widget([
                    'name' => 'Execution[factors_preventing_implementation]',
                    'options' => ['rows' => 6],
                    'language' => 'ru',
                    'clientOptions' => [
                        'plugins' => [
                            "advlist autolink lists link charmap print preview anchor",
                            "searchreplace visualblocks code fullscreen",
                            "insertdatetime media table contextmenu paste"
                        ],
                        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    ]
                ])?>
                <?//=Html::textarea('factors_preventing_implementation', '', ['class' => 'form-control'] );?>
            </div>
        </div>

        <div class="row">
            <h3 align="center">Тадбирларнинг ОАВда ёритилиши ҳақида маълумот</h3>
        </div>

        <div class="row">
            <table class="table table-striped table-bordered table-hover table-condensed table-tv">
                <thead>
                    <tr align="center">
                        <th colspan="3" class="bg-primary">Телевидениеда ёритилиши</th>
                    </tr>
                    <tr>
                        <th>Эфирга чиқиш санаси</th>
                        <th>Ролик/дастурнинг номи</th>
                        <th>Телеканал</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <?=Html::input('hidden', 'Broadcasting_tv', null, ['class' => 'Broadcasting-tv']);?>
                    <tr>
                        <td>
                            <?=DatePicker::widget([
                                'name'  => '',
                                'value'  => date('d.m.Y'),
                                'language' => 'ru',
                                'dateFormat' => 'dd.MM.yyyy',
                                'options' => ['class' => 'form-control tv-date']
                            ])?>
                        </td>
                        <td><?=Html::input('text', '', null,['class' => 'form-control tv-name'])?></td>
                        <td><?=Html::dropDownList('', null, $tvs, ['class' => 'form-control tv-channel'])?></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center">
                            <?=Html::a('Қўшиш', null, ['class'=> 'btn btn-primary btn-add-tv'])?>
                            <?=Html::a('Охиргисини олиб ташлаш', null, ['class'=> 'btn btn-danger btn-remove-tv'])?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row">
            <table class="table table-striped table-bordered table-hover table-condensed table-radio">
                <thead>
                    <tr align="center">
                        <th colspan="3" class="bg-primary">Радиода ёритилиши</th>
                    </tr>
                    <tr>
                        <th>Эфирга чиқиш санаси</th>
                        <th>Ролик/дастурнинг номи</th>
                        <th>Радио</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <?=Html::input('hidden', 'Broadcasting_radio', null, ['class' => 'Broadcasting-radio']);?>
                    <tr>
                        <td>
                            <?=DatePicker::widget([
                                'name'  => '',
                                'value'  => date('d.m.Y'),
                                'language' => 'ru',
                                'dateFormat' => 'dd.MM.yyyy',
                                'options' => ['class' => 'form-control radio-date']
                            ])?>
                        </td>
                        <td><?=Html::input('text', '', null,['class' => 'form-control radio-name'])?></td>
                        <td><?=Html::dropDownList('', null, $radios, ['class' => 'form-control radio-channel'])?></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center">
                            <?=Html::a('Қўшиш', null, ['class'=> 'btn btn-primary btn-add-radio'])?>
                            <?=Html::a('Охиргисини олиб ташлаш', null, ['class'=> 'btn btn-danger btn-remove-radio'])?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row">
            <table class="table table-striped table-bordered table-hover table-condensed table-press">
                <thead>
                <tr align="center">
                    <th colspan="4" class="bg-primary">Матбуотда ёритилиши</th>
                </tr>
                <tr>
                    <th>Чоп этилган сана</th>
                    <th>Мақола номи</th>
                    <th>Газета/Журнал сони №</th>
                    <th>Матбуот</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <?=Html::input('hidden', 'Broadcasting_press', null, ['class' => 'Broadcasting-press']);?>
                    <tr>
                        <td>
                            <?=DatePicker::widget([
                                'name'  => '',
                                'value'  => date('d.m.Y'),
                                'language' => 'ru',
                                'dateFormat' => 'dd.MM.yyyy',
                                'options' => ['class' => 'form-control press-date']
                            ])?>
                        </td>
                        <td><?=Html::input('text', '', null,['class' => 'form-control press-name'])?></td>
                        <td><?=Html::input('text', '', null,['class' => 'form-control press-num'])?></td>
                        <td><?=Html::dropDownList('', null, $presss, ['class' => 'form-control press-channel'])?></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center">
                            <?=Html::a('Қўшиш', null, ['class'=> 'btn btn-primary btn-add-press'])?>
                            <?=Html::a('Охиргисини олиб ташлаш', null, ['class'=> 'btn btn-danger btn-remove-press'])?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row">
            <table class="table table-striped table-bordered table-hover table-condensed table-internet">
                <thead>
                <tr align="center">
                    <th colspan="4" class="bg-primary">Интернетда ёритилиши</th>
                </tr>
                <tr>
                    <th>Чоп этилган сана</th>
                    <th>Мақола гиперлавхаси(Ссылка)</th>
                    <th>Мақола номи</th>
                    <th>Сайт</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <?=Html::input('hidden', 'Broadcasting_internet', null, ['class' => 'Broadcasting-internet']);?>
                    <tr>
                        <td>
                            <?=DatePicker::widget([
                                'name'  => '',
                                'value'  => date('d.m.Y'),
                                'language' => 'ru',
                                'dateFormat' => 'dd.MM.yyyy',
                                'options' => ['class' => 'form-control internet-date']
                            ])?>
                        </td>
                        <td><?=Html::input('text', '', null,['class' => 'form-control internet-link'])?></td>
                        <td><?=Html::input('text', '', null,['class' => 'form-control internet-name'])?></td>
                        <td><?=Html::dropDownList('', null, $internets, ['class' => 'form-control internet-channel'])?></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center">
                            <?=Html::a('Қўшиш', null, ['class'=> 'btn btn-primary btn-add-internet'])?>
                            <?=Html::a('Охиргисини олиб ташлаш', null, ['class'=> 'btn btn-danger btn-remove-internet'])?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <?=Html::submitButton('Қўшиш', ['class' => 'btn btn-lg btn-primary']);?>
        <?=Html::a('Орқага', \yii\helpers\Url::toRoute(['event/view', 'id'=>$model->id]), ['class' => 'btn btn-lg btn-danger'])?>
        <?=Html::endForm();?>
    </div>
</div>
