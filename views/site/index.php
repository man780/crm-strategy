<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

use yii\bootstrap\Html;
use yii\jui\DatePicker;

$this->title = 'Платформа';

$script = <<< JS
    
    $('.direction').click(function(){
        var direction_id = $(this).attr('data-id');
        $('.'+direction_id).toggle();
        //console.log(direction_id);
        //$('.'+direction_id).toggle();
    });
    $('.sub-dir').click(function(){
        var sub_dir = $(this).attr('data-sub_dir');
        $('.'+sub_dir).toggle();
        $('.direction').show();
    });
JS;
$this->registerJs($script);
?>
<style>
    .sub-dir, .event{
        display: none;
    }

    .direction, .sub-dir{
        cursor: pointer;
    }
</style>
<div class="site-index">

    <div class="jumbotron">
        <h1>"Тараққиёт стратегияси" маркази</h1>

        <?if(Yii::$app->user->isGuest):?>
            <p>
                <a class="btn btn-lg btn-primary" href="<?=Url::toRoute('site/login');?>">Кириш </a>
                <a class="btn btn-lg btn-success" href="<?=Url::toRoute('site/signup');?>">Рўйхатдан ўтиш</a>
            </p>
        <?else:?>
            <h4 align="center">
                Ўзбекистон Республикаси Президентининг 2017 йил 7 февралдаги ПФ-4947-сонли Фармони билан тасдиқланган<br>
                2017-2021 йилларда Ўзбекистон Республикасини ривожлантиришнинг бешта устувор йўналиши бўйича Ҳаракатлар стратегиясини<br>
                “Халқ билан мулоқот ва инсон манфаатлари йили”да амалга оширишга оид Давлат дастури ижроси юзасидан<br>
                <!--МАЪЛУМОТ-->
            </h4>
            <!--<h3>Здравствуйте, <?/*= Yii::$app->user->identity->email*/?>
                <br>Мы на главной странице</h3>-->
        <?endif;?>
    </div>

    <?if(!Yii::$app->user->isGuest):?>

    <?if(!Yii::$app->user->id>11):?>
        <div class="alert alert-info"><strong><?=$authority->name?></strong>нинг давлат дастурида қатнашган бандлари сони: <strong><?=count($events);?></strong></div>
    <?else:?>
        <div class="text-info">Давлат дастури бандлари сони: <strong><?=count($events);?></strong></div>
    <?endif;?>
    <div class="body-content table-responsive">
        <table class="table table-striped table-bordered table-hover ">
            <thead>
            <tr>
                <th width="3%">Банд</th>
                <th width="45%">Амалга ошириладиган тадбир</th>
                <th width="5%">Муддати</th>
                <th width="40%">Ижро учун масъуллар</th>
                <th width="5%">Амаллар</th>
            </tr>
            </thead>
            <tbody>
            <?if(!is_null($events)):?>
                <?foreach ($directions as $direction):?>
                    <?if(!in_array($direction['id'], $dArr))continue;?>
                    <tr class="direction" data-id="tr-<?=$direction['id']?>">
                        <td colspan="5" align="left"><b><?=$direction['id']?> <?=$direction['title']?></b></td>
                    </tr>
                    <?foreach ($sub_directions as $sub_direction):?>
                        <?if(!in_array($sub_direction['id'], $sdArr))continue;?>
                        <?if($sub_direction['direction_id'] == $direction['id']):?>
                            <tr class="sub-dir tr-<?=$direction['id']?>" data-sub_dir="tr-<?=$direction['id']?>-<?=$sub_direction['num']?>">
                                <td colspan="5" align="left"><b><?=$sub_direction['direction_id']?>.<?=$sub_direction['num']?>. <?=$sub_direction['title']?></b></td>
                            </tr>
                            <?foreach ($events as $event):?>
                                <?if($event['direction_id'] == $direction['id'] && $event['sub_dir_id'] == $sub_direction['id']):?>
                                    <tr class="event tr-<?=$direction['id']?>-<?=$sub_direction['num']?> dir-<?=$direction['id']?>" data-direction="<?=$event['direction_id']?>" data-sub_direction="<?=$event['sub_dir_id']?>">
                                        <td><?=$event['id']?></td>
                                        <td><?=$event['event']?></td>
                                        <td><?=(is_null($event['deadline']))?$event['deadline_other']:date('d.m.Y', $event['deadline'])?></td>
                                        <td>
                                            <?foreach($event->executorAuthorities as $key=>$executorAuthority):?>
                                                <?if($key == 0):?>
                                                    <p><span class="label label-primary"><?=$executorAuthority->name?></span></p>
                                                <?else:?>
                                                    <p><span class="label label-success"><?=$executorAuthority->name?></span></p>
                                                <?endif;?>
                                                <!--<p><span class="label label-primary"><?/*=$executorAuthority->name*/?></span></p>-->
                                            <?endforeach;?>
                                        </td>
                                        <td>
                                            <?=Html::a('Кўриш', Url::toRoute(['event/view', 'id' => $event['id']]))?>
                                            <?if(Yii::$app->user->id > 11):?>
                                                <?=Html::a('Бажариш', Url::toRoute(['event/execution', 'id' => $event['id']]))?>
                                            <?endif;?>
                                        </td>
                                    </tr>
                                <?endif;?>
                            <?endforeach;?>
                        <?endif;?>
                    <?endforeach;?>
                <?endforeach;?>
            <?endif;?>
            </tbody>

        </table>

    </div>
    <?endif;?>
</div>
